<?php
/**
 * User: Johannes
 * Date: 04.04.14
 * Time: 10:08
 */

class Paragon_Login_Controller extends Paragon_Controller_Action {
	public function login() {
		$this->forward('authenticate', 'User_Controller');
	}
} 