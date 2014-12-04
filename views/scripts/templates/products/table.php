<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>ID</th>
			<?php foreach ($this->configReaderView->getSelect() as $e) { ?>
				<th><?= $e; ?></th>
			<?php } ?>
            <th>Status</th>
            <th>Last Modification Date</th>
            <th>Actions</th>
        </tr>
    </thead>
	<?php foreach ($this->paginator as $product) { ?>
		<tr>
			<td><?= $product->o_id ?></td>
			<?php foreach ($this->configReaderView->getSelect() as $e) { ?>
				<td>
					<?php
					$class			 = $product->getClass();
					$fieldDefintions = $class->getFieldDefinitions();
					$fieldDefintion	 = $fieldDefintions[strtolower($e)];
					$value			 = call_user_func(array($product, 'get' . $e));
					if (isset($fieldDefintion->options) && $fieldDefintion->options) {
						$options = $fieldDefintion->options;

						foreach ($options as $option) {
							$key = $option["key"];
							$val = $option["value"];

							if ((is_array($value) && in_array($val, $value)) || $val == $value) {
								echo $key . "<br>";
							}
						}
					} else {
						if ($fieldDefintion->getFieldtype() == "image" && $value) {
							echo "<img src=\"$value\" width=\"100\"/>";
						} else {
							echo $value;
						}
					}
					?>
				</td>
			<?php } ?>
			<td><?= $product->status ?></td>
			<td><?= date("d.M.Y H:i:s", $product->getModificationDate()) ?></td>
			<td><?= $this->pgProductEditForm($product->o_id, $this->url(["action" => "edit"])) ?></td>
		</tr>
	<?php } ?>
</table>
