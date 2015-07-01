<?php
/**
 * @package application_views_helpers
 */

/**
 * View helper for translating strings.
 *
 * @package application_core_views_helpers
 **/
class Zend_View_Helper_TimeFormat extends Zend_View_Helper_Abstract {
    /**
     * Looks up in the translation keys.
     * 
     * If the $key is found returns the value of it, otherwise returns the $key.
     * 
     * @param string $keys
     * @param string $sep
     */
    public function timeFormat($timeBySeconds,$format="minutes") {
        $seconds = null;
        $minutes = null;
        $hours = null;
		if($timeBySeconds>0){
			if($format=="minutes"){
				$seconds = $timeBySeconds%60;
				if($seconds<10){
					$seconds = "0".$seconds;
				}
				$minutes = intval($timeBySeconds/60);
				$returnTime = $minutes.':'.$seconds;
			}else if($format=="hours"){
				$seconds = $timeBySeconds%60;
				if($seconds<10){
					$seconds = "0".intval($seconds);
				}
				$timeBySeconds = intval($timeBySeconds/60);
				$minutes = $timeBySeconds%60;
				if($minutes<10){
					$minutes = "0".$minutes;
				}
				$hours = intval($timeBySeconds/60);
				$returnTime = $hours.':'.$minutes.':'.$seconds;
			}
		}else{
			$returnTime = '00:'.'00:'.'00';
		}
        return $returnTime;
    }
}

