<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewHelper
 *
 * @author Johannes
 */
class ParagonFramework_ViewHelper extends Zend_View_Helper_Abstract {

	private $class;

	public function __construct($id) {
		$object		 = Object_Abstract::getById($id);
		$this->class = $object->getClass();
	}

	public function field($name, $value = "", $attributes = [], $styles = []) {
		$fieldDefinitions	 = $this->class->getFieldDefinitions();
		$fieldDefinition	 = $fieldDefinitions[$name];

		$fieldType				 = ucfirst($fieldDefinition->fieldtype);
		$codeGeneratorClassName	 = "ParagonFramework_ViewHelper_CodeGenerator_$fieldType";
		
		if (!class_exists($codeGeneratorClassName)) {
			echo "No code generator found for the field type: '$fieldType'";
			return;
		}
		$codeGenerator = new $codeGeneratorClassName();

		if (key_exists("label", $attributes)) {
			$label = $attributes["label"];
			unset($attributes["label"]);
		} else {
			$label = $name;
		}
		$attribute = "";
		foreach ($attribute as $key => $value) {
			$attribute .= "$key=\"$value\"";
		}
		$style = "";
		foreach ($styles as $key => $value) {
			$style .= "$key: $value;";
		}
		echo $codeGenerator->getHTML($name, $label, $value, $attributes, $styles);
	}

}
