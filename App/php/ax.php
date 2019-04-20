<?php

require_once('./controller.php');

$cn = new controller();


if ($_REQUEST['f'] != '') {
    header('Content-Type: application/json');
    call_user_func($_REQUEST['f'], $_REQUEST);
} else {
    header('HTTP/1.0 404 Not Found');
}

function get_remoteapps($data) {
    global $cn;
    if ($_SESSION['log']['usr'] !== '' && $_SESSION['log']['usr'] !== NULL) {
        $cn->get_connection();

        $sql = "SELECT remote_apps.*
                ,vps.name AS vps_name 
                ,vps.processor_name 
                ,vps.cores 
                ,vps.ram 
                ,vps.hdd 
                ,vps.ssd
            FROM remote_apps,vps 
            WHERE remote_apps.id_vps=vps.id 
            AND id_vps='" . $data['ivps'] . "' ";
        $rs = $cn->xSQL($sql, 'vps_01');
        $rdps = array();
        $specs = new stdClass();
        while ($ar_rdp = mysqli_fetch_array($rs)) {
            $rdp = new stdClass();
            $rdp->name = $ar_rdp['name'];
            $rdp->rdp = $ar_rdp['rdp'];
            $rdp->icon = $ar_rdp['icon'];

            $specs->name = $ar_rdp['vps_name'];
            $specs->processor_name = $ar_rdp['processor_name'];
            $specs->cores = $ar_rdp['cores'];
            $specs->ram = $ar_rdp['ram'];
            $specs->hdd = $ar_rdp['hdd'];
            $specs->ssd = $ar_rdp['ssd'];
            array_push($rdps, $rdp);
        }

        $RT = array('status' => true, 'vps' => $rdps,'specs' => $specs);
    } else {
        $RT = array('status' => false, 'msg' => 'Usuario no logueado');
    }
    echo json_encode($RT);
}

function get_vps($data) {
    global $cn;
    if ($_SESSION['log']['usr'] !== '' && $_SESSION['log']['usr'] !== NULL) {
        $cn->get_connection();

        $sql = "SELECT DISTINCT vp.* FROM vps AS vp, usuarios_vps AS uvp, usuarios AS usr 
            WHERE uvp.id_usuario=usr.id 
            AND uvp.id_vps=vp.id 
            AND usr.usr='" . $_SESSION['log']['usr'] . "' ";
        $rs = $cn->xSQL($sql, 'vps_01');
        $vpss = array();
        while ($ar_vps = mysqli_fetch_array($rs)) {
            $vps = new stdClass();
            $vps->id = $ar_vps['id'];
            $vps->name = $ar_vps['name'];
            $vps->so = $ar_vps['so'];
            $vps->icon = $ar_vps['icon'];
            $vps->processors = $ar_vps['processors'];
            $vps->processor_name = $ar_vps['processor_name'];
            $vps->cores = $ar_vps['cores'];
            $vps->ram = $ar_vps['ram'];
            $vps->hdd = $ar_vps['hdd'];
            $vps->ssd = $ar_vps['ssd'];
            array_push($vpss, $vps);
        }

        $RT = array('status' => true, 'vps' => $vpss);
    } else {
        $RT = array('status' => false, 'msg' => 'Usuario no logueado');
    }
    echo json_encode($RT);
}

function get_login($data) {
    global $cn;
    if ($data['usr'] != '' && $data['pwd'] != '') {
        $cn->get_connection();

        $sql = "SELECT * FROM usuarios WHERE usr='" . $data['usr'] . "' AND pwd='" . $cn->encrypPWD($data['pwd']) . "'";
        $ar_log = mysqli_fetch_array($cn->xSQL($sql, 'usr_login_01'));

        if ($data['usr'] == $ar_log['usr'] && $cn->encrypPWD($data['pwd']) == $ar_log['pwd']) {
            $_SESSION['log']['id'] = $ar_log['id'];
            $_SESSION['log']['usr'] = $ar_log['usr'];
            $_SESSION['log']['nivel'] = $ar_log['nivel'];
            $_SESSION['log']['nombre1'] = $ar_log['nombre1'];
            $_SESSION['log']['nombre2'] = $ar_log['nombre2'];
            $_SESSION['log']['apellidos1'] = $ar_log['apellido1'];
            $_SESSION['log']['apellidos2'] = $ar_log['apellido2'];
            $RT = array('status' => true, 'web' => 'login.php', 'msg' => 'Bienvenido');
        } else {
            $RT = array('status' => false, 'msg' => 'Usuario o contra&ntilde;a incorrectos');
        }
    } else {
        $RT = array('status' => false, 'msg' => 'Datos imcompletos');
    }
    echo json_encode($RT);
}

