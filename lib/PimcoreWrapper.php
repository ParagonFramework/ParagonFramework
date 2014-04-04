<?php
/**
 * Created by PhpStorm.
 * User: S1210307055
 * Date: 04.04.14
 * Time: 09:53
 */

class PimcoreWrapper extends AbstractWrapper
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
        $user->_name = $pimUser->getName();
        $user->_mail = $pimUser->getEmail();
        $user->_password = $pimUser->getPassword();

        return new ParagonUser($user);
    }
}