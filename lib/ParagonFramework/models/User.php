   <?php

	/**
	 * Created by PhpStorm.
	 * User: S1310307109
	 * Date: 04.04.14
	 * Time: 09:03
	 */

/**
 * Class ParagonFramework_Models_User
 *
 * Usage:
 * $pcw = new ParagonFramework_PimcoreWrapper();
 * $user=$pcw->getUserByName("localhorst");
 * $b1=$user->hasPermission("qr_codes");
 * $b2=$user->hasPermission("horstiborsti"); -> throws Exception
 *
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
         * @var string $_image
         */
        private $_image;

        /**
         * @var mixed $_permissions
         */
        private $_permissions;

        const sessionName = 'Role';
        const lifeTime = 2592000;

		function __construct(stdClass $userInfo)
		{
			$this->_wrapper  = $userInfo->_wrapper;
            $this->_id       = $userInfo->_id;
            $this->_username = $userInfo->_username;
            $this->_name     = $userInfo->_name;
            $this->_mail     = $userInfo->_mail;
            $this->_image    = $userInfo->_image;

            $this->_permissions=$userInfo->_permissions;

            /*error_reporting(E_ALL|E_STRICT);
            ini_set('display_errors', 'on');*/
       	}

        /**
         * Checks if the user has the permission $perm. If the permission does not exists an exception is thrown.
         * @param string $perm
         *
         * @return bool
         * @throws ParagonFramework_Exception_PermissionException
         */
        public function hasPermission($perm)
        {
             if($this->_permissions[$perm]===NULL)
                 throw new ParagonFramework_Exception_PermissionException("Permission is not existing", $perm);

            return $this->_permissions[$perm];
        }

        /**
         * Returns an array of all permissions the user has.
         * @return array
         */
        public function getPermissions()
        {
            $result = NULL;
            $keys = array_keys($this->_permissions);

            foreach ($keys as $key)
            {
                if($this->_permissions[$key]===true)
                    $result[] = $key;
            }

            return $result;
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

        /**
         * returns the preferred Role which is stored in session
         * if there is no stored role than it returns default role
         * @return mixed role
         * @return string
         */
        public function getImage()
        {
            return $this->_image;
        }

        /**
         * Returns the currently set user role (if set, from the cookies, otherwise from the database).
         * @return string
         */

        public function getRole()
        {
            $sessionNamespace = new Zend_Session_Namespace(self::sessionName.'_'.$this->_username);
            Zend_Session::rememberMe(self::lifeTime);

            if (!isset($sessionNamespace->preferredRole))
            {
                $sessionNamespace->preferredRole = $this->getPermissions()[0];
            }
            return $sessionNamespace->preferredRole;
        }

        /**
         * sets the role as preferred and stores it in session
         * @param string $role
         */
        public function setRole($role)
        {
            $sessionNamespace = new Zend_Session_Namespace(self::sessionName.'_'.$this->_username);
            Zend_Session::rememberMe(self::lifeTime);
            $sessionNamespace->preferredRole = $role;
        }

        public static function getUser()
        {
            return Zend_Auth::getInstance()->getIdentity();
        }
    }