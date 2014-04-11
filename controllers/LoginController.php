<?php
/**
 * Created by PhpStorm.
 * User: S1310307092
 * Date: 11.04.14
 * Time: 11:54
 */
//error_reporting(-1);
//ini_set('display_errors', 1);

class ParagonFramework_LoginController extends Pimcore_Controller_Action
{
    public function indexAction()
    {
        if($this->getParam("error") != null)
            $this->view->message = "Invalid Username or Password";
        else
            $this->view->message = "";
    }

    public function loginAction()
    {
        $username = $this->getRequest()->getParam('username', '');
        $password = $this->getRequest()->getParam('password', '');



        $wrapper = ParagonFramework_Wrapper_Factory::getWrapper();
        if($wrapper->authenticateUser($username, $password) === true)
        {
            die("user authenticated");
        }
        else
        {
            //$this->view->assign('data', "test");
            //$this->view->myVar = "sth";
            //$this->view->menu = "test";

            //$this->setParam("message", "Invalid username or password");
            $this->forward("index", "login", "ParagonFramework", array("message" => "test")); // /error/1023
            exit;
        }
    }
}