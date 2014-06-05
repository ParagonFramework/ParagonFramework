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
	foreach ($this->paginator as $product) {
		?>
		<tr>
			<td><?php echo $product->o_id ?></td>
			<td><?php echo $product->name ?></td>
			<td><?php echo $product->category ?></td>
			<td><?php echo $product->status ?></td>
			<td>
				<form role="form" id="loginform" method="post" action="edit">
					<button type="submit" class="btn btn-default">Edit</button>
					<input type="hidden" name="o_id" value="<?= $product->o_id ?>"/>
				</form>
			</td>
		</tr>
		<?php
	}
	?>
</table>
