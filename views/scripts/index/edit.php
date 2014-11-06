<?php
$this->headLink()
		->appendStylesheet('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css');
$this->inlineScript()
		->appendFile('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/src/js/bootstrap-datetimepicker.js');

$product = $this->product;
$error	 = $this->error;
?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Edit Product: <?= $product->name ?></h3>
		</div>
		<form role="form" id="loginform" method="post" action="<?= $this->url(array('controller' => 'index', 'action' => 'update', 'id' => $product->o_id)) ?>" class="form-horizontal" role="form">
			<div class="panel-body">
				<?php
				if ($error) {
					?>
					<div class="alert alert-danger" role="alert"><?= $error ?></div>
					<?php
				}
				?>
				<div class="row">
					<div class="col-md-6 borderRight">
						<div class="border">
							<h3>General Information</h3>
							<div class="form-group">
								<label for="id" class="col-sm-2 control-label">SKU</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="id" name="id" value="<?= $product->o_id ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="category" class="col-sm-2 control-label">Category</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="category" name="category" placeholder="Category" value="<?= $product->category ?>">
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="panel-footer">
				<div class="">
					<button type="submit" class="btn btn-primary"<?= $error ? ' disabled' : ''?>>Save</button>
					<a href="/plugin/ParagonFramework/index/index" class="btn btn-default">Back</a>
				</div>
				<input type="hidden" name="modificationDate" value="<?= $product->getModificationDate(); ?>">
			</div>
		</form>
	</div>

</div>

