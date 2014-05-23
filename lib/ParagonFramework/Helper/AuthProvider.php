<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ParagonFramework_Helper_AuthProvider implements Zend_Auth_Adapter_Interface {
    private 
        $_username, 
        $_password, 
        $_user;
    
    public function __construct($username, $password) {        
        $this->_username = $username;
        $this->_password = $password;
    }
    
    private function getUserObject($pimcoreUser)
    {
        $user = new stdClass();
        $user->_wrapper = $this;

        $user->_id = $pimcoreUser->getId();
        $user->_username = $pimcoreUser->getName();
        $user->_name = $pimcoreUser->getFirstname() . " " . $pimcoreUser->getLastname();
        $user->_mail = $pimcoreUser->getEmail();
        $user->_password = $pimcoreUser->getPassword();
        $user->_image = $pimcoreUser->getImage();

        $list = new User_Permission_Definition_List();
        $definitionsData = $list->load();

        $isAdmin = $pimcoreUser->isAdmin();
        $pimPermissions = $pimcoreUser->getPermissions();

        $roleIds = $pimcoreUser->getRoles();

        foreach($roleIds as $roleId)
        {
            $role = User_Role::getById($roleId);
            $pimPermissions = array_merge($pimPermissions, $role->getPermissions());
        }

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
    
    public function authenticate() {
        $this->_user = Pimcore_Tool_Authentication::authenticatePlaintext($this->_username, $this->_password);
        
        if($this->_user instanceof User) {
            return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->getUserObject($this->_user));
        }
       
        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null);
    }
}