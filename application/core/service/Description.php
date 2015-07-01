<?php
/**
 * The service class responsible for transaction Clubs operations
 *
 * This service is responsible for providing interface for transaction Club crud,
 * and Club specific operations, as well as data validation
 */
class Service_Description extends TF_Service_Base {
    
    public function __construct() {
        parent::__construct();
        $this->dao = new Dao_Description();
    }

    /**
     * Saves provided entity in DB
     *
     * @param Domain_Club $domain
     * @return Domain_Club
     * @throws TF_Util_Exception_Validation
     */
    public function &save($domain) {	
		$domain = &$this->dao->save($domain);            
		return $domain;
    }

    /**
     * Get clubs list by selected filter
     *
     * @param Filter_Order $filter
     * @return array
     */
    public function getByFilter($filter) {
        $domains = $this->dao->getOrderedList($filter);
        return $domains;
    }

    
}