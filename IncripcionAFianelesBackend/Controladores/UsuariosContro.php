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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            if($datos->tipo == "login"){
                $logica->IniciarSesion($datos->nombre, hash("sha256",$datos->contra));
            } else if($datos->tipo == "modificar"){
                $logica->ModificarUsuario($datos->id, $datos->nombre ,$datos->$contra, $datos->email, $datos->rol);
            }else{
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        } 
    }

    /*if($_SERVER['REQUEST_METHOD'] == $_POST["user"]){
        $result = json_decode($_POST["user"]);    
        $logica->CrearUsuario( $result->$nombre, hash("sha256", $result->$contra), $result->$email, $result->$rol);        
    }

    if(isset($_POST["id"])){
        $result = json_decode($_POST["id"]);
        $logica->ModificarUsuario($result->id, $result->$nombre,hash("sha256", $result->$contra), $result->$email, $result->$rol);
    }

    if($_SERVER['REQUEST_METHOD'] == $_POST["login"]){
        $result= json_decode($_POST["login"]);
        $logica->IniciarSesion($result->$nombre, hash("sha256", $result->$contra));
    }*/

?>