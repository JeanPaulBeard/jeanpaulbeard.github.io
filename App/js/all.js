// JavaScript Document
(function ($) {
    $(function () {

        $('.sidenav').sidenav();
        $('.parallax').parallax();
        $('.tooltipped').tooltip();


        if (typeof ajustar === "function") {
            ajustar();
        }

        $(window).resize(function (e) {
            if (typeof ajustar === "function") {
                ajustar();
                clearTimeout(resizeId);
                resizeId = setTimeout(ajustar, 10);
            }
        });


        $('a.page-scroll, .bt-page-scroll').bind('click', function (event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: ($($anchor.attr('href')).offset().top - 50)
            }, 500);
            event.preventDefault();
        });

        //Nav bar scroll
        $(window).scroll(function () {
            if ($(document).scrollTop() > 50) {
                $("nav").addClass('nav-fixed');
                $(".page-scroll").removeClass('blue-grey-text');
                $(".sidenav-trigger").removeClass('light-blue-text text-darken-3');
                $(".sidenav-trigger").addClass('white-text');
            } else {
                $("nav").removeClass('nav-fixed');
                $(".page-scroll").addClass('blue-grey-text');
                $(".sidenav-trigger").addClass('light-blue-text text-darken-3');
                $(".sidenav-trigger").removeClass('white-text');
            }
            $('.sidenav').sidenav().close;
        });



    });
})(jQuery);

/*       Variables de entorno JS       */
var resizeId;
var phpAjax = 'app/php/ax.php';

function ajustar() {
    var h_win = $(window).height();
    var h_nav = $('nav').height();
    var h_sec = (h_win - h_nav - 15);

    $('#index-banner .section').height(h_sec);
}

$.postJSON = function (url, data, func) {
    return $.post(url, data, func, 'json');
};

function CalcularDv(nit1) {
    var vpri, x, y, z, i, nit1, dv1;
    if (isNaN(nit1)) {
        alert('El valor no es un numero valido');
    } else {
        vpri = new Array(16);
        x = 0;
        y = 0;
        z = nit1.length;
        vpri[1] = 3;
        vpri[2] = 7;
        vpri[3] = 13;
        vpri[4] = 17;
        vpri[5] = 19;
        vpri[6] = 23;
        vpri[7] = 29;
        vpri[8] = 37;
        vpri[9] = 41;
        vpri[10] = 43;
        vpri[11] = 47;
        vpri[12] = 53;
        vpri[13] = 59;
        vpri[14] = 67;
        vpri[15] = 71;
        for (i = 0; i < z; i++)
        {
            y = (nit1.substr(i, 1));
            x += (y * vpri[z - i]);
        }
        y = x % 11;
        if (y > 1)
        {
            dv1 = 11 - y;
        } else {
            dv1 = y;
        }
        return dv1;
    }
}

function is_touch_device() {
    var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
    var mq = function (query) {
        return window.matchMedia(query).matches;
    }

    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
        return true;
    }
    var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
    return mq(query);
}