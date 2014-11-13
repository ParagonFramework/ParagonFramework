<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My First Grid</title>

    <!--link rel="stylesheet" type="text/css" media="screen" href="/plugin/ParagonFramework/static/css/ui-lightness/jquery-ui-1.8.2.custom.css" /-->
    <link rel="stylesheet" type="text/css" media="screen" href="//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/css/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="http://www.trirand.com/blog/jqgrid/themes/redmond/jquery-ui-custom.css" />

    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            font-size: 75%;
        }
    </style>
</head>
<body>
    <table id="list27" ></table>
    <div id="pager"></div>
</body>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/jquery.jqGrid.src.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/i18n/grid.locale-en.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery().ready(function () {
        jQuery("#list27").jqGrid({
            url: "/plugin/ParagonFramework/test/example",
            datatype: "xml",
            mtype: "GET",
            colNames: ["id", "name", "status", "actions"],
            colModel: [
                { name: "id", sorttype: 'integer', searchoptions:{sopt:['eq','ne','le','lt','gt','ge']} },
                { name: "name" },
                { name: "status"},
                { name: "actions"},
            ],
            pager: "#pager",
            rowNum: 50,
            rowList: [50, 100, 500],
            sortname: "name",
            sortorder: "asc",
            viewrecords: true,
            gridview: true,
            autowidth: true,
            autoencode: true,
            caption: "My first grid"
        });
        jQuery("#list27").jqGrid('filterToolbar',{searchOperators : true});
    });
</script>

</html>