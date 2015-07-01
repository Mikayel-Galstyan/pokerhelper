<?php
/**
 * The service class responsible for transaction Clubs operations
 *
 * This service is responsible for providing interface for transaction Club crud,
 * and Club specific operations, as well as data validation
 */
class Service_Website extends TF_Service_Base {
    /**
     * The validation configuration
     *
     * @var array
     * @static
     */
    private static $VALIDATION_CONFIG = array (
            'name' => array (
                    TF_Validation_Base::NOT_EMPTY,
                    TF_Validation_Base::DB_NO_RECORD_EXISTS => array('table'=>Dao_DbTable_List::CLUBS, 'field' => 'name'))
    );
    /**
     * The validator object used for input data validation
     *
     * @var TF_Validation_Base
     */
    private $validator = null;
    /**
     * The default constructor
     *
     * Creates Dao class instance for data operations
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new Dao_Website();
    }

    /**
     * Saves provided entity in DB
     *
     * @param Domain_Club $domain
     * @return Domain_Club
     * @throws TF_Util_Exception_Validation
     */
    public function &save($domain) {
        $errors = $this->validate($domain);        
        if (sizeof($errors) == 0) {            
            $domain = &$this->dao->save($domain);            
            return $domain;
        } else {
            throw new TF_Util_Exception_Validation($errors, "save.of.club" . $domain['name'] . ' is.suspended.as.there.are.validation.errors.');
        }
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

    /**
     * Validates provided entity according to validation configuration
     *
     * @param Domain_Club $domain - the entity object
     * @return array - the list of errors (instances of TF_Validation_Info)
     */
    public function validate($domain) {
        $validationConf = self::$VALIDATION_CONFIG;
        $id = (isset($domain['id']) && $domain['id'])?$domain['id']:null;
        if ($id != null){
            $item = $this->getById($id);
            $name = $item['name'];
            if ($name ==  $domain['name']){
                unset($validationConf['name'][Tf_Validation_Base::DB_NO_RECORD_EXISTS]);
            }
        }
        if ($this->validator == null) {
            $this->validator = new TF_Validation_Base($validationConf);
        }
        $errors = $this->validator->validate($domain);
        return $errors;
    }

}