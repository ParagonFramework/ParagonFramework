<?php
/**
 * User: Johannes
 * Date: 04.04.14
 * Time: 09:41
 */

class ParagonFramework_Controller_ActionAdmin extends Pimcore_Controller_Action
{
    /**
     * get called from Zend before other method or action calls
     * checks if the session is valid otherwise redirects to login page
     */
    public function init()
    {
        parent::init();

        Zend_Registry::set('Zend_Locale', new Zend_Locale('en_US'));

        $this->enableLayout();

        if(ParagonFramework_Models_User::getUser() == null)
        {
            $this->redirect("/plugin/ParagonFramework/login/index");
            exit;
        }
    }
} 