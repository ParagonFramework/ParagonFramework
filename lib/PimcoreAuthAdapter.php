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

    /**
     * creates Auth Adapter
     * hashes the password with Pimcore_Tool_Authentication
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = Pimcore_Tool_Authentication::getPasswordHash($username, $password);
    }

    /**
     * authenticates the user, writes the user object into session if it worked
     * @return Zend_Auth_Result
     */
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

        $list = new User_Permission_Definition_List();
        $definitionsData = $list->load();

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
                    if($perm == $def->getKey())
                    {
                        $hasPermission = true;
                    }
                }
            }
            $arr[$def->getKey()] = $hasPermission;
        }

        $user->_permissions = $arr;
        return new ParagonFramework_Models_User($user);
    }
}