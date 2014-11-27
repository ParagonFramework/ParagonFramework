<?php

class ParagonFramework_ViewHelper_CodeGenerator_Input extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	protected $type;

	public function __construct($class, $type = "text") {
		$this->type = $type;
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		if ($value) {
			$value = "value=\"$value\"";
		}
		ob_start();
		?>
		<div class="form-group">
			<label for="objectField-<?= $name ?>" class="col-sm-2 control-label"><?= $label ?></label>
			<div class="col-sm-10">
				<input type="<?= $this->type ?>" class="form-control" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>]" <?= $attributes ?> style="<?= $styles ?>" <?= $value ?>>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

}
