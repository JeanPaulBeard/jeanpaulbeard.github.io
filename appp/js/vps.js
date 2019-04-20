// JavaScript Document
(function ($) {
    $(function () {
        get_vps();




    });
})(jQuery);

/*       Variables de entorno JS       */


function get_vps() {
    $.postJSON(phpAjax, {f: 'get_vps'}, function (js) {
        var html = "";
        if (js.status == true) {
            for (i = 0; i < js.vps.length; i++) {
                var vps = js.vps[i];
                html += "<div class='vps' id='vps" + vps.id + "' data-ivps='" + vps.id + "'>";
                html += "<div class='so-icon " + vps.icon + "'></div>";
                html += "<div class='vps-name'>" + vps.name + "</div>";
                html += "<div class='so-name'>" + vps.so + "</div>";
                html += "</div>";
            }
            $('.vpss').html(html);
            bind_vps();
        }
    });
}

function get_remoteapps(vps) {
    $.postJSON(phpAjax, {f: 'get_remoteapps', ivps: vps}, function (js) {
        var html = "";

        var specs = "<h4 class='center'>" + js.specs.name + "</h4>";
        specs += "<table>";
        specs += "<thead>";
        specs += "<tr>";
        specs += "<th>Procesador</th>";
        specs += "<th>N&uacute;cleos</th>";
        specs += "<th>RAM</th>";
        specs += "<th>SSD</th>";
        specs += "</tr>";
        specs += "</thead>";
        specs += "<tbody>";
        specs += "<tr>";
        specs += "<td>" + js.specs.processor_name + "</td>";
        specs += "<td>" + js.specs.cores + "</td>";
        specs += "<td>" + js.specs.ram + " GB</td>";
        specs += "<td>" + js.specs.ssd + " GB</td>";
        specs += "</tr>";
        specs += "</tbody>";
        specs += "</table>";

        if (js.status == true) {
            for (i = 0; i < js.vps.length; i++) {
                var vps = js.vps[i];
                html += "<a class='rdp' href='app/rdp/" + js.specs.name + "/" + vps.rdp + "' download target='_blank'>";
                html += "<div class='icon " + vps.icon + "'></div>";
                html += "<div class='name'>" + vps.name + "</div>";
                html += "</a>";
            }

            $('.rdps').html(specs + html);
        }

    });

}

function bind_vps() {
    $('.vps').off('click');
    $('.vps').click(function (e) {
        var vps = $(this).data();
        get_remoteapps(vps.ivps);
    });
}