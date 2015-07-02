<?php

class Dao_Website extends TF_Dao_Base {

    protected $columnAliases = array (
		'id' 		=> 'id',
		'url'	=> 'clubId',
		'name'		=> 'name'
    );

    protected $entityClass = 'Domain_Course';

    public function __construct() {
        $this->dbTable = new Dao_DbTable_Website();
    }
	
}