<?php

class ParagonFramework_ViewHelper_CodeGenerator_Input extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function getHTML($name, $label, $value, $attributes, $styles) {
		if ($value) {
			$value = "value=\"$value\"";
		}
		$html = <<<HTML
				<div class="form-group">
					<label for="objectField-$name" class="col-sm-2 control-label">$label</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="objectField-$name" name="objectField[$name]" $attributes style="$styles" $value>
					</div>
				</div>
HTML;
		return $html;
	}

}
