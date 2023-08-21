<?php
    include "../Logica/LogicaRol.php";
    $logica = new LogicaRol();

    if(isset($_GET["/"])){
        $logica->TraerRoles(); 
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $logica->TraerRolesPorID($id);
    }

    if(isset($_POST["rol"])){
        $result = json_decode($_POST["rol"]);    
        $logica->CrearRol($result->$nombre);        
    }

    if(isset($_POST["id"])){
        $result = json_decode($_POST["id"]);
        $logica->ModificarRol($result->id, $result->$nombre);
    }
?>