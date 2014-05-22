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
	foreach ($this->paginator as $product) {
		?>
		<tr>
			<td><?php echo $product->o_id ?></td>
			<td><?php echo $product->name ?></td>
			<td><?php echo $product->category ?></td>
			<td><?php echo $product->status ?></td>
		</tr>
		<?php
	}
	?>
</table>