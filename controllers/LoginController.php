<?php
/**
 * Created by PhpStorm.
 * User: S1210307055
 * Date: 11.04.14
 * Time: 10:20
 */

class ParagonFramework_LoginController extends Pimcore_Controller_Action
{
    public function loginAction()
    {
        echo "im here in the login";
    }
    public function indexAction()
    {
        $username = Zend_Controller_Request_Http::get("username");

        var_dump($username);
        die();
        $password = Zend_Controller_Request_Http::get("password");

        echo "im here in the index";
        $this->redirect("plugin/ParagonFramework/login/login");
    }
}