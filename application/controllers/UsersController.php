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
class UsersController extends ControllerActionSupport{
	private $id = null;
	private $name = null;
	private $websiteId = null;
	private $page = 1;
	private $limit = 10;
	/**
	 * Prepare index page layout
	 */
	public function  indexAction() {
		$serviceWebsites = new Service_Website();
		$this->view->websites = $serviceWebsites->getAll();
		$this->view->websiteId = $this->websiteId;
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
		$serviceWebsites = new Service_Website();
		$this->view->websites = $serviceWebsites->getAll();
		if ($id != null) {
			$serviceTurnament = new Service_Users();
			$club = $serviceTurnament->getById($id);

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
		$serviceTurnament = new Service_Users();
		if($this->id){
			$website = $serviceTurnament->getById($this->id);
		}else{
			$website = array(
				"id"=>null,
				"name"=>null,
				"website_id"=>null
			);
		}
		$website['name'] = $this->name;
		$website['website_id'] = $this->websiteId;
		$serviceTurnament->save($website);
		echo json_encode(array("url"=>"website"));
	}
	
	
	public function setId($val){
		$this->id = $val;
	}
	public function setLimit($val){
		$this->limit = $val;
	}
	public function setPage($val){
		$this->page = $val;
	}
	public function setName($val){
		$this->name = $val;
	}
	public function setWebsiteId($val){
		$this->websiteId = $val;
	}  
}