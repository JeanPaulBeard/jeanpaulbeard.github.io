// JavaScript Document
(function ($) {
    $(function () {

        $('#usr').keydown(function (event) {
            var kc = event.keyCode;
            if (kc == 13) {
                $('#pwd').focus();
                return false;
            }
        });

        $('#pwd').keydown(function (event) {
            var kc = event.keyCode;
            if (kc == 13) {
                login();
                return false;
            }
        });


        $('.bt-agree').click(function (e) {
            login();
        });

        $('.bt-cancel').click(function (e) {
            $('#pwd').val('');
            $('#usr').val('').focus();
        });
    });
})(jQuery);

/*       Variables de entorno JS       */

function login() {
    var usr = $('#usr').val();
    var pwd = $('#pwd').val();
    if (usr != "" && pwd != "") {
        $.postJSON(phpAjax, {f: 'get_login', usr: usr, pwd: pwd}, function (json) {
            M.toast({html: json.msg, classes: 'rounded'});
            if (json.status == true) {
                $('#usr').val('');
                $('#pwd').val('');
                window.location.href = json.web;
            }
        });
    } else {
        M.toast({html: 'Todos los campos son obligatorios', classes: 'rounded'});
    }
}