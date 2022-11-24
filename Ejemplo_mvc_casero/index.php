<?php
/*
 * MVC (Modelo Vista Controlador).
 *
 * cliente o vista: dispositos que hacen peticiones
 * modelo: permite interactuar de una forma, se establece y se usa de "n" forma, es decir, las clases (esta en el servidor).
 * controlador: se encarga de controlar las entradas y salidas, es el intermediario entre el modelo y el servidor.
 */

// -- Verifica que se le pasen valores
if (isset($_GET["controller"])) {

    header("Access-Control-Allow-Origin: *");

    $controlador = $_GET["controller"];

    if(isset($_GET["action"])){
        $action = $_GET["action"];
    }else{
        $action = "inicio";
    }

    $accion = $action;
    // -- Concatena
    $controladorClass = $controlador . "Controller";
    // -- Solicitar el archivo
    require_once("Controller/" . $controladorClass . ".php");

    $ctr = new $controladorClass;
    //-- llama los métodos de la clase
    $ctr->{$accion}();

} else{
    echo "ERROR!";
}



?>
