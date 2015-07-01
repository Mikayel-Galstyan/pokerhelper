<?php
/**
 * Controller class for Action Support
 *
 * This controller is responsible for Action Support UI pages
 */
abstract class ControllerActionSupport extends Zend_Controller_Action {
    /**
     * Supporting image types
     *
     * @var array
     */
    protected static $ALLOWED_IMAGES_TYPES = array('image/gif','image/x-png','image/x-citrix-png','image/pjpeg','image/x-citrix-jpeg', 'image/jpeg', 'image/png');
    /**
     * supported date format
     *
     * @var
     */
    protected $dateFormat;
    /**
     * Log object
     *
     * @var null
     */
    protected $LOG = null;
    /**
     * DEFAULT ORDER
     */
    const DEFAULT_ORDER = 'id';
    /**
     * DEFAULT SORT
     */
    const DEFAULT_SORT = 'ASC';
    /**
     * DEFAULT PAGE
     */
    const DEFAULT_PAGE = 1;
    /**
     * DEFAULT LIMIT
     */
    const DEFAULT_LIMIT = 20;

    /**
     * Register log file when init this class
     */
    public function init() {
    	$this->LOG = Zend_Registry::get('log');
    }

    /**
     * Load request parameters
     */
    public function preDispatch() {
        $this->loadRequestParams();
    }

    /**
     *  Make view aware of info
     */
    public function postDispatch() {

    }

    /**
     * Load request params like Post Get and set to classes responding parametrs by set functions
     */
    protected function loadRequestParams() {
        $methods = get_class_methods($this);
        $requestParams = $this->getRequest()->getParams();
        foreach ($requestParams as $key => $value) {
            $method = 'set' . ucfirst($key);
            if(in_array($method, $methods)) {
                $value = (is_string($value)) ? trim($value) : $value;
                $this->$method($value);
            }
        }
    }

