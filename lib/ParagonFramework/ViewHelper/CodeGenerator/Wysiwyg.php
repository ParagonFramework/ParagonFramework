<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wysiwyg
 *
 * @author Johannes
 */
class ParagonFramework_ViewHelper_CodeGenerator_Wysiwyg extends ParagonFramework_ViewHelper_CodeGenerator_Textarea {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$html = parent::getHTML($name, $label, $value, $attributes, $styles);
		
		ob_start();
		?>
		<script type="text/javascript">
		    CKEDITOR.replace('objectField-<?= $name ?>');
		</script>
		<?php
		$html .= ob_get_clean();
		return $html;
	}

}
