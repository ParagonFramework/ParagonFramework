<?php

class ParagonFramework_ViewHelper_CodeGenerator_Checkbox extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$checked = $value ? true : false;
		ob_start();
		?>
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<div class="checkbox">
					<label>
						<input type="checkbox" <?= $attributes ?> style="<?= $styles ?>" <?= $checked ?>> <?= $label ?>
					</label>
				</div>			
			</div>
		</div>			
		<?php
		$html	 = ob_get_clean();
		return $html;
	}

}
