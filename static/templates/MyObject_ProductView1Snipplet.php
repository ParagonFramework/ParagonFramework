<!-- there should be a generic endpoint where the data from the widgets can be sent to -->
<form class="form-horizontal" role="form" action="/plugin/ObjectForm/generic/save/id/<?= $object->getId(); ?>">
	
	<!-- 
		this is an example with multiple fields in a form
	-->
	
	<?= $ofh->field("myWYSIWYGField",[
		"width" => 300,
		"height" => 120
	]) ?>
	
	<?= $ofh->field("myNumericField") ?>
	
	<?= $ofh->field("myTextareaField",[
		"width" => 300,
		"height" => 120
	]) ?>
	
	<?= $ofh->field("myDateTimeField") ?>

	<?= $ofh->field("myMultiSelectField",[
		"label" => "asdf"
	]) ?>

	<?= $ofh->field("myTimeField") ?>
</form>
