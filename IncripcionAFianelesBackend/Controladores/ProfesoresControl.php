<?php
    header("Access-Control-Allow-Origin:*");
    include "../Logica/LogicaProfesores.php";

    $logica = new LogicaProfesores();

    // Traer lista de profesores
    if(isset($_GET["/"])){
        $logica->TraerProfesores();
    }

    // Traer un profesor por id
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $logica->TraerProfesorPorID($id);
    }

    // Traer un profesor por Apellido
    if(isset($_POST["apellido"])){
        $apellido_profesor = $_POST["apellido"];
        $logica->TraerProfesorPorID($apellido_profesor);
    }

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

    // Modificar nombre de profesor por id
    if(isset($_POST["id"]) && $_POST["apellido"]){
        $nuevo_apellido = $_POST["apellido"];
        $id_profesor = $_POST["id"];
        $logica->ModificarProfesor_Apellido($id,$nuevo_apellido);
    }
?>