function contact_msg($data) {
    global $cn;
    $ms = '';
    $er = false;
    if ($data['names'] != '' && $data['mail'] != '' && $data['mens']) {
        require 'phpmailer/PHPMailerAutoload.php';
        //Create a new PHPMailer instance
        $html = "<!DOCTYPE html><html><head>
		<title>Jean Paul Beard</title>
		<style type='text/css'>
		*{font-family:'Consolas', Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', monospace;color:#666;}
		html,body{font-size: 1em;}
		a{text-decoration: none;}
		.cols{float: left; height: 60px; width: 33.3333333333%; text-align: left;}
		@media screen and (max-width:641px){
			.cols{width:100%; height: auto; padding: 20px 0;}
		}
		</style></head><body><div style='padding:10px 10%;
                    '><div style='text-align: center;
                    '>
		<a href='https://jeanpaul.cf'>
                    <img src = 'https://jeanpaul.cf/app/img/jeanpaul_logo_256.png' width = '128'><br><span style = 'text-align:center; color:#0277bd;'>jeanpaul.cf</span>
                    </a>
                    </div><div style = 'text-align: center; padding:60px 0;'><br><h2>Mensaje recibido</h2><p>Gracias por ponerse en contacto, en el menor tiempo posible responder&eacute;
                    a su solicitud.</p></div>

                    <div style = 'text-align: center; padding: 60px 0;'>
                    <div class = 'cols'>
                    <div style = 'float: left; height: 60px; width: 60px;'>
                    <img src = 'https://jeanpaul.cf/app/img/ic_email_black_48dp_1x.png' width = '48'>
                    </div>
                    <div style = 'float:left; width: 100%;'>info@jeanpaul.co - adlasnv@gmail.com</div>
                    </div>

                    <div class = 'cols'><div style = 'float: left; eight: 60px; width: 60px;'>
                    <img src = 'https://jeanpaul.cf/app/img/ic_settings_phone_black_48dp_1x.png' width = '48'>
                    </div><div style = 'float:left; width: 100%;'>
                    <a href = 'tel:+57 321 435 7527'>+57 321 435 7527</a>
                    </div></div>

                    <div class = 'cols'><div style = 'float: eft; height: 60px; width: 60px;'>
                    <img src = 'https://jeanpaul.cf/app/img/ic_thumb_up_black_48dp_1x.png' width = '48'>
                    </div><div style = 'float:left; width: 100%;'>@jeanpaulbeard jeanpaulbeard</div></div>
                    </div>
                    <div style = 'text-align: center; padding:60px 0;'>
                    <p> ---</p>
                    </div>
                    </div></body></html>";


        $mail = new PHPMailer;
        //Set Quien envía el mensaje
        $mail->setFrom('jeanpaul@tecg3.com', 'Jean Paul Beard');
        //Set Direccion alternativa de respuesta
        $mail->addReplyTo('adlasnv@gmail.com', 'Jean Paul Beard');
        //Set Destinatario
        $mail->addAddress($data['mail'], $data[
                'names']);
        //Set Asunto
        $mail->Subject = 'RE: jeanpaul.cf';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail-> msgHTML (file_get_contents('contents.html'), dirname(__FILE__));
        $mail->msgHTML($html);
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        //Adjuntar archivos
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            $ms .= "Mailer Error: " . $mail->ErrorInfo;
            $er = true;
        } else {
            $ms .= "Message sent!";
            $er = flase;
        }

        $mail2 = new PHPMailer;
        $mail2->setFrom($data['mail'], $data['names']);
        $mail2->addReplyTo($data['mail'], $data['names']);
        $mail2->addAddress('adlasnv@gmail.com', 'Jean Paul Beard');
        $mail2->Subject = 'WEB: Contact';
        $mail2->msgHTML(nl2br($data['mens']));
        if (!$mail2->send()) {
            $ms .= "Mailer Error: " . $mail2->ErrorInfo;
            $er = true;
        } else {
            $ms .= "Message sent!";
            $er = false;
        }

        if ($er == true) {
            $RT = array('status' => false, 'error' => $ms);
        } else {
            $RT = array('status' => true, 'ms' => '<p>Gracias por ponerse en contacto, en el menor tiempo posible responder&eacute; a su solicitud<p>');
        }
    } else {
        $RT = array('status' => false, 'error' => 'Faltan datos');
    }
    echo json_encode($RT);
}

?>