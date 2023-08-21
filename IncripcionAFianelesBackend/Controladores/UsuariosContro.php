<?php
    include "../Logica/LogicaUsuario.php";    
    $logica = new LogicaUsuario();
    if(isset($_GET["/"])){
        $logica->TraerUsuarios(); 
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $logica->TraerUsuarioPorID($id);
    }

    if(isset($_POST["user"])){
        $result = json_decode($_POST["user"]);    
        $logica->CrearUsuario( $result->$nombre, hash("sha256", $result->$contra), $result->$email, $result->$rol);        
    }

    if(isset($_POST["id"])){
        $result = json_decode($_POST["id"]);
        $logica->ModificarUsuario($result->id, $result->$nombre,hash("sha256", $result->$contra), $result->$email, $result->$rol);
    }

    if(isset($_POST["Login"])){
        $result= json_decode($_POST["login"]);
        $logica->IniciarSesion($result->$nombre, hash("sha256", $result->$contra));
    }

?>