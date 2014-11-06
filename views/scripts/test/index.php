<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My First Grid</title>

    <!--link rel="stylesheet" type="text/css" media="screen" href="/plugin/ParagonFramework/static/css/ui-lightness/jquery-ui-1.8.2.custom.css" /-->
    <link rel="stylesheet" type="text/css" media="screen" href="/plugin/ParagonFramework/static/css/ui.jqgrid.css" />

    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            font-size: 75%;
        }
    </style>

    <script src="/plugin/ParagonFramework/static/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <!--script src="/plugin/ParagonFramework/static/js/i18n/grid.locale-en.js" type="text/javascript"></script-->
    <script src="/plugin/ParagonFramework/static/js/jquery.jqGrid.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $("#list").jqGrid({
                url: "/plugin/ParagonFramework/test/example",
                datatype: "xml",
                mtype: "GET",
                colNames: ["id", "name", "image", "status", "actions"],
                colModel: [
                    { name: "id", width: 55 },
                    { name: "name", width: 90 },
                    { name: "image", width: 80},
                    { name: "status", width: 80},
                    { name: "actions", width: 80},
                ],
                pager: "#pager",
                rowNum: 10,
                rowList: [10, 20, 30],
                sortname: "name",
                sortorder: "desc",
                viewrecords: true,
                gridview: true,
                autoencode: true,
                caption: "My first grid"
            });
        });
    </script>

</head>
<body>
    <table id="list"><tr><td></td></tr></table>
    <div id="pager"></div>
</body>
</html>