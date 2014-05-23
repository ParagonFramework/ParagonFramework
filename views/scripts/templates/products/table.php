<table class="table table-bordered">
	<thead>
		<tr>
			<th>SKU</th>
			<th>Product Name</th>
			<th>Product Type</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<?php
	foreach ($this->products as $product) {
		?>
		<tr>
			<td><?php echo $product->o_id ?></td>
			<td><?php echo $product->name ?></td>
			<td><?php echo $product->category ?></td>
			<td><?php echo $product->status ?></td>
			<td>
				<input type="button" value="Edit"/>
			</td>
		</tr>
		<?php
	}
	?>
</table>
