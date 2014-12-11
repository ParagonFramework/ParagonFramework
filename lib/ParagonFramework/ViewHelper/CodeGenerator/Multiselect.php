<?php

class ParagonFramework_ViewHelper_CodeGenerator_Multiselect extends ParagonFramework_ViewHelper_CodeGenerator_Select {
	
	public function __construct($class) {
		parent::__construct($class, "multiple multiselect");
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		return parent::getHTML($name, $label, $value, $attributes, $styles);
	}

}
