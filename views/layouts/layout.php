<?php
$this->headLink()
    ->appendStylesheet('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css')
    ->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/pygments-manni.css')
    ->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/site.css')
    ->appendStylesheet('/plugins/ParagonFramework/static/css/jquery.ui.theme.css')
    ->appendStylesheet('/plugins/ParagonFramework/static/css/jquery.ui.theme.ui-jqgrid.css')
    ->appendStylesheet('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css')
    ->appendStylesheet('/plugins/ParagonFramework/static/css/jquery.ui.theme.font-awesome.css')
    ->appendStylesheet('/plugins/ParagonFramework/static/css/site.css');
$this->inlineScript()
    //->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')
    ->appendFile("//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js")
    ->appendFile("//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/jquery.jqGrid.src.js")
    ->appendFile("//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/i18n/grid.locale-en.js")
    ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment.js')
    ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js')
    ->appendFile('http://ckeditor.com/apps/ckeditor/4.4.0/ckeditor.js')
    ->appendFile('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js')
    ->appendFile('/plugins/ParagonFramework/static/js/view-switching.js');

$showNavigation = false;

switch ($this->getParam('controller')) {
    case 'index':
        $showNavigation = true;
        if($this->getParam('action') == 'index') {
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
        <div class="container" id="container">
            <!-- View switching dialog -->
            <div id="viewSwitchingDialog" class="viewSwitchingDialog" style="display: none;">
                <form role="form" method="post" action="<?= $this->url(["action" => "changerole"]) ?>">
                    <input type="hidden" name="viewSwitchingDialog_Selected" id="viewSwitchingDialog_Selected" />
                    <h3><?= $this->t('Choose your view') ?></h3>
                    <br/>
                    <div class="form-group" style="display: inline-block;">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                <span name="viewSwitchingDialog_Label" id="viewSwitchingDialog_Label"></span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" name="viewSwitchingDialog_Dropdown" id="viewSwitchingDialog_Dropdown">
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= $this->t('OK') ?></button>
                        <input type="button" class="btn btn-default" value="<?= $this->t('Cancel') ?>" name="btnCancel" onclick="toggle_visibility('viewSwitchingDialog');" />
                    </div>
                </form>
            </div>
            <?= $this->layout()->content ?>
        </div>
		<div class="clearfix"></div>
-		<nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
			<div class="container">
				<p class="muted credit">
					<a href="<?= ParagonFramework_Plugin::$GITHubURL ?>">Paragon Framework</a>&nbsp;(<a href="<?= ParagonFramework_Plugin::$GITCommit->Link ?>">#&nbsp;<?= ParagonFramework_Plugin::$GITCommit->Hash ?></a>)
					<br/>
					&copy; 2014 <a href="<?= ParagonFramework_Plugin::$GITHubOrgURL ?>">Project Group 1</a>, a proud member of the <a href="http://www.fh-hagenberg.at/" target="_blank">FH Hagenberg</a>
				</p>
			</div>
		</nav>
	</body>
</html>