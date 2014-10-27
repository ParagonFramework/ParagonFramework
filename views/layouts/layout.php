<?php
$this->headLink()
    ->appendStylesheet('/plugins/ParagonFramework/static/css/bootstrap.min.css')

    ->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/pygments-manni.css')
    ->appendStylesheet('http://eonasdan.github.io/bootstrap-datetimepicker/content/site.css')

    ->appendStylesheet('/plugins/ParagonFramework/static/css/site.css');

$this->inlineScript()
    ->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')

    ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment.js')
    ->appendFile('http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js')

    ->appendFile('http://ckeditor.com/apps/ckeditor/4.4.0/ckeditor.js')

    ->appendFile('/plugins/ParagonFramework/static/js/bootstrap.min.js');

$showNavigation = false;

switch ($this->getParam('controller')) {
    case 'index':
        $showNavigation = true;
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
<?= $this->inlineScript() ?>