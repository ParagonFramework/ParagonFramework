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
     * @var int $id
     */
    private $id;
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


    function __construct($c_id, $c_name, $c_mail, $c_pwd)
    {
        $this->setId($c_id);
        $this->setName($c_name);
        $this->setMail($c_mail);
        $this->setPassword($c_pwd);
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

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
} 