    /**
     * Desable view for action
     */
    protected function setNoRender() {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    /**
     * Desable layout for action
     */
    protected function disableLayout() {
        $this->_helper->layout->disableLayout(); 
    }

    /**
     * Convert time to seconds
     *
     * @param $time
     * @return null
     */
    protected function getTimeBySeconds($time){
        @$changeTime = explode(':',$time);
        if(count($changeTime)<2){
            $time = $changeTime[0]*60;
        }else if(count($changeTime)==2){
            $time = $changeTime[0]*60+$changeTime[1];
        }else if(count($changeTime)==3){
            $time = $changeTime[0]*3600+$changeTime[1]*60+$changeTime[2];
        }else{
            $time = null;
        }
        return $time;
    }

    /**
     * translate given word
     *
     * @param string $key
     * @return string mixed
     */
    protected function translate($key) {
        return $this->view->translate($key);
    }

    /**
     * Return project base path
     *
     * @return string
     */
    protected function basePath() {
        return $this->view->basePath();
    }

    /**
     * Return Project base URL
     *
     * @return string
     */
    protected function baseUrl() {
        return $this->view->baseUrl();
    }

    /**
     * Escape given string
     *
     * @param string $value
     * @return string
     */
    protected function htmlEscape($value) {
        return $this->view->htmlEscape($value);
    }

    /**
     * Return output date format
     *
     * @param datetime $value
     * @return datetime
     */
    protected function formatDateOutput($value) {
        return $this->view->formatDateOutput($value);
    }

    /**
     * Return js helper
     *
     * @return mixed
     */
    protected function javascript() {
        $jsHelper = $this->view->getHelper('Js');
        return $jsHelper;
    }

    /**
     * Set given string to page title
     *
     * @param string $key
     */
    protected function setPageTitle($key) {
        $this->javascript()->setPageTitle($key);        
    }

    /**
     * Give Error 404
     *
     * @throws Zend_Controller_Router_Exception
     */
    protected function error404() {
        throw new Zend_Controller_Router_Exception('This page does not exist', 404);
    }

    /**
     * Chec if request is XMLHttp request
     *
     * @return bool
     */
    protected function isXmlHttpRequest(){
       if($this->getRequest()->isXmlHttpRequest()) {
            return true;    
       }
       $conentType = $this->getRequest()->getHeader('Content-Type');
       if($conentType){
           if (strpos($conentType,'multipart/form-data') !== false) {
               return true; 
           }
       }       
       return false;   
    }

    /**
     * Ensure Ajax Call
     */
    protected function ensureAjaxCall(){
        if($this->isXmlHttpRequest()) {
            $this->disableLayout();          
        } 
    }

    /**
     * Return unique string
     *
     * @return string
     */
    public static function getUniqueString() {
        return md5(uniqid(rand(), true));
    }

    /**
     * Return course path
     *
     * @return mixed
     */
    protected function coursePath() {
        return Zend_Registry::get('configuration')->upload->course;
    }

    /**
     * Return upload path
     *
     * @return mixed
     */
    protected function uploadPath() {
        return Zend_Registry::get('configuration')->upload->path;
    }

    /**
     * Delete file by given path
     *
     * @param string $filePath
     * @return bool
     */
    protected function deleteFile($filePath) {
        if (file_exists($filePath)) {
            // yes the file does exist
            if (@unlink($filePath) === true) {
                // the file successfully removed
                return true;
            } else {
                // something is wrong, we may not have enough permission
                // to delete this file
                return false;
            }
        } else {
            // the file is not found, do something about it???
            return false;
        }
    }

    /**
     * Check upload file size
     *
     * @throws Exception
     */
    protected function checkUplaodFileSize() {        
        if (isset($_SERVER["CONTENT_LENGTH"]) || isset($_SERVER['HTTP_CONTENT_LENGTH'])){
            if(isset($_SERVER['HTTP_CONTENT_LENGTH']))
                $serverLength = (int)$_SERVER["HTTP_CONTENT_LENGTH"];
            else
                $serverLength = (int)$_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
        $postSize = ini_get('post_max_size');
        $postLimit = (int)$postSize  * 1024 * 1024;
        $uploadSize = ini_get('upload_max_filesize');
        $uploadLimit = (int)$uploadSize * 1024 * 1024;
        if ($serverLength >=  $postLimit  || $serverLength >=  $uploadLimit){
            $this->printJsonFail($this->translate('upload.file.size.should.less.than.post.max.size.and.file.upload.max.size').'('.$this->translate('post.max.size'). ' ' .$postSize.', ' . $this->translate('file.upload.max.size'). ' ' . $uploadSize.')');
            die();
        }        
    }

    /**
     * Return count in group
     *
     * @param $countsGroupByServer
     * @return int
     */
    protected function getCount($countsGroupByServer){
    	 $count=0;
    	 foreach($countsGroupByServer as $item){
    	 	$count += $item->getCount();
    	 }
    	 return $count;
    }

    /**
     * Upload image
     *
     * @param string $attrName
     * @param string $destPath
     * @param null $name
     * @return string
     * @throws TF_Util_Exception_Upload
     */
    protected function uploadImage($attrName = 'image', $destPath = 'uploads', $name = null){
        
        if (isset($_FILES[$attrName])) {
            $file = $_FILES[$attrName];
            if ($file['size'] > 0) {                            
                require_once APPLICATION_PATH . '../../library/TF/Util/Upload.php';                                        
                $fileType = $file['type']; //returns the mimetype
                $this->LOG->info($fileType);
                if(!in_array($fileType, self::$ALLOWED_IMAGES_TYPES)) {
                    throw new TF_Util_Exception_Upload('Files are not allowed.');            
                }
               
                //imagerotate ($rotate , 90 , 0);
                $uploadClass = new upload($file);

				if (is_null($name)) {
					$name = self::getUniqueString();
				}

                if ($uploadClass->uploaded) {
                    $uploadClass->file_new_name_body = $name;

					$uploadClass->file_auto_rename = false;
					$uploadClass->file_overwrite = true;

                    $uploadClass->Process($destPath);
                    $destName = $uploadClass->file_dst_name;
                    if ($uploadClass->processed) {
                        $uploadClass->Clean();
                    } else {
                        echo 'error : ' . $uploadClass->error;
                    }
                }
                return $destName;
            }
        }    
    }
    /**
     *
     * @param array $json
     */
    protected function printJson($json = array()) {
        if (sizeof($json) > 0) {
            echo Zend_Json::encode($json);
        }
    }

    /**
     * Make succes format notification popup and redirect to given url
     *
     * @param null $message
     * @param $url
     */
    protected function printJsonSuccessRedirect($message = null, $url) {
        if ($message != null) {
            echo Zend_Json::encode(array('status' => 'success', 'msg' => $message, 'url' => $url));
        }
    }
    /**
     * Make Fail format notification popup and redirect to given url
     *
     * @param null $message
     * @param $url
     */
    protected function printJsonFailRedirect($message = null, $url) {
        if ($message != null) {
            echo Zend_Json::encode(array('status' => 'fail', 'msg' => $message, 'url' => $url));
        }
    }
    /**
     * Print information format message
     *
     * @param string $message
     */
    protected function printJsonInfo($message = null) {
        if ($message != null) {
            echo Zend_Json::encode(array('status' => 'info', 'msg' => $message));
        }
    }
    /**
     * Make success notification popup by given message
     *
     * @param string $message
     */
    protected function printJsonSuccess($message = null) {
        if ($message != null) {
            echo Zend_Json::encode(array('status' => 'success', 'msg' => $message));
        }
    }
    /**
     * Make fail notification popup by given message
     *
     * @param string $message
     */
    protected function printJsonFail($message = null) {
        if ($message != null) {
            echo Zend_Json::encode(array('status' => 'fail', 'msg' => $message));
        }
    }
    /**
     * Make error notification popup by given message
     *
     * @param array $errors
     * @param string $message
     */
    protected function printJsonError($errors = null, $message = '') {
        if ($errors != null) {
            echo Zend_Json::encode(array('status' => 'error', 'errors' => $errors, 'msg' => $message));
        }
    }

    /**
     * Make error notification popup by given message
     *
     * @param null $message
     */
    protected function printError ($message = null) {
        echo 
            '<script type="text/javascript">
                parent.Notify.error ("' . $this->translate($message) . '", true);
            </script>';
    }

    /**
     * Make info notification popup by given message
     *
     * @param null $message
     */
    protected function printInfo ($message = null) {
        $this->setHTMLContentType();
        
        echo 
            '<script type="text/javascript">
                parent.Notify.info ("' . $this->translate($message) . '", true);
            </script>';
    }

    /**
     * Set html header content type
     */
    protected function setHTMLContentType (){
       // header ('Content-Type', 'text/html; charset=UTF-8');
    }
    /**
     * Set json header content type
     */
    protected function setJSONContentType () {
        header ('Content-Type: application/json; charset=UTF-8');
    }

    /**
     * Translate given validation errors
     *
     * @param array $errors
     * @return array
     */
    protected function translateValidationErrors($errors) {
        $translatedArray = array ();
        foreach ( $errors as $error ) {
            if ($error->getKey() != null) {
                $key = $error->getKey();
                $translation = $this->translate($key);
                if ($translation != $key) {
                    $translatedArray [$error->getFieldName()] = $translation;
                    continue;
                }
            }
            if ($error->getMessage() != null) {
                $errMessage = "";
                foreach ( $error->getMessage() as $message ) {
                    $errMessage .= $message . ' ';
                }
                $translatedArray [$error->getFieldName()] = $this->htmlEscape($errMessage);
            }
        }
        return $translatedArray;
    }

    /**
     * Parse to date gormat
     *
     * @param string $dateStr
     * @return string|TF_Util_Date
     */
    protected function parseToDate($dateStr) {
        if (!isset($this->dateFormat)) {
            $dateFormattingHelper = $this->view->getHelper('FormatDateInput');
            $this->dateFormat = $dateFormattingHelper::FORMAT;
        }
        return ($dateStr) ? new TF_Util_Date($dateStr, $this->dateFormat) : '';
    }

    
    /**
     * Generates a unique filename
     *
     * @param $name string
     * @param $ext string
     *
     * @return string
     **/
    protected function generateFileName ($name, $ext) {
        return  $name . '_' . date('Y_m_d_H_i_s') . '.' . $ext;
    }
}
