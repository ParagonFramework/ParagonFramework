function toggle_visibility(id) {
    var e = document.getElementById(id);
    var estyle = e.style;

    if (estyle.display == 'block') {
        estyle.display = 'none';
    } else {
        $.ajax({
            type: 'POST',
            url: "/plugin/ParagonFramework/index/roles",
            success: function(data) {
                $("#viewSwitchingDialog_Dropdown").empty();
                set_view_name(data.roles[0]);
                $.each(data.roles, function (index) {
                    var list_item = $('<li/>', {role: 'presentation'});
                    var link = $('<a/>', {id: index, role: 'menuitem', tabindex: -1, href: '#', onclick: 'set_view_name(this)'}).html(this);

                    $("#viewSwitchingDialog_Dropdown").append(list_item.append(link));
                });

                estyle.display = 'block';
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            },
            dataType: "json"
        });
    }
}

function set_view_name(text) {
    $('#viewName').html($(text).html());
}

function get_default_item(id) {
    $.ajax({
        type: 'POST',
        url: "/plugin/ParagonFramework/index/roles",
        success: function(data) {
            $("#viewSwitchingDialog_Dropdown").empty();
            $("#viewSwitchingDialog_Dropdown").html(data.roles[0]);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(textStatus);
        },
        dataType: "json"
    });
}