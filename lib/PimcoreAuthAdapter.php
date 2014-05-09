<?php
/**
 * Created by PhpStorm.
 * User: S1310307092
 * Date: 08.05.14
 * Time: 10:08
 */

class PimcoreAuthAdapter implements Zend_Auth_Adapter_Interface
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = Pimcore_Tool_Authentication::getPasswordHash($username, $password);
    }

    public function authenticate()
    {
        $pimUser = User::getByName($this->username);

        if($pimUser == null)
            return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, null);

        $pimPass = $pimUser->getPassword();

        if($pimPass != $this->password)
            return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null);
        else
            return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->getUserObject($pimUser));
    }

    private function getUserObject($pimcoreUser)
    {
        $user = new stdClass();
        $user->_wrapper = $this;

        $user->_id = $pimcoreUser->getId();
        $user->_username = $pimcoreUser->getName();
        $user->_name = $pimcoreUser->getFirstname()." ".$pimcoreUser->getLastname();
        $user->_mail = $pimcoreUser->getEmail();
        $user->_password = $pimcoreUser->getPassword();

        $con = Pimcore_Resource::getConnection();
        $definitionsData = $con->fetchAll("SELECT * FROM users_permission_definitions");

        $isAdmin = $pimcoreUser->isAdmin();
        $pimPermissions = $pimcoreUser->getPermissions();

        $arr = null;
        foreach($definitionsData as $def)
        {
            if($isAdmin)
            {
                $hasPermission = true;
            }
            else
            {
                $hasPermission = false;
                foreach($pimPermissions as $perm)
                {
                    if($perm == $def["key"])
                    {
                        $hasPermission = true;
                    }
                }
            }
            $arr[$def["key"]] = $hasPermission;

        }

        $user->_permissions = $arr;
        return new ParagonFramework_Model_User($user);
    }
}