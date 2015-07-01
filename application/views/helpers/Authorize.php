<?php
/**
 * @package application_views_helpers 
 */

/**
 * View helper for checking current user's permissions.
 *
 * @package application_views_helpers
 */
class Zend_View_Helper_Authorize extends Zend_View_Helper_Abstract {
    
    public  $view;
    
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

    private $accessList = 
        array (
            'analytic'    => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'index'       => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'club'        => array ( Service_User::ADMIN_ROLE),
            'course'      => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE),                
            'cssmin'      => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'error'       => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'get'         => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'polygondraw' => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'provides'    => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'hole'        => array ( Service_User::ADMIN_ROLE),
            'image'       => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE),
            'jsmin'       => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'log'         => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'player'      => array ( Service_User::ADMIN_ROLE),
            'polygon'     => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE),
            'set'         => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
			'virtual'     => array ( Service_User::ADMIN_ROLE, Service_User::CLUB_ROLE ),
            'settings'    => array ( Service_User::ADMIN_ROLE ),
			'api'    	  => array ( Service_User::ADMIN_ROLE,Service_User::CLUB_ROLE),
			'user'    	  => array ( Service_User::ADMIN_ROLE ),
            'live'        => array ( Service_User::ADMIN_ROLE,Service_User::CLUB_ROLE )
        );    
    
    function authorize($controllerName) {
        $userSession = new TF_Session_Base();        
        $controllerName = strtolower($controllerName);
        $list = $this->accessList; 
        $authUser = $userSession->get('authUser');        
        if (array_key_exists($controllerName, $list) ){            
            if (array_search($authUser['status'], $list[$controllerName]) !== false){
                return true;
            } 
        }
        return false;                       
    }  
   

}

