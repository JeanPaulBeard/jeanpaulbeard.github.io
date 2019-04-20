<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
error_reporting(0);
session_destroy();
header("Location:index.html");

/*
  echo "<pre>".
  $_SESSION['id_usr']."<br />".
  $_SESSION['usr']."<br />".
  $_SESSION['nombre']."<br />".
  $_SESSION['apellidos']."<br />".
  "</pre>";
 */
?>