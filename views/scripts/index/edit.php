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

    <div class="pull-right">
        <form role="form" id="loginform" method="post" action="index">
            <button type="submit" class="btn btn-default">Save</button>
        </form>
    </div>
</div>

