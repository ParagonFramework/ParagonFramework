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

	/**
	 * @param type $id The ID of the object on which the ViewHelper should work upon.
	 */
	public function __construct($id) {
		$object		 = Object_Abstract::getById($id);
		$this->class = $object->getClass();
	}

	/**
	 * This function generates a HTML tag according to the objects class. 
	 * 
	 * @param type $name
	 * @param type $value Default value of the generated HTML.
	 * @param type $attributes Additional attributes that should be added to the HTML tag.
	 * @param type $styles Styles that should be added to the HTML tag.
	 * @return type The generated HTML tag as output.
	 */
	public function field($name, $value = "", $attributes = [], $styles = []) {
		// Fetches the definition of the field to be generated.
		$fieldDefinitions	 = $this->class->getFieldDefinitions();
		$fieldDefinition	 = $fieldDefinitions[$name];

		if (!$fieldDefinition) {
			// Check if the field definition exists 
			throw "The field '$name' is not correctly defined. Check if a class definition for this field exists in pimcore.";
		}

		// Generate the class name of the code generator.
		$fieldType				 = ucfirst($fieldDefinition->fieldtype);
		$codeGeneratorClassName	 = "ParagonFramework_ViewHelper_CodeGenerator_$fieldType";

		if (!class_exists($codeGeneratorClassName)) {
			// Checks if the code generator exists. If not an error message is thrown.
			throw "No code generator found for the field type: '$fieldType'<br>";
		}
		
		// If the code generator exists it's instantiated. 
		$codeGenerator = new $codeGeneratorClassName($this->class);

		// Fetches a label for the generated HTML tag.
		if (key_exists("label", $attributes)) {
			$label = $attributes["label"];
			unset($attributes["label"]);
		} else {
			$label = $name;
		}
		
		// Generates a string with all the attributes.
		$attribute = " ";
		foreach ($attributes as $key => $val) {
			$attribute .= "$key=\"$val\"";
		}
		
		// Generates a string with all the styles.
		$style = "";
		foreach ($styles as $key => $val) {
			$style .= "$key: $val;";
		}
		
		// Generates the HTML tag.
		echo $codeGenerator->getHTML($name, $label, $value, $attribute, $style);
	}

}
