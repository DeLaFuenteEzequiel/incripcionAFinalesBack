<?php
    include "../Logica/LogicaEstudiante.php";
    header("Access-Control-Allow-Origin:*");

    $logica = new LogicaEstudiante();

    // Traer todas las materias con sus correlativas
    if(isset($_GET["/"])){
        $logica->TraerEstudiantes();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            // Crear
            if($datos->tipo == "crear"){
                $logica->CrearEstudiante($datos->nombre, $datos->apellido, $datos->dni, $datos->activo, $datos->id_usuario, $datos->id_plan);
            // Modificar
            } else if($datos->tipo == "modificar"){
                $logica->ModificarEstudiantes($datos->id, $datos->nombre, $datos->apellido, $datos->dni, $datos->id_plan);
            }else{ // Errores
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        }
    }
?>