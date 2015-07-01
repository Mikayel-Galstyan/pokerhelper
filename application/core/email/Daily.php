<?php
class Email_Daily extends TF_Email_Base  {   
    
    const TEMPLATE = "daily_import_fail.phtml";

    /**
     * Send email
     *
     */
    public function send(){
        $this->setTemplate(self::TEMPLATE);
        $this->setSubject('Daily import Failed.');                
        parent::send();
    }      
}