<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Bogota');

$_POST['to'] = array('34666555444');
$_POST['text'] = "mensaje de texto";
$_POST['from'] = "msg";
$_POST['dlr-url'] ="http://mi.server.com/notifica.php?idenvio=7584remitente=%p&tel=%P&estado=%d";
$user ="miuser";
$password = 'mipass';


print_r($_POST);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
	"https://gateway.plusmms.net/rest/message");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	"Accept: application/json",
	"Authorization: Basic ".base64_encode($user.":".$password)
));


$result = curl_exec ($ch); 

?>