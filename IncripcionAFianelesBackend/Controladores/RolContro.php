<?php
    header("Access-Control-Allow-Origin:*");
    include "../Logica/LogicaRol.php";
    $logica = new LogicaRol();

    if(isset($_GET["/"])){
        $logica->TraerRoles(); 
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $logica->TraerRolesPorID($id);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            if($datos->tipo == "crear"){
                $logica->CrearRol($result->$nombre);
            } else if($datos->tipo == "modificar"){
                $logica->ModificarRol($result->id, $result->$nombre);
            }else{
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        } 
    }

?>