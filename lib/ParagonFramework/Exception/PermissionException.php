<?php
/**
 * Created by PhpStorm.
 * User: S1310307109
 * Date: 11.04.14
 * Time: 09:12
 */


class ParagonFramework_Exception_PermissionException extends Exception
{
    /**
     * @var string $_permission
     */
    private $_permission;

    function __construct($message, $perm)
    {
       $this->_permission=$perm;
       parent::__construct($message." with role: ".$this->permission);
    }

    /**
     * @return string
     */
    public function getPermission()
    {
        return $this->_permission;
    }
} 