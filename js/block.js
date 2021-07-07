$(document).ready(function() {

    $("html").on("contextmenu", function(e) {
        return false;
    });

    $("#id").on("contextmenu", function(e) {
        return false;
    });
});



var isCtrl = false;
document.onkeyup = function(e) {
    if (e.which == 17) isCtrl = false;
}
document.onkeydown = function(e) {
    if (e.which == 17) isCtrl = true;
    if (e.which == 85 && isCtrl == true) {
        return false;
    } else if (e.ctrlKey && e.shiftKey && e.which == 73) {
        return false;
    } else if (e.which == 123) {
        return false;
    }
}