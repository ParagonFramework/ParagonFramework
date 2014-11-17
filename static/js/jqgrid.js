jQuery().ready(function () {
    $.getJSON('/plugin/ParagonFramework/index/columns', function(data) {
        jQuery("#table").jqGrid({
            url: "/plugin/ParagonFramework/index/fetch",
            datatype: "xml",
            mtype: "GET",
            colNames: $.merge(data.columnNames, [ 'Actions' ]),
            colModel: $.merge(data.columnKeys, [ { name: 'action' }]),
            pager: "#pager",
            rowNum: 50,
            rowList: [50, 100, 500],
            viewrecords: true,
            gridview: true,
            autowidth: true,
            autoencode: true,
            caption: "My first grid"
        });
    });
// jQuery("#list27").jqGrid('filterToolbar',{searchOperators : true});
});