<?php
/**
 * User: Johannes
 * Date: 04.04.14
 * Time: 09:41
 */

class ParagonFramework_Controller_Action extends Pimcore_Controller_Action
{
	public function init()
    {
		//parent::init(); maybe not :D
        $auth = Zend_Auth::getInstance();
        if(!$auth->hasIdentity())
        {
            $this->redirect("/plugin/ParagonFramework/index/index");
            exit;
        }
	}
} 