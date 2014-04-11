<?php
/**
 * Created by PhpStorm.
 * User: S1310307092
 * Date: 11.04.14
 * Time: 11:54
 */
error_reporting(-1);
ini_set('display_errors', 1);

class ParagonFramework_LoginController extends Pimcore_Controller_Action
{
    public function indexAction()
    {

    }

    public function loginAction()
    {
        $username = $this->getRequest()->getParam('username', '');
        $password = $this->getRequest()->getParam('password', '');

        $wrapper = ParagonFramework_Wrapper_Factory::getWrapper();
        if($wrapper->authenticateUser($username, $password) === true)
        {

        }
        else
        {
            $this->_helper->redirect("/plugin/ParagonFramework/login/index");
            exit;
        }
    }
}