<?php

class Dao_Cards extends TF_Dao_Base {

    protected $columnAliases = array (
		'id' 		=> 'id',
		'card'	=> 'clubId',
		'image'	=> 'clubId',
		'order'	=> 'clubId',
		'type'		=> 'name'
    );

    protected $entityClass = 'Domain_Course';

    public function __construct() {
        $this->dbTable = new Dao_DbTable_Cards();
    }
	
}