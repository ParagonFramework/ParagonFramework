<?php

class ParagonFramework_ViewHelper_CodeGenerator_Image extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$codeGenerator = new ParagonFramework_ViewHelper_CodeGenerator_Input();
		return $codeGenerator->getHTML($name, $label, $value, $attributes, $styles);
	}

}
