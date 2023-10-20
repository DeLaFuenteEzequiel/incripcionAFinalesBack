<?php
    include "../Logica/LogicaPlanesEstudio.php";

    $logica = new PlanEstudio();

    // Traer todo
    if(isset($_GET["/"])){
        $logica->TraerPlanDeEstudio();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            // Crear
            if($datos->tipo == "crear"){
                $logica->CrearPlanDeEstudio($datos->nombre, $datos->carrera);
            // Modificar
            } else if($datos->tipo == "modificar"){
                $logica->ModificarPlanDeEstudio($datos->id,$datos->nombre,$datos->id_carrera);
            }else{ // Errores
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        }
    }
?>