<?php
    header("Access-Control-Allow-Origin:*");
    include "../Logica/LogicaCorrelativas.php";

    $logica = new LogicaCorrelativas();

    // Traer todas las materias con sus correlativas
    if(isset($_GET["/"])){
        $logica->TraerCorrelativas();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != null){
            // Crear correlativa de una materia
            if($datos->tipo == "crear"){
                $logica->CrearCorrelativa($datos->id_materia, $datos->id_correlativa);
            // Modificar correlativa de una materia
            } else if($datos->tipo == "modificar"){
                $logica->ModificarCorrelativa($datos->id, $datos->id_correlativa);
            }else{ // Errores
                echo json_encode(array("datos mandados incorrectamente", "Error"));
            }
        }
    }
    
    /*
    // Crear correlativa de una materia
    if(isset($_POST["id_materia"]) and isset($_POST["id_correlativa"])){
        $id_materia = $_POST["id_materia"];
        $id_correlativa = $_POST["id_correlativa"];
        $logica->CrearCorrelativa($id_materia,$id_correlativa);
    }
    // Modificar correlativa de una materia
    if(isset($_POST["id"]) and isset($_POST["id_correlativa"])){
        $id_materia = $_POST["id"];
        $id_correlativa = $_POST["id_correlativa"];
        $logica->ModificarCorrelativa($id_materia,$id_correlativa);
    }
    */
?>