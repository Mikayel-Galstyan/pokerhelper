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
class CalculationController extends ControllerActionSupport{


	private $card1 = null;
	private $card2 = null;
	
	private $flop1 = null;
	private $flop2 = null;
	private $flop3 = null;
	
	private $river = null;
	private $turn  = null;
	
	private $bank  = null;
	private $call  = null;
	
	private $position  = null;
	
	private $players = null;
	
	
    public function  indexAction() {
		if($this->isXmlHttpRequest()){
			$this->disableLayout();
		}
		$serviceCards = new Service_Cards();//var_dump()
		$this->view->cards = $serviceCards->getGroupedCards();
	}      
	
	
	
	public function setCard1($val){
		$this->card1 = $val;
	}
	public function setCard2($val){
		$this->card2 = $val;
	}
	
	public function setFlop1($val){
		$this->flop1 = $val;
	}
	public function setFlop2($val){
		$this->flop2 = $val;
	}
	public function setFlop3($val){
		$this->flop3 = $val;
	}
	
	public function setRiver($val){
		$this->river = $val;
	}
	
	public function setTurn($val){
		$this->turn = $val;
	}
	
	public function setCall($val){
		$this->call = $val;
	}
	
	public function setBank($val){
		$this->bank = $val;
	}
	
	public function setPosition($val){
		$this->position = $val;
	}
	
	public function setPlayers($val){
		$this->players = $val;
	}
}