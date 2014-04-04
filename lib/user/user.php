<?php
/**
 * Created by PhpStorm.
 * User: S1310307109
 * Date: 04.04.14
 * Time: 09:03
 */

class user
{
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var string  $mail
     */
    private $mail;
    /**
     * @var string $password
     */
    private $password;


    function __construct($name, $mail, $pwd)
    {
        $this->setName($name);
        $this->setMail($mail);
        $this->setPassword($pwd);
    }


    /* Getter and Setter*/

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
} 