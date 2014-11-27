<?php

class ParagonFramework_ViewHelper_CodeGenerator_Textarea extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		ob_start();
		?>
		<div class="form-group">
			<label for="objectField-<?= $name ?>" class="col-sm-2 control-label"><?php $label ?></label>
			<div class="col-sm-10">
				<textarea class="form-control" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>]" <?= $attributes ?> style="<?= $styles ?>"><?= $value ?></textarea>
			</div>
		</div>

		<?php
		$html = ob_get_clean();
		return $html;
	}

}
