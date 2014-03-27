<!DOCTYPE html>
<html>
<head>
    <title>Welcome to pimcore!</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="noindex, follow" />

    <link rel="stylesheet" href="/pimcore/static/css/login.css" type="text/css" />
    <script type="text/javascript" src="/pimcore/static/js/lib/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/plugins/ParagonFramework/static/css/example.css?_dc=1395907441"/>
</head>
<body>

<div id="vcenter" class="">
    <div id="content">
        <div id="right">
            <form id="loginform" method="post" action="#">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" />

                <label for="password">Password</label>
                <input type="password" name="password" />

                <input type="submit" name="submit" value="Login" />
            </form>
        </div>
        <a href="/admin/login/lostpassword" class="lostpassword">Forgot your password</a>
    </div>
</div>
<div id="footer">
    <?php
    $git_dir = "plugins/ParagonFramework";
    $git_head = file_get_contents("$git_dir/.git/HEAD");
    $git_headHash = "no repo version";
    $git_headLink = "https://se45g1ss14.fh-hagenberg.at/pimcore-org/ParagonFramework";

    if (preg_match("#ref: refs/heads/(\\w+)#", $git_head, $git_head)) {
        $git_headHash = file_get_contents("$git_dir/.git/refs/heads/$git_head[1]");
        $git_headLink = "https://se45g1ss14.fh-hagenberg.at/pimcore-org/ParagonFramework/commit/$git_headHash";
        $git_headHash = substr($git_headHash, 0, 8);
    }
    ?>
    <a href="https://se45g1ss14.fh-hagenberg.at/">Paragon Framework</a>&nbsp;(<a href="<?= $git_headLink ?>"><?= $git_headHash ?></a>)
    <br />
    &copy; 2014 <a href="https://se45g1ss14.fh-hagenberg.at/">Project Group 1</a>, a proud member of the <a href="http://www.fh-hagenberg.at/" target="_blank">FH Hagenberg</a>
</div>

</body>
</html>