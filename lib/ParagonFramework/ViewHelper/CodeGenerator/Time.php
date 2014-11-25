<?php

class ParagonFramework_ViewHelper_CodeGenerator_Time extends ParagonFramework_ViewHelper_CodeGenerator_Date {
	public function __construct($class, $type = "time") {
		parent::__construct($class, $type);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		return parent::getHTML($name, $label, $value, $attributes, $styles);
	}

}
