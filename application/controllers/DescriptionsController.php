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
class DescriptionsController extends ControllerActionSupport{
    private $id = null;
	private $turnamentId = null;
	private $userId = null;
	private $stars = null;
	private $description = null;
	private $page = 1;
	private $limit = 10;
	
	/**
	 * Prepare index page layout
	 */
	public function  indexAction() {
		$this->view->userId = $this->userId;
		$serviceTurnament = new Service_Turnaments();
		$this->view->turnaments = $serviceTurnament->getAll();
		$serviceUser = new Service_Users();
		$this->view->user = $serviceUser->getById($this->userId);
		
	}       
	
	public function listAction(){
		if($this->isXmlHttpRequest()){
			$this->disableLayout();
		}
		$serviceUser = new Service_Description();
		//$websiteId = $this->websiteId;
		$filter = new Filter_Info();
		$filter->setTurnamentId($this->turnamentId);
		$filter->setPage($this->page);
		$filter->setLimit($this->limit);
		$filter->setUserId($this->userId);
		$users = $serviceUser->getByFilter($filter);
		$this->view->items = $users;
		$this->view->filter = $filter;
		$this->view->itemCount = $serviceUser->getCountByFilter($filter);
	}

	public function editAction(){
		$id = $this->id;
		$this->disableLayout();
		$this->view->userId = $this->userId;
		$serviceTurnament = new Service_Turnaments();
		$this->view->turnaments = $serviceTurnament->getAll();
		if ($id != null) {
			$serviceDescription = new Service_Description();
			$club = $serviceDescription->getById($id);

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
		$serviceDescription = new Service_Description();
		if($this->id){
			$description = $serviceDescription->getById($this->id);
		}else{
			$description = array(
				"id"=>null,
				"turnament_id"=>null,
				"user_id"=>null,
				"description"=>null,
				"stars"=>null
			);
		}
		$description['user_id'] = $this->userId;
		$description['description'] = $this->description;
		$description['turnaments_id'] = $this->turnamentId;
		$description['stars'] = $this->stars;
		$serviceDescription->save($description);
		echo json_encode(array("url"=>"descriptions"));
	}


	public function setId($val){
		$this->id = $val;
	}
	public function setTurnamentId($val){
		$this->turnamentId = $val;
	}
	public function setUserId($val){
		$this->userId = $val;
	}
	public function setStars($val){
		$this->stars = $val;
	}
	public function setDescription($val){
		$this->description = $val;
	}
	public function setLimit($val){
		$this->limit = $val;
	}
	public function setPage($val){
		$this->page = $val;
	}
}