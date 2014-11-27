jQuery().ready(function () {
    $.getJSON('/plugin/ParagonFramework/index/columns', function(data) {
        jQuery("#table").jqGrid({
            url: "/plugin/ParagonFramework/index/fetch",
            datatype: "xml",
            mtype: "GET",
            colNames: $.merge(data.columnNames, [ 'Actions' ]),
            colModel: $.merge(data.columnKeys, [ { name: 'action', search: false }]),
            pager: "#pager",
            rowNum: 20,
            //rowList: [30, 100, 500],
            viewrecords: true,
            gridview: true,
            autowidth: true,
            height: 441,
            autoencode: true,
            scrollOffset: 1 // hide scroll bars
        });
        jQuery("#table").jqGrid('filterToolbar',{searchOperators : true});
    });
});