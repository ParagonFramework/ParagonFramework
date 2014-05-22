<?php
/**
 * User: Johannes
 * Date: 04.04.14
 */

class ParagonFramework_Models_Product extends Pimcore {

    private $id;
    /* @var string */
    private $name;
    /* @var string */
    private $type;
    /* @var string */
    private $status;

    function __construct($id, $name, $status, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->type = $type;
    }

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}


} 