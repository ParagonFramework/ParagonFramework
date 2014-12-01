<?php

class ParagonFramework_ViewHelper_CodeGenerator_Date extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	private $type;

	public function __construct($class, $type = "date") {
		parent::__construct($class);
		$this->type = $type;
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		if ($value && $this->type == "date") {
			$value = $value->get("yyyy-MM-dd");
		}
		$value		 = "value=\"$value\"";
		ob_start();
		?>
		<div class="form-group">
			<label for="objectField-<?= $name ?>" class="col-sm-2 control-label"><?= $label ?></label>
			<div class="col-sm-4">

				<div class='input-group date'>
					<input type='<?= $this->type ?>' class="form-control" class="form-control" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>]" <?= $attributes ?> style="<?= $styles ?>" <?= $value ?>>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</div>
			</div>
		</div>
		<?php
		$html		 = ob_get_clean();
		return $html;
	}

}
