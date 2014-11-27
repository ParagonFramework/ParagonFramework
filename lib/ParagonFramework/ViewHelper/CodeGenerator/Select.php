<?php

class ParagonFramework_ViewHelper_CodeGenerator_Select extends ParagonFramework_ViewHelper_CodeGenerator_Abstract {

	private $type;

	public function __construct($class, $type = "") {
		$this->type = $type;
		parent::__construct($class);
	}

	public function getHTML($name, $label, $value, $attributes, $styles) {
		$value		 = is_array($value) ? $value : [$value];
		$category	 = $this->class->getFieldDefinitions()[$name];

		ob_start();
		?>
		<div class="form-group">
			<label for="objectField-<?= $name ?>" class="col-sm-2 control-label"><?= $label ?></label>
			<div class="col-sm-10">
				<select id="objectField-<?= $name ?>" name="objectField[<?= $name ?>][]" class="form-control" <?= $attributes ?> style="<?= $styles ?>" <?= $this->type ?>>
					<?php
					foreach ($category->options as $option) {
						$key		 = $option["key"];
						$val		 = $option["value"];
						$selected	 = in_array($val, $value) ? " selected" : "";
						?>
						<option value='<?= $val ?>'<?= $selected ?>><?= $key ?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

}
