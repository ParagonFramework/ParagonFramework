<?php

class ParagonFramework_ViewHelper_CodeGenerator_Numeric extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$codeGenerator = new ParagonFramework_ViewHelper_CodeGenerator_Input();
		return $codeGenerator->getHTML($name, $label, $value, $attributes, $styles);
	}

}
