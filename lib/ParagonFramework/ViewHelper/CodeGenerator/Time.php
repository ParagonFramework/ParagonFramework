<?php

class ParagonFramework_ViewHelper_CodeGenerator_Time extends ParagonFramework_ViewHelper_CodeGenerator_Date {

	public function __construct($class) {
		parent::__construct($class, "time");
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		return parent::getHTML($name, $label, $value, $attributes, $styles);
	}

}
