<?php
/**
 * Created by PhpStorm.
 * User: S1310307109
 * Date: 04.04.14
 * Time: 09:03
 */

class ParagonUser
{
    /**
     * @var mixed $_wrapper
     */
    private $_wrapper;
    /**
     * @var int $_id
     */
    private $_id;
    /**
     * @var string $_name
     */
    private $_name;
    /**
     * @var string  $_mail
     */
    private $_mail;
    /**
     * @var string $_password
     */
    private $_password;



    function __construct(stdClass $userInfo)
    {

    }


    /* Getter and Setter*/

    /**
     * @return mixed
     */
    public function getWrapper()
    {
        return $this->_wrapper;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    public function isAllowed($controller, $action)
    {
        return true;
    }
} 