<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);


if ($_SESSION['log']['id'] > 0 && $_SESSION['log']['id'] !== NULL) {
    header("Location:vps.php");
} else {
    header("Location:login.html");
}

?>