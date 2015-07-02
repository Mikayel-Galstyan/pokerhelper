<?php

class Dao_Users extends TF_Dao_Base {
   
    protected $primaryColumn = 'id';
    
    protected $columnAliases = array (
		'id' 		=> 'id',
		'name'	=> 'clubId',
		'website_id'		=> 'name'
    );
   
    protected $entityClass = 'Domain_Course';
   
    public function __construct() {
        $this->dbTable = new Dao_DbTable_Users();
    }

    
    public function &getByFilter($filter) {
    	$select = $this->dbTable->select()
    	->from(array(Dao_DbTable_List::USERS => Dao_DbTable_List::USERS),
    			array('id AS id', 'name AS name'))->order('id ASC');
    	if($filter->getName()){
    		$select->where('name = ?', $filter->getName());
    	}
		if($filter->getWebsiteId()){
    		$select->where('website_id = ?', $filter->getWebsiteId());
    	}
		$select->limitPage($filter->getPage(), $filter->getLimit());
    	$items = $this->dbTable->fetchAll($select);
    	$items = &$this->getEntities($items);
    	return $items;
    }
	
	
	public function &getCountByFilter($filter) {
    	$select = $this->dbTable->select()
    	->from(array(Dao_DbTable_List::USERS => Dao_DbTable_List::USERS),
    			array('count(id) AS count'));
    	if($filter->getName()){
    		$select->where('name = ?', $filter->getName());
    	}
		if($filter->getWebsiteId()){
    		$select->where('website_id = ?', $filter->getWebsiteId());
    	}    
        $items = $this->dbTable->fetchRow($select);
		$count = $items->count;
    	return $count;
    }
}