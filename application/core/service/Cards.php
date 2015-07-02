<?php
/**
 * The service class responsible for transaction Clubs operations
 *
 * This service is responsible for providing interface for transaction Club crud,
 * and Club specific operations, as well as data validation
 */
class Service_Cards extends TF_Service_Base {

	const xar = 'xar';
	const xach = 'xach';
	const sirt = 'sirt';
	const qyap = 'qyap';
	
    public function __construct() {
        parent::__construct();
        $this->dao = new Dao_Cards();
    }
	
	public function getGroupedCards(){
		$cards = $this->dao->getAll();
		$responseArray = array(self::xar=>array(),self::xach=>array(),self::sirt=>array(),self::qyap=>array());
		foreach($cards as $key=>$value){
			$responseArray[$value['type']][$value['card']]=$value['image'];
		}
		return $responseArray;
	}


}