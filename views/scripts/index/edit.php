<?php
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
		<form method="POST" class="form-horizontal" role="form" action="<?= $this->url(['action' => 'update', 'id' => null]) ?>">
			<div class="panel-body">
				<?php
				$ofh->field("name", $this->product->name, ["label" => "Product name"]);
				$ofh->field("productnumber", $this->product->productnumber, ["label" => "Product number"]);
				$ofh->field("category", $this->product->category);
				$ofh->field("os", $this->product->os);
				$ofh->field("description", $this->product->description, ["rows" => 3]);
				$ofh->field("image", $this->product->image);
				$ofh->field("details", $this->product->details);
				$ofh->field("releasedate", $this->product->releasedate);
				$ofh->field("releasetime", $this->product->releasetime);
				$ofh->field("lastmodified", $this->product->lastmodified);
				$ofh->field("finished", $this->product->finished);

				//For testing purpose
//				echo("Path to Snipplet: " . $this->pathToSnipplet);
//				echo("Content: " . file_get_contents($this->pathToSnipplet));

				//TODO: After completion of the objectFormHelper the php content should be included
				//include($this->pathToSnipplet);
				?>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary">Save</button>
				<a href="<?= $this->url(['action' => 'index', 'id' => null]) ?>" class="btn btn-default">Back</a>
			</div>
			<input type="hidden" name="objectField[id]" id="objectField-id" value="<?= $id ?>"/>
		</form>
	</div>
</div>