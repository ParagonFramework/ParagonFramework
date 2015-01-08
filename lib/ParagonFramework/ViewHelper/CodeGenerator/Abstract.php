<?php

abstract class ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	protected $class;

	public function __construct($class) {
		$this->class = $class;
	}

	/**
	 * Generates an HTML tag according to the CodeGenerator class. 
	 */
	abstract public function getHTML($name, $label, $value, $attributes, $styles);
}
