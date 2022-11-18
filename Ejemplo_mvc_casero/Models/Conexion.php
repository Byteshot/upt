<?php

namespace Models;

class Conexion
{
    public $con;

    function __construct()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $bd = "upt";
        // -- asignar valores a la variable con para la conexión.
        $this->con = mysqli_connect($host, $user, $pass, $bd);
        // -- SET NAMES es para que acepte carácteres especiales.
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }


}