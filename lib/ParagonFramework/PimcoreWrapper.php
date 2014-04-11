<?php
/**
 * Created by PhpStorm.
 * User: S1210307055
 * Date: 04.04.14
 * Time: 09:53
 */

class ParagonFramework_PimcoreWrapper extends ParagonFramework_AbstractWrapper
{
    /**
     * @param $name
     *
     * @return User
     */
    public function getUserByName($name)
    {
        $pimUser = User::getByName($name); // get Pimcore User object

        $user = new stdClass();
        $user->_wrapper = $this;

        $user->_id = $pimUser->getId();
        $user->_username = $pimUser->getName();
        $user->_name = $pimUser->getFirstname()." ".$pimUser->getLastname();
        $user->_mail = $pimUser->getEmail();
        $user->_password = $pimUser->getPassword();

        $con = Pimcore_Resource::getConnection();
        $definitionsData = $con->fetchAll("SELECT * FROM users_permission_definitions");

        $isAdmin = $pimUser->isAdmin();
        $pimPermissions = $pimUser->getPermissions();

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
        return new ParagonFramework_Models_User($user);
    }
}