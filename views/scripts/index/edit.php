<?php

$this->headLink()
    ->appendStylesheet('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css');

$this->inlineScript()
    ->appendFile('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/src/js/bootstrap-datetimepicker.js');

	// $this->obj is assigned in the controller/action
	$object = $this->product;

	// TODO: retrieve the object form view helper
	// $ofh = $this->objectForm($object->getId());
?>

<div class="container">
    <div class="page-header">
        <p class="lead">Edit Product: <?= $this->product->name ?></p>

    </div>

    <?php
        //For testing purpose
        echo("Path to Snipplet: " . $this->pathToSnipplet);
        echo("Content: " . file_get_contents($this->pathToSnipplet));

        //TODO: After completion of the objectFormHelper the php content should be included
        //include($this->pathToSnipplet);

    ?>

    <div class="panel-footer">
        <div class="">
            <button type="submit" class="btn btn-primary"<?= $error ? ' disabled' : ''?>>Save</button>
            <a href="<?= $this->url(['action' => 'index', 'id' => null]) ?>" class="btn btn-default">Back</a>
        </div>
        <input type="hidden" name="modificationDate" value="<?= $product->getModificationDate(); ?>">
    </div>
</div>

