<?php
/**
 * Include required for Controller
 */
require_once('ControllerActionSupport.php');
/**
 * Controller class for Index
 *
 * This controller is responsible for Index UI pages
 */
class WebsiteController extends ControllerActionSupport{


	private $id = null;
    /**
     * Prepare index page layout
     */
    public function  indexAction() {
     
      
	}       
	
	public function editAction(){
		$id = $this->id;
		$this->disableLayout();
        if ($id != null) {
            $clubService = new Service_Website();
            $club = $clubService->getById($id);

            if (!empty($club)) {
                $this->view->club = $club;
            } else {
                $this->error404();
            }
        } else {
            
        }
	}
}