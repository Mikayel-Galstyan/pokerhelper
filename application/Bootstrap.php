<?php
/**
 * A Bootstrap class
 *
 * This class is required by Zend framework for bootstrap operations
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {


	/**
	 * Runs the application from command line
	 *
	 * @throws Zend_Application_Bootstrap_Exception
	 */
	public function runFromCli() {
        $this->setupEnvironment();
        $front   = $this->getResource('FrontController');
        $default = $front->getDefaultModule();
        if (null === $front->getControllerDirectory($default)) {
            throw new Zend_Application_Bootstrap_Exception('No default controller directory registered with front controller');
        }
        $action = (@$_POST['action']) ? $_POST['action'] : '';
		$courseId = (@$_POST['courseId']) ? $_POST['courseId'] : 0;
        $front->setParam('bootstrap', $this);
        $request = new Zend_Controller_Request_Simple($action, 'player', '',array('courseId'=>$courseId));
        $response = new Zend_Controller_Response_Cli();
        $dispatcher = $front->getDispatcher();

        $dispatcher->dispatch($request, $response);
		
        echo $response->getBody();
    }
    /**
     * Runs the application.
     *
     * Checks the type of interface between web server and PHP. If it's a command line,
     * the from CLI run method will be called. Otherwise the environment will be set up and
     * standard Zend application run routines will be performed.
     *
     * @throws Zend_Application_Bootstrap_Exception
     */
    public function run() {
		if ('cli' == PHP_SAPI){
            $this->runFromCli();
            return;
        }
        $this->setupEnvironment();
        $front   = $this->getResource('FrontController');
        $default = $front->getDefaultModule();
        if (null === $front->getControllerDirectory($default)) {
            throw new Zend_Application_Bootstrap_Exception('No default controller directory registered with front controller');
        }
        $front->setParam('bootstrap', $this);
        $front->dispatch();
    }

    /**
     * Setups environment.
     *
     * Setups the application environment, such as error handling,
     * configuration setting, timezone and base URL
     */
    protected function setupEnvironment() {
		
        libxml_use_internal_errors(true);
    }

	/*protected function _initCache() {
       $config = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
       $cacheLifeTime = $config->phpSettings->cache->lifetime;
       $isSerialize = true;
       $cacheDirectoryPath = APPLICATION_PATH.'/data/cache/';
       //Set the cache life time and serialization
       $frontendOptions = array('lifetime' => $cacheLifeTime, 'automatic_serialization' => $isSerialize);
       //Set the directory where to put the cache files
       $backendOptions = array('cache_dir' => $cacheDirectoryPath);
       //Getting a Zend_Cache_Core object and return the object
       $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
       Zend_Registry::set('cache', $cache);
   }*/

    /**
     * Configures Zend Cache
     */
    protected function _initSession() {
        $config = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        $sessionTimeout = $config->phpSettings->session->timeout;
        Zend_Registry::set('session_timeout', $sessionTimeout);
    }
    /**
    * Bootstrap autoloader for application resources
    *
    * @return Zend_Application_Module_Autoloader
    */
    protected function _initAutoload() {
        
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH));    
      
        $autoloader->setResourceTypes(array(
            'dbtable' => array(
                'namespace' => 'Dao_DbTable',
                'path'      => 'core/dao/dbtable',
            ),
            'report' => array(
                'namespace' => 'Dao_Report',
                'path'      => 'core/dao/report',
            ),
            'dao' => array(
                'namespace' => 'Dao',
                'path'      => 'core/dao',
            ),
            'domain' => array(
                'namespace' => 'Domain',
                'path'      => 'core/domain',
            ),          
            'domain_report' => array(
                'namespace' => 'Domain_Report',
                'path'      => 'core/domain/report',
            ),
            'service' => array(
                'namespace' => 'Service',
                'path'      => 'core/service',
            ),  
            'filter' => array(
                'namespace' => 'Filter',
                'path'      => 'core/filter',
            ),
            'tf_dao' => array(
                'namespace' => 'TF_Dao',
                'path'      => '/../library/TF/Dao',
            ),
            'tf_domain' => array(
                'namespace' => 'TF_Domain',
                'path'      => '/../library/TF/Domain',
            ),
            'tf_service' => array(
                'namespace' => 'TF_Service',
                'path'      =>  '/../library/TF/Service',
            ),
            'tf_util' => array(
                'namespace' => 'TF_Util',
                'path'      => '/../library/TF/Util',
            ),
            'tf_exception' => array(
                'namespace' => 'TF_Util_Exception',
                'path'      => '/../library/TF/Util/Exception',
            ),
            'tf_session' => array(
                'namespace' => 'TF_Session',
                'path'      => '/../library/TF/Session',
            ),
            'tf_validation' => array(
                'namespace' => 'TF_Validation',
                'path'      => '/../library/TF/Validation',
            ),                        
            'plugin' => array(
                'namespace' => 'Plugin',
                'path'      => 'plugins',
            ),
            'viewhelper'  => array(
                'namespace' => 'View_Helper',
                'path'      => 'views/helpers',
            ),           
        ));
        $autoloader->setDefaultResourceType('service');        
        return $autoloader;
    }

    /**
     * Init translation
     */
    protected function _initTranslate() {
        $langSession = new TF_Session_Base();
        $langFilePath = APPLICATION_PATH . '/languages/' . $langSession->get('lang') . '.php';
        if ($langSession->get('lang') == '' || !file_exists($langFilePath)) {
            $langSession->set('lang', 'en');
        }
        $translate = new Zend_Translate ( 'array', APPLICATION_PATH . '/languages/' . $langSession->get('lang') . '.php', $langSession->get('lang'));
        Zend_Registry::set ( 'translate', $translate );
    }
    /**
    * Bootstrap logger for the application
    */
    protected function _initLogging() {
        $this->bootstrap('frontController');
        $format = 'Ymd';
        $now = new TF_Util_Date();
        $date = $now->setWeekday('Monday');
        $filename = $date->format($format);
        $date = $date->addDays(6);
        $filename .= '_'.$date->format($format);
        $logger = new Zend_Log();
		$loggerMarshal = new Zend_Log();
        $loggerImport = new Zend_Log();
		$loggerSimulations = new Zend_Log();
		$loggerApi = new Zend_Log();
		$loggerJob = new Zend_Log();
		$loggerTest = new Zend_Log();
        $jobWriter = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/job_'.$filename.'.log');
		$testWriter = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/test_'.$filename.'.log');
		$marshalWriter = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/marshal_'.$filename.'.log');
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/app_'.$filename.'.log');
        $writerImport = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/import_'.$filename.'.log');
		$writerSimulations = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/simulations_'.$filename.'.log');
        @chmod(APPLICATION_PATH . '/data/logs/app_'.$filename.'.log', 0777);
		@chmod(APPLICATION_PATH . '/data/logs/test_'.$filename.'.log', 0777);
        @chmod(APPLICATION_PATH . '/data/logs/import_'.$filename.'.log', 0777);
		@chmod(APPLICATION_PATH . '/data/logs/marshal_'.$filename.'.log', 0777);
		@chmod(APPLICATION_PATH . '/data/logs/job_'.$filename.'.log', 0777);
		@chmod(APPLICATION_PATH . '/data/logs/simulations_'.$filename.'.log', 0777);
		$writerApi = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/logs/appi_'.$filename.'.log');
        @chmod(APPLICATION_PATH . '/data/logs/appi_'.$filename.'.log', 0777);
        $formatter = new Zend_Log_Formatter_Simple('%timestamp% %priorityName% %message%' . PHP_EOL);
        $writerApi->setFormatter($formatter);
		$marshalWriter->setFormatter($formatter);
		$jobWriter->setFormatter($formatter);
		$writer->setFormatter($formatter);
		$testWriter->setFormatter($formatter);
        $writerImport->setFormatter($formatter);
        $logger->addWriter($writer);
		$loggerMarshal->addWriter($marshalWriter);
		$loggerApi->addWriter($writerApi);
        $loggerJob->addWriter($jobWriter);
		$loggerTest->addWriter($testWriter);
		$loggerImport->addWriter($writerImport);
		$loggerSimulations->addWriter($writerSimulations);
        if ('development' == $this->getEnvironment()) {
        	$filter = new Zend_Log_Filter_Priority(Zend_Log::DEBUG);
        }else{
        	$filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);        	
        }
        $logger->addFilter($filter);
		$loggerMarshal->addFilter($filter);
        $loggerImport->addFilter($filter);
		$loggerTest->addFilter($filter);
		$loggerJob->addFilter($filter);
		$loggerSimulations->addFilter($filter);
		$loggerApi->addFilter($filter);
        Zend_Registry::set('log', $logger);
		Zend_Registry::set('marshalLog', $loggerMarshal);
		Zend_Registry::set('logApi', $loggerApi);
        Zend_Registry::set('import_log', $loggerImport);
		Zend_Registry::set('test', $loggerTest);
		Zend_Registry::set('job_log', $loggerJob);
        Zend_Registry::set('simulatied_positions', $loggerSimulations);
        Zend_Registry::set('environment', $this->getEnvironment());
    }

    /**
     * init def Session
     */
    protected function _initDefSession() {       
        $configuration = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV );
        Zend_Registry::set ( 'configuration', $configuration );
        
    }

    /**
     * init routes
     */
    protected function _initRoutes() {
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();
        $router->addRoute('image', new Zend_Controller_Router_Route('image/:folder/:name',
                array('controller' => 'image', 'action' => 'index', 'folder' => ':folder', 'name' => ':name' ))
        );
        $router->addRoute('croppedImage', new Zend_Controller_Router_Route('image/cropped/:folder/:name',
                array('controller' => 'image', 'action' => 'cropped', 'folder' => ':folder', 'name' => ':name' ))
        );

        $router->addRoute('add', new Zend_Controller_Router_Route(':controller/add',
            array('controller' => ':controller','action' => 'edit'))
        );         
        $router->addRoute('edit', new Zend_Controller_Router_Route(':controller/:id/edit',
            array('controller' => ':controller', 'action' => 'edit', 'id' => ':id'))
        );
        $router->addRoute('delete', new Zend_Controller_Router_Route(':controller/:id/delete',
            array('controller' => ':controller','action' => 'delete','id' => ':id'))
        );
        $router->addRoute('confirm_polygon_delete', new Zend_Controller_Router_Route(':controller/:id/confirm',
            array('controller' => ':controller','action' => 'confirm','id' => ':id'))
        );
        $router->addRoute('confirm', new Zend_Controller_Router_Route(':controller/confirm',
                array('controller' => ':controller','action' => 'confirm'))
        );
        $router->addRoute('polygons', new Zend_Controller_Router_Route(':controller/:courseId/polygons',
        		array('controller' => ':controller', 'action' => 'polygons', 'id' => ':id'))
        );
        $router->addRoute('analizer', new Zend_Controller_Router_Route(':controller/:id/analizer',
        		array('controller' => ':controller', 'action' => 'analizer', 'id' => ':id'))
        );
		$router->addRoute('analizerlist', new Zend_Controller_Router_Route(':controller/:id/analizerlist',
        		array('controller' => ':controller', 'action' => 'analizerlist', 'id' => ':id'))
        );
        $router->addRoute('polygonsanddetails', new Zend_Controller_Router_Route(':controller/:courseId/polygons/:zoom/:left/:top',
        		array('controller' => ':controller', 'action' => 'polygons', 'id' => ':id', ':zoom' => 'zoom', ':left' => 'left', ':top' => 'top'))
        );
        $router->addRoute('polygonedit', new Zend_Controller_Router_Route(':controller/:courseId/:id/edit',
        		array('controller' => ':controller', 'action' => 'edit', 'id' => ':id', 'courseId' => ':courseId'))
        );
        $router->addRoute('system_log', new Zend_Controller_Router_Route('log/download/:name',
            array('controller' => 'log', 'action' => 'download', 'name' => ':name'))
        );        
        $router->addRoute('player_location', new Zend_Controller_Router_Route('player/location',
            array('controller' => 'player', 'action' => 'location'))
        ); 
        $router->addRoute('set_hole_position', new Zend_Controller_Router_Route('set/hole/:courseId/:lat/:lng',
            array('controller' => 'set', 'action' => 'hole', 'courseId' => ':courseId', 'lat' => ':lat', 'lng' => ':lng'))
        ); 
        $router->addRoute('type_of_pol_edit', new Zend_Controller_Router_Route('polygon/:fromPage/save',
            array('controller' => 'polygon', 'action' => 'save', 'fromPage' => ':fromPage'))
        );
        $router->addRoute('polygons_groups', new Zend_Controller_Router_Route(':controller/:courseId/groups',
            array('controller' => 'polygon', 'action' => 'groups', 'id' => ':id'))
        ); 
		$router->addRoute('api', new Zend_Controller_Router_Route(':controller/signal/:signal',
            array('controller' => 'api', 'action' => 'signal', 'signal' => ':signal'))
        );	
		$router->addRoute('apiconfirm', new Zend_Controller_Router_Route(':controller/confirm/:confirm',
            array('controller' => 'api', 'action' => 'confirm', 'confirm' => ':confirm'))
        );		
   		
    }

    /**
    * Bootstrap the view doctype
    *
    * @return void
    */
    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->headMeta ()->appendHttpEquiv ( 'Content-Type', 'text/html;charset=utf-8' );
    }
    
}

