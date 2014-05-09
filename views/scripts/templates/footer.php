
		<?php $this->inlineScript()
				->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')
				->appendFile('/plugins/ParagonFramework/static/js/bootstrap.min.js')
				->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment.js')
				->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js')
				->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/locales/bootstrap-datetimepicker.de.js')
				->appendFile('http://ckeditor.com/apps/ckeditor/4.4.0/ckeditor.js');
		?>
		
		<?php echo $this->inlineScript() ?>
	</body>
</html>