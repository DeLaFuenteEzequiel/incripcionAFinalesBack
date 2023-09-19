<?php
    include "../Logica/LogicaCarreras.php";

    $logica = new Carreras();

    if(isset($_GET["/"])){
        $logica->TraerCarreras();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            if ($datos->tipo == "crear"){
                $logica->CrearCarrera($datos->nombre);
            } else if($datos->tipo == "modificar"){
                $logica->ModificarCarreras($datos->id,$datos->nombre);
            } else {
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        }
    }

?>