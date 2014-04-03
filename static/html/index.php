<!--here begins the layout template-->
<!--Default content is in comments-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Layout Prototype &middot; Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="http://bs.incureforce.com/css/bootstrap.min.css" rel="stylesheet">
    <link href="example.css" rel="stylesheet">
</head>
<body>

<!-- Part 1: Wrap all page content here -->
<div id="wrap">
    <div id="navbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="Chrysanthemum.jpg" width="24" height="24" class="img-rounded"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Overview</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Create Product <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!--Examples-->
                            <li><a href="#">Action</a></li>
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
                            <!--Examples-->
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="asdf_text">Select Role<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!--Examples-->
                            <li><a onclick="javascript:asdf_text.textContent = 'Translator'">Translator</a></li>
                            <li><a onclick="javascript:asdf_text.textContent = 'Mr.Salesman'">Mr.Sale</a></li>

                        </ul>
                    </li>
                    <li class="active"><a href="logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <br />
    <br />

    <!-- Begin page content -->

    <div class="container">
        <div class="page-header">
        </div>
        <p class="lead">Products that need to be completed.</p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>G</td>
               <!--<td><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Edit</td>-->
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                         Actions  <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Edit</a></li>
                            <li><a href="#">Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>G</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Actions  <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Edit</a></li>
                            <li><a href="#">Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>G</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Actions  <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Edit</a></li>
                            <li><a href="#">Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <ul class="pagination pull-right">
            <li class="disabled"><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>

        </ul>
    </div class="page-body">
    <div id="push"></div>
</div>

<div id="footer">
    <div class="container">
        <p class="muted credit">
            <a href="https://se45g1ss14.fh-hagenberg.at/">Paragon Framework</a> (#&nbsp;<a href=".">BEEFBEEF</a>)
            <br />
            &copy; <?= date("Y"); ?> Project Group 1, a proud member of the <a href="http://www.fh-hagenberg.at/" target="_blank">FH Hagenberg</a>
        </p>
    </div>
</div>



<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://bs.incureforce.com/js/jquery.min.js"></script>
<script src="http://bs.incureforce.com/js/bootstrap.min.js"></script>


</body>
</html>
