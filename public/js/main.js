JQuery(function($) {

    var monAlert = $('#monAlert');
    if (monAlert.length > 0) {
        monAlert.hide().slideUp(500).delay(3000).slideDown();
    }
});