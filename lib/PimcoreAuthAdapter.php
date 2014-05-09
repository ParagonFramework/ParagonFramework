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
            return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, null); //TODO insert user class
    }
}