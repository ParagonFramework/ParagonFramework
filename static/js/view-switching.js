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
                $.each(data.roles, function () {
                    var list_item = $('<li/>', {role: 'presentation'});
                    var link = $('<a/>', {role: 'menuitem', tabindex: -1, href: '#'}).html(this);

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