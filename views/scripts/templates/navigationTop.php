<?php

$this->inlineScript()
    ->appendFile('/plugins/ParagonFramework/static/js/view-switching.js');

if(($user = $this->user)) {
    if(($userView = $user->getRole())) {
        // Empty Statement
    } else {
        $userView = $this->t('No View found');
    }

    $userName = $user->getUsername();
} else {
    $userView = $this->t('No View found');
    $userName = $this->t('No Name found');
}

?>
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->url(array('controller' => 'index', 'action' => 'index')) ?>">
                <img src="http://www.pimcore.org/wiki/download/attachments/5308442/LABS?version=1&modificationDate=1393491266000&api=v2" width="24" height="24" class="img-rounded">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= $this->url(array('controller' => 'index', 'action' => 'index')) ?>"><?=$this->t('Overview') ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" onclick="toggle_visibility('viewSwitchingDialog');"><?=$this->t('Select View') ?> (<?= $userView ?>)</b></a>
                </li>
                <li class="active"><a href="<?= $this->url(array('controller' => 'login', 'action' => 'logout')) ?>"><?=$this->t('Logout') ?> (<?= $userName ?>)</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>