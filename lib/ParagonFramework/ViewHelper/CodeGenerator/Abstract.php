<?php

abstract class ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	protected $class;

	public function __construct($class) {
		$this->class = $class;
	}

	abstract public function getHTML($name, $label, $value, $attributes, $styles);
}
