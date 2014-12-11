<?php

class ParagonFramework_ViewHelper_CodeGenerator_Numeric extends ParagonFramework_ViewHelper_CodeGenerator_Input {

	public function __construct($class) {
		parent::__construct($class, "number");
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		return parent::getHTML($name, $label, $value, $attributes, $styles);
	}

}
