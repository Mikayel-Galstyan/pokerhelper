<?php
/**
 * The zend table that maps to the database table 'history'
 */
class Dao_DbTable_Users extends Zend_Db_Table_Abstract {
    /**
     * The database table name used internally by zend
     */
    protected $_name = Dao_DbTable_List::USERS;
}
