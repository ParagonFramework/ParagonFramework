<?php
/**
 * Created by PhpStorm.
 * User: S1310307092
 * Date: 11.04.14
 * Time: 11:54
 */

class ParagonFramework_LoginController extends Pimcore_Controller_Action
{
    /**
     * Sets parameter into view
     */
    public function indexAction()
    {
        /*if($this->getParam("message") != null)
            $this->view->message = "Invalid Username or Password";
        else
            $this->view->message = "";*/

        $this->view->message = $this->getParam("message", "");
        $this->view->message_color = $this->getParam("message_color", "");
    }

    /**
     * Checks username and password from User
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        
        $username = $request->getParam('username', '');
        $password = $request->getParam('password', '');
        
        $authAdapter = new ParagonFramework_Helper_AuthProvider($username, $password);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
	
        if (!$result->isValid())
        {
            $this->forward("index", "login", "ParagonFramework", array("message_color" => 'red', "message" => "Invalid username or password"));
        }
        else
        {
            $this->forward("index", "index", "ParagonFramework", null);
        }
    }

    /**
     * clears the current identity from Zend_Auth and destroys the session, than forwards to index_login
     */
    public function logoutAction() {
        $instance = Zend_Auth::getInstance();
        $instance->clearIdentity();

        $this->forward("index", "login", "ParagonFramework", array("message_color" => 'green', "message" => "Auf Wiedersehen!"));
    }
}