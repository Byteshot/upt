<?php

use Models\Usuario;

include "Models/conexion.php";
include "Models/Usuario.php";

class UsuarioController
{

    public function createAlum()
    {
        if (isset($_POST)) {
            // -- instancia del modelo Usuario
            $usuario = new \Models\Usuario();

            // -- Recibiendo datos por POST
            //$usuario->id_alumno = $_POST['id_alumno'];
            $usuario->matricula = $_POST['matricula'];
            $usuario->nombre = $_POST['nombre'];
            $usuario->carrera_id = $_POST['carrera_id'];
            $usuario->grupo = $_POST['grupo'];
            $usuario->sexo = $_POST['sexo'];
            $usuario->cuatrimestre = $_POST['cuatrimestre'];
            $usuario->ruta_id = $_POST['ruta_id'];
            $usuario->unidad_id = $_POST['unidad_id'];

            // -- Ejecutando método Insert (ubicado en modelo Usuario) que guardara al usuario en la BD
           // $usuario->insertA();
            // --   Imprime estatus
          //  echo json_encode(["status" => "success", "usuario" => $usuario->insertA()]);
            echo json_encode(["status"=>"success","usuario"=> $usuario->insertA()]);

        }
    }

    public function createChof()
    {
        if (isset($_POST)) {
            // -- instancia del modelo Usuario
            $usuario = new \Models\Usuario();

            // -- Recibiendo datos por POST
            // $usuario->id_chofer = $_POST['id_chofer'];
            $usuario->nombrechof = $_POST['nombre'];
            $usuario->direccion = $_POST['direccion'];
            $usuario->telefono = $_POST['telefono'];
            $usuario->unidad_id3 = $_POST['unidad_id'];
            $usuario->correo = $_POST['correo'];
            $usuario->contrasena = $_POST['contrasena'];

            // -- Ejecutando método Insert (ubicado en modelo Usuario) que guardara al usuario en la BD
            // --   Imprime estatus
           // echo json_encode(["estatus" => "success", "Chofer" => $usuario->InsertC()]);
            echo json_encode(["status"=>"success","usuario"=> $usuario->InsertC()]);

        }
    }

    public function buscarAlum()
    {
        if (isset ($_POST)) {
            $bus = $_POST["id_alumno"];
            $bus1 = $_POST["nombre"];
            echo json_encode(["status" => "success", "usuario" => Usuario::findA($bus, $bus1)]);
        }

    }

    public function login(){
        if (isset($_POST)) {
            $usuario = \Models\Usuario::findA($_POST["nombre"], $_POST["id_alumno"]);
            if ($usuario == NULL) {
                $_SESSION["flash"] = "No existe";
                header("Location:/UPTrans/?controller=Usuario&action=loginn");
            } else {
                if ($_POST["contrasena"]== $usuario->contrasena) {
                    $_SESSION["alumno"] = $usuario->id_alumno;
                    header("Location:/UPTrans/UPTrans/?controller=Usuario&action=loginAlum");
                } else {
                    header("Location:/UPTrans/UPTrans/?controller=Usuario&action=login");
                }
            }}}

    function loginAlum(){

        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "upt";

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$conn) {
            die("No hay conexion: " . mysqli_connect_error());
        }
        $nombre = $_POST["nombre"];
        $id = $_POST["id_alumno"];

        $query = mysqli_query($conn, "SELECT * FROM alumno where matricula = '" . $id . "' and nombre = '" . $nombre . "'");
        $nr = mysqli_num_rows($query);

