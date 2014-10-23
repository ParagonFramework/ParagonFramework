function toggle_visibility(id) {
    var e = document.getElementById(id);
    var estyle = e.style;

    if (estyle.display == 'block') {
        estyle.display = 'none';
    } else {
        estyle.display = 'block';
    }
}