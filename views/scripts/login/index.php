<?php $this->headLink()
    ->appendStylesheet('/plugins/ParagonFramework/static/css/login.css');
?>
<div id="vcenter">
    <div id="content">
        <h2>Login to<br/>Paragon Framework</h2>
        <div id="login">
            <form role="form" id="loginform" method="post" action="/plugin/ParagonFramework/login/login">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" type="text" tabindex="1" name="username"/>
                </div>
                <div class="form-group">
                    <label for="password">
                        Password
                        <a style="margin-left: 10px;" href="/admin/login/lostpassword" class="lostpassword">Forgot your password?</a>
                    </label>
                    <input class="form-control" id="password" type="password" tabindex="2" name="password"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default" tabindex="3">Sign in</button>
                    <span style="margin-left: 10px;"><?= $this->message ?></span>
                </div>
            </form>
        </div>
    </div>
</div>