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
                    $("#viewSwitchingDialog_Dropdown").append($('<option></option>').val(this).html(this));
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