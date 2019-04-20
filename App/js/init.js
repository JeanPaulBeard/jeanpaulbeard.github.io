// JavaScript Document
(function ($) {
    $(function () {

        //Enviar mensaje
        var phpAjax = 'app/php/ajax.php';
        //Enviar mensaje
        $('#send').click(function (e) {

            var nam = $('#f_names').val();
            var mai = $('#f_mail').val();
            var msg = $('#f_messaje').val();

            $.getJSON(phpAjax, {f: 'contact_msg', names: nam, mail: mai, mens: msg}, function (json) {
                if (json.status == true) {
                    //window.location.href=json.web
                    M.toast({html: json.ms, classes: 'rounded'});

                    $('#f_names').val('');
                    $('#f_mail').val('');
                    $('#f_messaje').val('');
                } else {
                    M.toast({html: json.error, classes: 'rounded'});
                    //alert(json.error);
                }
            });


        });
    });
})(jQuery);

/*       Variables de entorno JS       */
