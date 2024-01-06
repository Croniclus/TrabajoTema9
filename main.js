$(document).ready(function () {
    $(".veen .rgstr-btn button").click(function () {
        toggleForms(true);
    });

    $(".veen .login-btn button").click(function () {
        toggleForms(false);
    });

    function toggleForms(isRegister) {
        var $wrapper = $('.veen .wrapper');
        var $body = $('.body');

        $wrapper.toggleClass('move', isRegister);
        $body.css('background', isRegister ? '#e0b722' : '#ff4931');

        $(".veen .rgstr-btn button, .veen .login-btn button").removeClass('active');
        $(this).addClass('active');
    }
});