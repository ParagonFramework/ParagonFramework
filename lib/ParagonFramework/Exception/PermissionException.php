<?php
/**
 * Created by PhpStorm.
 * User: S1310307109
 * Date: 11.04.14
 * Time: 09:12
 */


class ParagonFramework_Exception_PermissionException extends Exception
{
    function __construct($message, $permission)
    {
       parent::__construct($message." with role: ".$permission);
    }
} 