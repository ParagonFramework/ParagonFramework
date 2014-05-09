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
        /*if($this->getParam("message") != null)
            $this->view->message = "Invalid Username or Password";
        else
            $this->view->message = "";*/

        $this->view->message = $this->getParam("message", "");
    }

    public function loginAction()
    {
        $username = $this->getRequest()->getParam('username', '');
        $password = $this->getRequest()->getParam('password', '');

        $wrapper = ParagonFramework_Wrapper_Factory::getWrapper();
        if($wrapper->authenticateUser($username, $password) === true)
        {
            //$this->forward("index", "start", "ParagonFramework");
             //exit;
            $this->forward("index", "start", "ParagonFramework");
            //die("user authenticated");
        }
        else
        {
            //$this->view->assign('data', "test");
            //$this->view->myVar = "sth";
            //$this->view->menu = "test";
            //$referrer = $_SERVER['REQUEST_URI'];
            //$params = array("referrer" => base64_encode($referrer), "controller" => "login", "action" => "index");
            //$this->redirect("?".array_urlencode($params));
            //die("not authenticated");
            //$this->setParam("message", "Invalid username or password");
            $this->forward("index", "login", "ParagonFramework", array("message" => "Invalid username or password")); // /error/1023            //exit;
        }
    }
	
	public function logoutAction() {
		$instance = Zend_Auth::getInstance();
		$instance->clearIdentity();
		$this->forward("index", "login", "ParagonFramework", array("message" => "Auf Wiedersehen!"));
	}
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
