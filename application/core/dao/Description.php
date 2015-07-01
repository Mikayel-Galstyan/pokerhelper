<?php
/**
 * Responsible for manipulating Clubs data.
 *
 */
class Dao_Description extends TF_Dao_Base {

    protected $columnAliases = array (
		'id' 		=> 'id',
		'description'	=> 'description',
		'stars'		=> 'stars',
		'turnament_id'	=> 'turnament_id',
		'user_id'	    => 'user_id'
    );
	
    public function __construct() {
        $this->dbTable = new Dao_DbTable_Description();
    }
	
	
	public function &getByFilter($filter) {
    	$select = $this->dbTable->select()
    	->from(array(Dao_DbTable_List::TURNAMENTS => Dao_DbTable_List::TURNAMENTS),
    			array('id AS id', 'name AS name'))->order($filter->getOrder().' '.$filter->getSort());
    	if($filter->getName()){
    		$select->where('user_id = ?', $filter->getUserId());
    	}
		if($filter->getWebsiteId()){
    		$select->where('turnament_id = ?', $filter->getTurnamentId());
    	}
    	$items = $this->dbTable->fetchAll($select);
    	$items = &$this->getEntities($items);
    	return $items;
    }
}