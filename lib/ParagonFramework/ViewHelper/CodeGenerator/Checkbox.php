<?php

class ParagonFramework_ViewHelper_CodeGenerator_Checkbox extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$checked = $value ? "checked" : "";
		ob_start();
		?>
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<div class="checkbox">
					<label>
						<input type="hidden" name="objectField[<?= $name ?>]" value="0"/>
						<input type="checkbox" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>]" value="1" <?= $attributes ?> style="<?= $styles ?>" <?= $checked ?>> <?= $label ?>
					</label>
				</div>			
			</div>
		</div>			
		<?php
		$html	 = ob_get_clean();
		return $html;
	}

}
