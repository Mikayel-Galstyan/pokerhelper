<?php
/**
 * Include required for Controller
 */
require_once ('ControllerActionSupport.php');

/**
 * Controller class for Error
 *
 * This controller is responsible for Error UI pages
 */
class ErrorController extends ControllerActionSupport {

    /**
     * Controller initialization
     *
     * Initializes controller and tries to get filter values from session
     */
	public  function init() {
		parent::init();
		$this->disableLayout();
	}

    /**
     * Prepare Error page data
     */
    public function errorAction() {
		$errors = $this->_getParam('error_handler');		
		switch ($errors->type) {		    
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER :
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION :
		    case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
		    case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER :	        
				// 404 error -- controller or action not found
				$this->getResponse()->setHttpResponseCode(404);
				$this->view->message = '404 Page not found';
                $newRender = 'error404';
				break;
			default :
				// application error
				$this->getResponse()->setHttpResponseCode(500);
				$this->view->message = 'Application error';
				break;
		}
        $this->LOG->info($errors->exception);
		$this->view->exception = $errors->exception;
		$this->view->request = $errors->request;
        if ( isset($newRender) ) {
            $this->render($newRender);
        }
    }
}
