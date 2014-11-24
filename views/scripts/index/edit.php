<?php
$this->headLink()
		->appendStylesheet('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css');

$this->inlineScript()
		->appendFile('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/src/js/bootstrap-datetimepicker.js');

// $this->obj is assigned in the controller/action
$id = $this->product->o_id;

// TODO: retrieve the object form view helper
$ofh = new ParagonFramework_ViewHelper($id);
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Edit Product: <?= $this->product->name ?></h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form">
				<?php
				$ofh->field("name", $this->product->name, ["label" => "Product name"]);
				//For testing purpose
				echo("Path to Snipplet: " . $this->pathToSnipplet);
				echo("Content: " . file_get_contents($this->pathToSnipplet));

				//TODO: After completion of the objectFormHelper the php content should be included
				//include($this->pathToSnipplet);
				?>
			</form>
		</div>
		<div class="panel-footer">
			<button type="submit" class="btn btn-primary"<?= $error ? ' disabled' : '' ?>>Save</button>
			<a href="<?= $this->url(['action' => 'index', 'id' => null]) ?>" class="btn btn-default">Back</a>
		</div>
	</div>
</div>