<?php
/**
 * Include required for Controller
 */
require_once('ControllerActionSupport.php');
/**
 * Include required for Controller
 */
require_once (APPLICATION_PATH.'/../library/TF/Util/JSMin.php');

/**
 * Controller class for Jsmin
 *
 * This controller is responsible for Jsmin files include
 */
class JsminController extends ControllerActionSupport {
    /**
     * Prepare data for layout
     */
    public function preDispatch(){    
        $this->_helper->layout()->disableLayout();
        $this->setNoRender();
    }

    /**
     * Prepare js file for layout
     */
    public function indexAction() {
       echo '<script type="text/javascript">'; 
       if (APPLICATION_ENV=="development"){            
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Menu.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Page.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Form.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Filter.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Ajax.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Url.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Util.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Grid.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/CustomForm.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/RemoveForm.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/TimeMask.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Popup.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Mask.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Notify.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Validator.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Message.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Slider.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Button.js');            
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/Init.js');            
         }else{                        
			echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Menu.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Page.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Form.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Filter.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Ajax.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Url.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Util.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/Grid.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/CustomForm.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/RemoveForm.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/TimeMask.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Popup.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Mask.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Notify.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Validator.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Message.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Slider.js');
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/classes/design/Button.js');            
            echo file_get_contents(APPLICATION_PATH.'/layouts/scripts/js/Init.js');            
        }
        echo '</script>';
    }          
}