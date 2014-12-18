jQuery().ready(function () {
    $.getJSON('/plugin/ParagonFramework/index/columns', function(data) {
        jQuery("#table").jqGrid({
            url: "/plugin/ParagonFramework/index/fetch",
            datatype: "xml",
            mtype: "GET",
            colNames: data.columnNames,
            colModel: data.columnKeys,
            pager: "#pager",
            rowNum: 20,
            //rowList: [30, 100, 500],
            autodecode: true,
            viewrecords: true,
            gridview: true,
            autowidth: true,
            height: 441,
            autoencode: true,
            scrollOffset: 1, // hide scroll bars
            ondblClickRow: function (id) {
                var productID = jQuery("#table").jqGrid('getCell', id, 'o_id');

                window.location.href = "/plugin/ParagonFramework/index/edit/id/" + productID;
            }
        });
        jQuery("#table").jqGrid('filterToolbar',{searchOperators : true});
    });
});