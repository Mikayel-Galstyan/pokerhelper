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
	private $name = null;
	private $url = null;
    /**
     * Prepare index page layout
     */
    public function  indexAction() {
		if($this->isXmlHttpRequest()){
			$this->disableLayout();
		}
		$serviceWebsite = new Service_Website();
		$this->view->items = $serviceWebsite->getAll();
		
	}      
	
	public function listAction(){
		if($this->isXmlHttpRequest()){
			$this->disableLayout();
		}
		$serviceUser = new Service_Users();
		$keyWord = $this->name;
		$websiteId = $this->websiteId;
		$filter = new Filter_Info();
		$filter->setName($keyWord);
		$filter->setPage($this->page);
		$filter->setLimit($this->limit);
		$filter->setWebsiteId($this->websiteId);
		$users = $serviceUser->getByFilter($filter);
		$this->view->items = $users;
		$this->view->filter = $filter;
		$this->view->itemCount = $serviceUser->getCountByFilter($filter);
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
	
	
	public function saveAction(){
		$this->disableLayout();
        $this->setNoRender();
		$serviceWebsite = new Service_Website();
		if($this->id){
			$website = $serviceWebsite->getById($this->id);
		}else{
			$website = array(
				"id"=>null,
				"name"=>null,
				"url"=>null
			);
		}
		$website['name'] = $this->name;
		$website['url'] = $this->url;
		$serviceWebsite->save($website);
		echo json_encode(array("url"=>"website"));
	}
	
	
	public function setId($val){
		$this->id = $val;
	}
	public function setName($val){
		$this->name = $val;
	}
	public function setUrl($val){
		$this->url = $val;
	}
}