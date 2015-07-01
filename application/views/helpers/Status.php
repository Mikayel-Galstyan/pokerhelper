<?php
/**
 * @package application_views_helpers
 */

/**
 * View helper for translating strings.
 *
 * @package application_core_views_helpers
 **/

class Zend_View_Helper_Status extends Zend_View_Helper_Abstract {
    /**
     * Looks up in the translation keys.
     * 
     * If the $key is found returns the value of it, otherwise returns the $key.
     * 
     * @param string $keys
     * @param string $sep
     */
    public function getStatus($val) {
        switch ($val){
			case 1: 
				$returnVal = 'Deactive';
				break;
			case 2: 
				$returnVal = 'Active';
				break;
			case 3: 
				$returnVal = 'Busy';
				break;
		}
        return $returnVal;
    }
}

