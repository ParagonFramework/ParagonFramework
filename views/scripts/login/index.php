<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Paragon Framework!</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="noindex, follow"/>

    <!--link rel="stylesheet" href="/pimcore/static/css/login.css" type="text/css" />
     <script type="text/javascript" src="/pimcore/static/js/lib/jquery.min.js"></script>

     <link rel="stylesheet" type="text/css" href="/plugins/ParagonFramework/static/css/example.css?_dc=1395907441"/-->

    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/plugins/ParagonFramework/static/css/example.css">
    <link rel="stylesheet" type="text/css" href="/plugins/ParagonFramework/static/css/login.css">

</head>
<body>
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
</html>