        if ($nr == 1) {
            echo json_encode(["status"=>"success","usuario"=>Usuario::findA($nombre, $id)]);
        } else if ($nr == 0) {

            echo json_encode(["status"=>"error"]);

        }

    }

    function loginChof(){

        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "upt";

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$conn) {
            die("No hay conexion: " . mysqli_connect_error());
        }
        $correo = $_POST["correo"];
        $pass = $_POST["contrasena"];

        $query = mysqli_query($conn, "SELECT * FROM chofer where correo = '" . $correo . "' and contrasena = '" . $pass . "'");
        $nr = mysqli_num_rows($query);

        if ($nr == 1) {
           echo json_encode(["status"=>"success","usuario"=>Usuario::findChofi($correo, $pass)]);
        } else if ($nr == 0) {
            echo json_encode(["status"=>"error"]);
        }

    }

    function loginAdm(){

        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "upt";

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$conn) {
            die("No hay conexion: " . mysqli_connect_error());
        }
        $nick = $_POST["nick"];
        $pass = $_POST["pass"];

        $query = mysqli_query($conn, "SELECT * FROM admin where nick = '" . $nick . "' and pass = '" . $pass . "'");
        $nr = mysqli_num_rows($query);

        if ($nr == 1) {
            echo json_encode(["status"=>"success","usuario"=>Usuario::findAdm($nick, $pass)]);
        } else if ($nr == 0) {
            echo json_encode(["status"=>"error"]);
        }

    }

    public function buscarChof()
    {
        if (isset ($_POST)) {
            $bus = $_POST["id_chofer"];
            $bus1 = $_POST["correo"];
            echo json_encode(["estatus" => "success", "Busqueda" => Usuario::findChofi($bus, $bus1)]);
        }
    }

    public function actualizarAlum()
    {
        if (isset($_POST)) {
            // -- instancia del modelo Usuario
            $usuario = new \Models\Usuario();

            // -- Recibiendo datos por POST
            $id = $_POST['id_alumno'];
            $nombre = $_POST['nombre'];

            // -- Ejecutando método Insert (ubicado en modelo Usuario) que guardara al usuario en la BD
            $usuario->updateA($id, $nombre);
            // --   Imprime estatus
            echo json_encode(["estatus" => "success", "usuario" => $usuario]);

        }
    }

    public function actualizarChof()
    {
        if (isset($_POST)) {
            // -- instancia del modelo Usuario
            $usuario = new \Models\Usuario();

            // -- Recibiendo datos por POST
            $id = $_POST['id_chofer'];
            $nombre = $_POST['nombre'];

            // -- Ejecutando método Insert (ubicado en modelo Usuario) que guardara al usuario en la BD
            $usuario->updateC($id, $nombre);
            // --   Imprime estatus
            echo json_encode(["estatus" => "success", "Chofer" => $usuario]);

        }
    }

    public function eliminarAlum()
    {
        // -- instancia del modelo Usuario
        $usuario = new \Models\Usuario();

        // -- Recibiendo datos por POST
        $matricula = $_POST['matricula'];

        // -- Ejecutando método Insert (ubicado en modelo Usuario) que guardara al usuario en la BD
        $usuario->deleteA($matricula);
        // --   Imprime estatus
        if ($usuario == true) {
            echo json_encode(["estatus" => "success delete", "usuario" => "Usuario eliminado"]);
        } else {
            echo "No se encontro nada";
        }


    }

    public function eliminarChof()
    {
        // -- instancia del modelo Usuario
        $usuario = new \Models\Usuario();

        // -- Recibiendo datos por POST
        $id = $_POST['id_chofer'];

        // -- Ejecutando método Insert (ubicado en modelo Usuario) que guardara al usuario en la BD
        $usuario->deleteC($id);
        // --   Imprime estatus
        echo json_encode(["estatus" => "success delete", "Chofer" => "Chofer eliminado"]);

    }
      //Muestra todos los datos de los alumnos
    public function busqueda_tabla(){
        /////// CONEXIÓN A LA BASE DE DATOS /////////
        $host = 'localhost';
        $basededatos = 'upt';
        $usuario = 'root';
        $contraseña = '';

        $conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
        if ($conexion -> connect_errno)
        {
            die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
        }else{
            echo "Informacion sobre alumnos";
        }
//////////////// VALORES INICIALES ///////////////////////


        $tabla = "";
        $query = "SELECT * FROM alumno ORDER BY id_alumno";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
        if (isset($_POST['alumnos'])) {
            $q = $conexion->real_escape_string($_POST['alumnos']);
            $query = "SELECT * FROM alumno WHERE id_alumno LIKE '%" . $q . "%' OR 
            matricula LIKE '%" . $q . "%' OR 
            nombre LIKE '%" . $q . "%' OR 
            carrera_id LIKE '%" . $q . "%' OR 
            grupo LIKE '%" . $q . "%' OR 
            sexo LIKE '%" . $q . "%' OR 
            cuatrimestre LIKE '%" . $q . "%' OR 
            ruta_id LIKE '%" . $q . "%' OR 
            unidad_id '%" . $q . "%'";
        }

        $buscarAlumnos = $conexion->query($query);
        //$res = $buscarAlumnos->fetch_object();
        if ($buscarAlumnos->num_rows > 0) {
            $tabla .=
                '<table class="table">
		<tr class="bg-primary">
			<td>ID ALUMNO</td>
			<td>MATRICULA</td>
			<td>NOMBRE</td>
			<td>CARRERA_ID</td>
			<td>GRUPO</td>
			<td>SEXO</td>
			<td>CUATRIMESTRE</td>
			<td>RUTA_ID</td>
			<td>UNIDAD_ID</td>
		</tr>';

            while ($filaAlumnos = $buscarAlumnos->fetch_assoc()) {
                $tabla .=
                    '<tr>
			<td>' . $filaAlumnos['id_alumno'] . '</td>
			<td>' . $filaAlumnos['matricula'] . '</td>
			<td>' . $filaAlumnos['nombre'] . '</td>
			<td>' . $filaAlumnos['carrera_id'] . '</td>
			<td>' . $filaAlumnos['grupo'] . '</td>
			<td>' . $filaAlumnos['sexo'] . '</td>
			<td>' . $filaAlumnos['cuatrimestre'] . '</td>
			<td>' . $filaAlumnos['ruta_id'] . '</td>
			<td>' . $filaAlumnos['unidad_id'] . '</td>
		 </tr>
		';
            }

            $tabla .= '</table>';
        } else {
            $tabla = "No se encontraron coincidencias con sus criterios de búsqueda.";
        }
        echo $tabla;

    }




}


