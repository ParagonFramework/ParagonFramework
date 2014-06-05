
<?php
$this->inlineScript()
		->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')
		->appendFile('/plugins/ParagonFramework/static/js/bootstrap.min.js')
		->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment.js')
		->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js')
		->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/locales/bootstrap-datetimepicker.de.js')
		->appendFile('http://ckeditor.com/apps/ckeditor/4.4.0/ckeditor.js');
?>

<?php echo $this->inlineScript() ?>

<nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<div class="container">
		<p class="muted credit">
			<a href="https://193.170.192.154/">Paragon Framework</a>&nbsp;(<a href="<?= ParagonFramework_Plugin::$GITCommit->Link ?>">#&nbsp;<?= ParagonFramework_Plugin::$GITCommit->Hash ?></a>)
			<br/>
			&copy; 2014 <a href="https://193.170.192.154/">Project Group 1</a>, a proud member of the <a href="http://www.fh-hagenberg.at/" target="_blank">FH Hagenberg</a>
		</p>
	</div>
</nav>
</body>
</html>