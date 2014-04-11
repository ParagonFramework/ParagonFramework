<?php

	/**
	 * Created by PhpStorm.
	 * User: S1310307109
	 * Date: 04.04.14
	 * Time: 09:03
	 */
	class ParagonFramework_Models_User
	{
		/**
		 * @var mixed $_wrapper
		 */
		private $_wrapper;
		/**
		 * @var int $_id
		 */
		private $_id;
		/**
		 * @var string $_username
		 */
		private $_username;
		/**
		 * @var string $_name
		 */
		private $_name;
		/**
		 * @var string $_mail
		 */
		private $_mail;

        /**
         * @var mixed $_permissions
         */
        private $_permissions;

		function __construct(stdClass $userInfo)
		{
			$this->_wrapper  = $userInfo->_wrapper;
            $this->_id       = $userInfo->_id;
            $this->_username = $userInfo->_username;
            $this->_name     = $userInfo->_name;
            $this->_mail     = $userInfo->_mail;

            $this->_permissions=$userInfo->_permissions;
		}

        /**
         * @return bool
         */
        public function hasPermission($perm)
        {
             if($this->_permissions[$perm]===NULL)
                 throw new ParagonFramework_Exception_PermissionException("Permission is not existing", $perm);

            return $this->_permissions[$perm];
        }


		/* Getter*/

		/**
		 * @return mixed
		 */
		public function getWrapper()
		{
			return $this->_wrapper;
		}

		/**
		 * @return string
		 */
		public function getMail()
		{
			return $this->_mail;
		}

		/**
		 * @return string
		 */
		public function getUsername()
		{
			return $this->_username;
		}

		/**
		 * @return string
		 */
		public function getName()
		{
			return $this->_name;
		}

		/**
		 * @return int
		 */
		public function getId()
		{
			return $this->_id;
		}

		public function isAllowed($controller, $action)
		{
			return true;
		}

        /**
         * @return mixed
         */
        /*public function getPermissions()
        {
            return $this->_permissions;
        }*/

    }