<?php
/**
 * Created by PhpStorm.
 * User: S1210307055
 * Date: 10.04.14
 * Time: 10:41
 */

abstract class ParagonFramework_AbstractWrapper
{
    public abstract function getUserByName($name);
    public abstract function authenticateUser($username, $password);
}
