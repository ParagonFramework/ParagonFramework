jQuery().ready(function () {
    $.getJSON('/plugin/ParagonFramework/index/columns', function(data) {
        jQuery("#table").jqGrid({
            url: "/plugin/ParagonFramework/index/fetch",
            datatype: "xml",
            mtype: "GET",
            colNames: $.merge(data.columnNames, [ 'Actions' ]),
            colModel: $.merge(data.columnKeys, [ { name: 'action' }]),
            pager: "#pager",
            rowNum: 30,
            rowList: [30, 100, 500],
            viewrecords: true,
            gridview: true,
            autowidth: true,
            height: 500,
            autoencode: true
        });
        jQuery("#table").jqGrid('filterToolbar',{searchOperators : true});
    });
});