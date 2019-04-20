<?php

session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Bogota');

class controller {

    private $CONEXION;
    private $HOST;
    private $USER;
    private $DATABASE;
    private $PASSWORD;

    public function setHOST() {
        global $HOST;
        $HOST = 'localhost';
        return $HOST;
    }

    public function setUSER() {
        global $USER;
        $USER = 'developers';
        return $USER;
    }

    public function setPASSWORD() {
        global $DATABASE;
        $DATABASE = 'vps';
        return $DATABASE;
    }

    public function setDATABASE() {
        global $PASSWORD;
        $PASSWORD = '$Lasnv1010';
        return $PASSWORD;
    }

    public function get_conection() {
        global $CONEXION;
        return $CONEXION;
    }

    public function get_id() {
        global $CONEXION;
        return mysqli_insert_id($CONEXION);
    }

    public function get_connection() {
        global $CONEXION;
        global $HOST;
        global $USER;
        global $DATABASE;
        global $PASSWORD;
        $this->setHOST();
        $this->setUSER();
        $this->setPASSWORD();
        $this->setDATABASE();
        try {
            $CONEXION = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);
        } catch (Exception $e) {
            $CONEXION = 'E.[CONEX_SET_DATABASE]' . $e;
        }
        return $CONEXION;
    }

    public function close_connection() {
        global $CONEXION;
        mysqli_close($CONEXION);
    }

    public function xSQL($sql, $p) {
        global $CONEXION;
        try {
            //$RS=mysqli_query($sql,$CONEXION) or die('<pre>Obj: '.$p.'<br>[Error en la sentencia]: '.mysqli_error().'<br><br>SQL:<br>'.$sql.'</pre>');
            $RS = mysqli_query($CONEXION, $sql);
        } catch (Exception $e) {
            $RS = 'E.[EXE_SQL]-[' . $p . ']' . $e;
        }
        return $RS;
    }

    public function INSERT($table, $aray_values) {
        //$cn->insert('usuarios'|,"nombre='jean paul'|,apellidos='beard bermeo'|,id_usr=1|,road='legacy'");
        $campos_values = explode('|,', $aray_values);
        $campos = '';
        $values = '';
        $i = 0;
        while ($i < count($campos_values)) {
            $fields = explode('=', $campos_values[$i]);
            if ($i == 0) {
                if (empty($fields[1]) || $fields[1] == "''") {
                    $campos .= $fields[0];
                    $values .= 'NULL';
                } else {
                    $campos .= $fields[0];
                    $values .= $fields[1];
                }
            } else {
                if (empty($fields[1]) || $fields[1] == "''") {
                    $campos .= "," . $fields[0];
                    $values .= ',NULL';
                } else {
                    $campos .= "," . $fields[0];
                    $values .= "," . $fields[1];
                }
            }
            $i++;
        }
        echo $sql;
        $sql = "INSERT INTO " . $table . "(" . $campos . ") VALUES(" . $values . ")";
        return $this->xSQL($sql, 'F_INSERT') . $sql;
    }

    public function encrypPWD($pwd) {
        return hash_hmac('md5', $pwd, 'tunja-es-peque');
    }

    public function nombremes($mes) {
        setlocale(LC_TIME, 'spanish');
        $nombre = strftime("%B", mktime(0, 0, 0, $mes, 1, 2000));
        return ucfirst($nombre);
    }

    public function usr_login($usr, $pwd) {
        $reply = '';
        if ($usr != '' && $pwd != '') {
            $this->get_connection();
            $sql = "SELECT * FROM usuarios WHERE usr='" . $usr . "' AND pwd='" . $this->encrypPWD($pwd) . "'";
            $ar_log = mysqli_fetch_array($this->xSQL($sql, 'usr_login_01'));

            if ($usr == $ar_log['usr'] && $this->encrypPWD($pwd) == $ar_log['pwd']) {
                $_SESSION['id_usr'] = $ar_log['id'];
                $_SESSION['usr'] = $ar_log['usr'];
                $_SESSION['nivel'] = $ar_log['nivel'];
                $_SESSION['nombre'] = $ar_log['nombre'];
                $_SESSION['apellidos'] = $ar_log['apellidos'];
                $reply = TRUE;
            } else {
                $reply = FALSE;
            }
        } else {
            $reply = 'Falta usr y pwd';
        }
        return $reply;
    }

    public function cHTML($str) {
        if (!isset($GLOBALS["carateres_latinos"])) {
            $todas = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
            $etiquetas = get_html_translation_table(HTML_SPECIALCHARS, ENT_NOQUOTES);
            $GLOBALS["carateres_latinos"] = array_diff($todas, $etiquetas);
        }
        $str = strtr($str, $GLOBALS["carateres_latinos"]);
        return $str;
    }

    public function sml($txt, $sentido) {
        // recibe 0 para encriptar y 1 para desencriptar
        if ($sentido == 0) {
            $num = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
            $abc = array('ABC', 'DEF', 'GHI', 'JKL', 'MNO', 'PQR', 'STU', 'VWX', 'YZa', 'bcd');
        } elseif ($sentido == 1) {
            $abc = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
            $num = array('ABC', 'DEF', 'GHI', 'JKL', 'MNO', 'PQR', 'STU', 'VWX', 'YZa', 'bcd');
        }
        return str_replace($num, $abc, $txt);
    }

}

?>