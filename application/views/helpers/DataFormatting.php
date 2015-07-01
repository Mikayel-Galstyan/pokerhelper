<?php 
/**
 * @package application_views_helpers 
 */
class Zend_View_Helper_DataFormatting extends Zend_View_Helper_Abstract {
    
    public function space() {
        return '&nbsp;';
    }
    
    public function price($price) {
        return str_replace(' ', '&nbsp;', number_format(round($price, 2), 2, ',', ' ')).'&nbsp;&euro;';
    }
        
    public function percent($number) {
        return str_replace(' ', ' ', number_format(round($number, 2), 2, ',', ' ')).'%';
    }
    
    public function volume($number) {
        return str_replace(' ', '&nbsp;', number_format(round($number, 2), 0, '', ' '));
    }
    
    public function date($date) {
        if ($date != '' and $date != '0000-00-00 00:00:00') {
            $date = str_replace( array(
                    ' ',
                    ':'
            ), '-', $date);
            $c = explode('-', $date);
            $c = array_pad($c, 6, 0);
            @array_walk($c, 'intval');
    
            return date('d-m-Y', mktime($c[3], $c[4], $c[5], $c[1], $c[2], $c[0]));
        }
        return '';
    }
    
    public function markAsRequired () {
        return '<span style="color: #d13c3c;">*</span>';
    }
    
    public function toUppercase($string) {
        return strtoupper($string);
    }
    
    public function monthNameAndYear(TF_Util_Date $date) { 
        return $date->get(TF_Util_Date::MONTH_NAME).' '.$date->get(TF_Util_Date::YEAR);    
    }
    
    /**
     * @param TF_Util_Date $date
     * @return string
     */  
    public function logFilePeriod(TF_Util_Date $date) {
        return $this->weekPeriod($date, 'yyyyMMdd', '_');
    }
    
    /**
     * @param TF_Util_Date $date
     * @return string
     */
    public function outputLogFilePeriod(TF_Util_Date $date) {
        return ' ('.$this->weekPeriod($date, 'yyyy-MM-dd', ' / ').')';
    }
    
    public function round($number, $precision) {
        return round($number, $precision);
    }
    
    /**
     * @param TF_Util_Date $date
     * @param TF_Util_Date FORMAT $format
     * @param string $separator
     * @return string
     */
    private function weekPeriod(TF_Util_Date $date, $format='yyyy-MM-dd', $separator=' ') {
        $monday = $date->setWeekdayByIso(1);
        $period = $monday->get($format);
        $period .= $separator.$monday->addDays(6)->get($format);
        return $period;
    }
}

