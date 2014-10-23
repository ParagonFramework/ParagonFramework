<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= $this->title ?></title>
		<!-- Bootstrap -->
		<?php $this->headLink()
				->appendStylesheet('/plugins/ParagonFramework/static/css/bootstrap.min.css') 
				->appendStylesheet('/plugins/ParagonFramework/static/css/site.css')
				->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/bootstrap-datetimepicker.css')
				->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/pygments-manni.css')
				->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/site.css');
		?>
		<?php echo $this->headLink() ?>
		
	</head>
	<body>