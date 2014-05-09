<table class="table table-bordered">
	<thead>
		<tr>
			<th>SKU</th>
			<th>Product Name</th>
			<th>Product Type</th>
			<th>Status</th>
		</tr>
	</thead>
	<?php
	foreach ($this->products as $product) {
		?>
		<tr>
			<td><?php echo $product['id'] ?></td>
			<td><?php echo $product['name'] ?></td>
			<td><?php echo $product['type'] ?></td>
			<td><?php echo $product['status'] ?></td>
		</tr>
		<?php
	}
	?>
</table>