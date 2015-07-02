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
    	->from(array(Dao_DbTable_List::DESCRIPTION => Dao_DbTable_List::DESCRIPTION))->order('id ASC');
    	if($filter->getUserId()){
    		$select->where('user_id = ?', $filter->getUserId());
    	}
		if($filter->getTurnamentId()){
    		$select->where('turnament_id = ?', $filter->getTurnamentId());
    	}
		$select->limitPage($filter->getPage(), $filter->getLimit()); //echo $select;exit;
    	$items = $this->dbTable->fetchAll($select);
    	$items = &$this->getEntities($items);
    	return $items;
    }
	
	public function &getCountByFilter($filter) {
    	$select = $this->dbTable->select()
    	->from(array(Dao_DbTable_List::DESCRIPTION => Dao_DbTable_List::DESCRIPTION),
    			array('count(id) AS count'));
    	if($filter->getUserId()){
    		$select->where('user_id = ?', $filter->getUserId());
    	}
		if($filter->getTurnamentId()){
    		$select->where('turnament_id = ?', $filter->getTurnamentId());
    	}
        $items = $this->dbTable->fetchRow($select);
		$count = $items->count;
    	return $count;
    }
}