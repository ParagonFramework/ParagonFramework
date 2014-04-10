<?php
/**
 * User: Johannes
 * Date: 04.04.14
 * Time: 09:48
 */

class Paragon_User_Controller extends Paragon_Controller_Action {
	/* dummy */

	public function authenticate($username, $password) {
		$authAdapter = new Website_Auth_ObjectAdapter(
				'user', 'username', 'password', '/users/'#
		);

		$authAdapter->setIdentity($username)->setCredential($password);

		// Fetch Zend Authentification Object
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);

		if ($result->isValid()) {
			/* Set user active in session
			 * redirect to eg. index.php
			 */
		} else {
			/* redirect to login OR
			 * update login.php site with AJAX - f.e. "wrong password"
			 */
		}
	}
} 