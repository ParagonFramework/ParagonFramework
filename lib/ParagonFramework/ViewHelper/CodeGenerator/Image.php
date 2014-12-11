<?php

class ParagonFramework_ViewHelper_CodeGenerator_Image extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		ob_start();
		?>
		<div class="form-group">
			<label for="objectField-<?= $name ?>" class="col-sm-2 control-label"><?= $label ?></label>
			<div class="col-sm-2">
				<img src="<?= $value ?: "/image-placeholder.svg" ?>" width="100%"/>
			</div>
			<div class="col-sm-8">
				<input type="file" class="form-control" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>]" <?= $attributes ?> style="<?= $styles ?>" value="<?= $value ?>">
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

}
