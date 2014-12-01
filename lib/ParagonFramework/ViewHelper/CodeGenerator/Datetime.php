<?php

class ParagonFramework_ViewHelper_CodeGenerator_Datetime extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	public function __construct($class) {
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$date	 = $value->get("yyyy-MM-dd");
		$time	 = $value->get("HH:mm:ss");
		ob_start();
		?>
		<div class="form-group">
			<label for="objectField-<?= $name ?>" class="col-sm-2 control-label"><?= $label ?></label>
			<div class="col-sm-4">
				<div class='input-group date'>
					<input type='date' class="form-control" class="form-control" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>][]" <?= $attributes ?> style="<?= $styles ?>" value="<?= $date ?>">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class='input-group date'>
					<input type='time' class="form-control" class="form-control" id="objectField-<?= $name ?>" name="objectField[<?= $name ?>][]" <?= $attributes ?> style="<?= $styles ?>" value="<?= $time ?>">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</div>
			</div>
		</div>
		<?php
		$html	 = ob_get_clean();
		return $html;
	}

}
