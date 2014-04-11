<?php
/**
 * Created by PhpStorm.
 * User: S1310307092
 * Date: 11.04.14
 * Time: 12:18
 */

class ParagonFramework_Wrapper_Factory
{
    public static function getWrapper()
    {
        return new ParagonFramework_PimcoreWrapper();
    }
}