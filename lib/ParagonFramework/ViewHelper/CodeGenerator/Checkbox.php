<?php

class ParagonFramework_ViewHelper_CodeGenerator_Checkbox extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$checked = $value ? true : false;
		$html = <<<HTML
<div class="checkbox">
	<label>
		<input type="checkbox" $attributes style="$styles" $checked> $label
	</label>
</div>			
HTML;
		return $html;
	}

}
