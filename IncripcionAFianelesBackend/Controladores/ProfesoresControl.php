<?php
    include "../Logica/LogicaProfesores.php";

    $logica = new LogicaProfesores();

    // Traer lista de profesores
    if(isset($_GET["/"])){
        $logica->TraerProfesores();
    }

    // Traer un profesor por id
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $logica->TraerProfesorPorID($id);
    }

    // Traer un profesor por Apellido
    if(isset($_GET["apellido"])){
        $apellido_profesor = $_GET["apellido"];
        $logica->TraerProfesorPorID($apellido_profesor);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            // Agregar un nuevo profesor
            if($datos->tipo == "crear"){
                $logica->CrearProfesor($datos->Nombre, $datos->Apellido);
            // Modificar nombre de profesor por id
            } else if($datos->tipo == "modificar_nombre"){
                $logica->ModificarProfesor_Nombre($datos->id,$datos->nuevo_nombre);
            // Modificar apellido de profesor por id
            }else if($datos->tipo == "modificar_apellido"){
                $logica->ModificarProfesor_Apellido($datos->id,$datos->nuevo_apellido);
            } else { // Errores
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        }
    }

    /*
    // Agregar un nuevo profesor
    if(isset($_POST["profesor"])){
        $resultado = json_decode($_POST["profesor"]);
        $logica->CrearProfesor($resultado->$Nombre, $resultado->$Apellido);
    }
    // Modificar nombre de profesor por id
    if(isset($_POST["id"]) && $_POST["nombre"]){
        $nuevo_nombre = $_POST["nombre"];
        $id_profesor = $_POST["id"];
        $logica->ModificarProfesor_Nombre($id,$nuevo_nombre);
    }

    // Modificar apellido de profesor por id
    if(isset($_POST["id"]) && $_POST["apellido"]){
        $nuevo_apellido = $_POST["apellido"];
        $id_profesor = $_POST["id"];
        $logica->ModificarProfesor_Apellido($id,$nuevo_apellido);
    }
    */
?>