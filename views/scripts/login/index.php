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

    <script type="text/javascript">
        function toggle_visibility(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
    </script>
</head>
<body>
    <div id="vcenter">
        <div id="content">
            <h2>Login to<br/>Paragon Framework</h2>
            <div id="viewSwitchingDialog" style="display: none;">
                <div>
                    <form role="form" id="viewSwitchingForm" method="post" action="/plugin/ParagonFramework/login/login">
                        <h3>Chose your view</h3>
                        <br/>
                        <br/>
                        <label>View:</label>
                        <select>
                            <option value="view1">view1</option>
                            <option value="view2">view2</option>
                            <option value="view3">view3</option>
                            <option value="view4">view4</option>
                        </select>
                        <br/>
                        <br/>
                        <button type="submit" class="btn btn-default">Next</button>
                        <input type="button" class="btn btn-default" name="btnCancel" value="Cancel" onclick="toggle_visibility('viewSwitchingDialog');">
                    </form>
                </div>
            </div>
            <div id="login">
                <form role="form" id="loginform" method="post" action="/plugin/ParagonFramework/login/login">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" type="text" name="username" value="testuser"/>

                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" value="testuser1"/>
                    <br/>

                    <button type="submit" class="btn btn-default">Login</button>
                    <input type="button" name="Text 2" value="Text 2 anzeigen" onclick="toggle_visibility('viewSwitchingDialog');">
                    <a style="margin-left: 10px;" href="/admin/login/lostpassword" class="lostpassword">Forgot your password?</a>
                </form>
            </div>
            <div><?= $this->message ?></div>
        </div>
    </div>

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