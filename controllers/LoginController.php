<?php

/**
 * Created by PhpStorm.
 * User: S1310307092
 * Date: 11.04.14
 * Time: 11:54
 */
class ParagonFramework_LoginController extends Pimcore_Controller_Action {

	/**
	 * Sets parameter into view
	 */
	public function indexAction() {
		/* if($this->getParam("message") != null)
		  $this->view->message = "Invalid Username or Password";
		  else
		  $this->view->message = ""; */

		$this->view->message = $this->getParam("message", "");
	}

	/**
	 * Checks username and password from User
	 */
	public function loginAction() {
		$request = $this->getRequest();

		$username = $request->getParam('username', '');
		$password = $request->getParam('password', '');



		/*
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
		 */

		$authAdapter = new ParagonFramework_Helper_AuthProvider($username, $password);
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);

		if (!$result->isValid()) {
			//$this->forward("index", "login", null, array("message" => "Username or password invalid"));
			$this->forward("index", "login", "ParagonFramework", array("message" => "Invalid username or password"));
		} else {
			$this->forward("index", "index", "ParagonFramework", null);
		}
	}

	/**
	 * clears the current identity from Zend_Auth and destroys the session, than forwards to index_login
	 */
	public function logoutAction() {
        if (ParagonFramework_Models_User::getUser() != null) {
            $instance = Zend_Auth::getInstance();

            $instance->clearIdentity();
        }

		//DO NOT activate this statement because it causes problems with session namespaces
		//logout works anyway
		//Zend_Session::destroy();

		$this->forward("index", "login", "ParagonFramework", array("message" => "Auf Wiedersehen!"));
	}

}
