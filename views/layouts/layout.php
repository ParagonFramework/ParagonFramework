<?php
$this->headLink()
		->appendStylesheet('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css')
		->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/pygments-manni.css')
		->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/site.css')
		->appendStylesheet('/plugins/ParagonFramework/static/css/site.css')
        ->appendStylesheet('/plugins/ParagonFramework/static/css/footer.css')
		->appendStylesheet('/plugins/ParagonFramework/static/css/jquery.ui.theme.css')
		->appendStylesheet('/plugins/ParagonFramework/static/css/jquery.ui.theme.font-awesome.css');
$this->inlineScript()
		//->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')
		->appendFile("//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js")
		->appendFile("//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/jquery.jqGrid.src.js")
		->appendFile("//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/i18n/grid.locale-en.js")
		->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment.js')
		->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js')
		->appendFile('http://ckeditor.com/apps/ckeditor/4.4.0/ckeditor.js')
		->appendFile('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');

$showNavigation = false;

switch ($this->getParam('controller')) {
	case 'index':
		$showNavigation = true;
		if ($this->getParam('action') == 'index') {
			$this->inlineScript()
					->appendFile('/plugins/ParagonFramework/static/js/jqgrid.js');
		}
		break;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= $this->title ?></title>
		<!-- Bootstrap -->
<?= $this->headLink() ?>
<?= $this->inlineScript() ?>
	</head>
	<body>
<?php
if ($showNavigation) {
	echo $this->partial('templates/navigationTop.php', $this);
}
?>
		<?= $this->layout()->content ?>
		<nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
			<div class="container">
				<p class="muted credit">
					<a href="<?= ParagonFramework_Plugin::$GITHubURL ?>">Paragon Framework</a>&nbsp;(<a href="<?= ParagonFramework_Plugin::$GITCommit->Link ?>">#&nbsp;<?= ParagonFramework_Plugin::$GITCommit->Hash ?></a>)
					<br/>
					&copy; 2014 <a href="<?= ParagonFramework_Plugin::$GITHubOrgURL ?>">Project Group 1</a>, a proud member of the <a href="http://www.fh-hagenberg.at/" target="_blank">FH Hagenberg</a>
				</p>
			</div>
		</nav>
	</body>