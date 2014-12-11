<?php

$this->inlineScript()
    ->appendFile('/plugins/ParagonFramework/static/js/view-switching.js');

if(($user = $this->user)) {
    if(($userView = $user->getRole())) {
        // Empty Statement
    } else {
        $userView = "No View found";
    }

    $userName = $user->getUsername();
} else {
    $userView = "No View found";
    $userName = "No Name found";
}

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="http://www.pimcore.org/wiki/download/attachments/5308442/LABS?version=1&modificationDate=1393491266000&api=v2" width="24" height="24" class="img-rounded">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= $this->url(array('controller' => 'index', 'action' => 'index')) ?>">Overview</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Create Product <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Use Template</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Create Attribute <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li><a href="#about">Create Category</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" onclick="toggle_visibility('viewSwitchingDialog');">Select View (<?= $userView ?>)</b></a>
                </li>
                <li class="active"><a href="<?= $this->url(array('controller' => 'login', 'action' => 'logout')) ?>">Logout (<?= $userName ?>)</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>