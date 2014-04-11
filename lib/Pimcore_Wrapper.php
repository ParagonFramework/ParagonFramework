<?php

	/**
	 * Created by PhpStorm.
	 * User: S1210307055
	 * Date: 04.04.14
	 * Time: 09:53
	 */
	class Pimcore_Wrapper extends Abstract_Wrapper
	{
		/**
		 * @param $name
		 *
		 * @return User
		 */
		public function getUserByName($name)
		{
			$pimUser = Paragon_User::getByName($name); // get Pimcore User object

			$user           = new stdClass();
			$user->_wrapper = $this;

			$user->_id       = $pimUser->getId();
			$user->_username = $pimUser->getName();
			$user->_name     = $pimUser->getFirstname() . " " . $pimUser->getLastname();
			$user->_mail     = $pimUser->getEmail();
			$user->_password = $pimUser->getPassword();

			return new Paragon_User($user);
		}
	}