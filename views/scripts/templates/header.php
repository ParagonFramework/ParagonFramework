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

        <?php $this->inlineScript()
                ->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')
                ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment.js')
                ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js')
                ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/locales/bootstrap-datetimepicker.de.js')
                ->appendFile('http://ckeditor.com/apps/ckeditor/4.4.0/ckeditor.js')
                ->appendFile('/plugins/ParagonFramework/static/js/bootstrap.min.js');
        ?>
		
	</head>
	<body>