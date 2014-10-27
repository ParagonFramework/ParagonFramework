<?php $this->headLink()
    ->appendStylesheet('/plugins/ParagonFramework/static/css/example.css')
    ->appendStylesheet('/plugins/ParagonFramework/static/css/login.css');
?>
<div id="vcenter">
    <div id="content">
        <h2>Login to<br/>Paragon Framework</h2>
        <div id="login">
            <form role="form" id="loginform" method="post" action="/plugin/ParagonFramework/login/login">
                <label for="username">Username</label>
                <input class="form-control" id="username" type="text" name="username" value="testuser"/>

                <label for="password">Password</label>
                <input class="form-control" id="password" type="password" name="password" value="testuser1"/>
                <br/>

                <button type="submit" class="btn btn-default">Login</button>
                <a style="margin-left: 10px;" href="/admin/login/lostpassword" class="lostpassword">Forgot your password?</a>
            </form>
        </div>
        <div><?= $this->message ?></div>
    </div>
</div>