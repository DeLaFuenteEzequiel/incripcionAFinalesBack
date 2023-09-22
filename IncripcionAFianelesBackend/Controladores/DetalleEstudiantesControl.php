<?php
header("Access-Control-Allow-Origin:*");
include  "../Logica/LogicaDetalleEstudiantes.php";

$logica = new LogicaDetalleEstudiantes();

if (isset($_GET["/"])){
    $logica->TraerDetalleEstudiantes();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datos = json_decode(file_get_contents('php://input'));
    if($datos != null){
        if($datos->tipo == "crear")
            {
                 $logica->CrearDetalleEstudiante($datos->Estado,$datos->ID_Estudiante,$datos->ID_Materia);
            }
     else if($datos->tipo == "modificar_estado")
            {  
                 $logica->ModificarEstadoDetalleEstudiante($datos->ID,$datos->Estado);
            }
    else if ($datos->tipo == "modificar_materia")
            {
                $logica->ModificarMateriaDetalleEstudiante($datos->ID,$datos->ID_Materia);
            }
    else if ($datos->tipo == "modificar_estudiante")
            {
                $logica->ModificarEstudianteEstadoDetalleEstudiante($datos->ID,$datos->ID_Estudiante);
            }
    else if ($datos->tipo == "modificar_estado_materia_estudiante")
            {
                $logica->ModificarEstadoMateriaYestudianteDetalleEstudiante($datos->ID,$datos->Estado,$datos->ID_Estudiante,$datos->ID_Materia);
            }
    else if ($datos->tipo == "eliminar")
            {
                $logica->EliminarDetalleEstudiante($datos->ID_Detalle,$datos->ID_Materia);
            }
    else 
            {
                echo json_encode(array("datos mandados incorrectamente","Error"));
            }
        }
    }
        
/*if(isset($_POST["Estado"]) && isset($_POST["ID_Estudiante"])&& isset($_POST["ID_Materia"])){

    $Estado = $_POST["Estado"];
    $ID_Estudiante = $_POST["ID_Estudiante"];
    $ID_Materia = $POST["ID_Materia"];

    $logica->CrearDetalleEstudiante($Estado,$ID_Estudiante,$ID_Materia);
}

if(isset($_POST["ID"]) && isset($_POST["Estado"])) {

    $Estado = $_POST["Estado"];
    $ID = $_POST["ID"];

    $logica->ModificarEstadoDetalleEstudiante($ID , $Estado);

}

if(isset($_POST["ID"]) && isset($_POST["ID_Materia"])){

    $ID = $_POST["ID"];
    $ID_Estudiante = $_POST["ID_Materia"];

    $logica->ModificarMateriaDetalleEstudiante($ID,$ID_Materia);

}

if(isset($_POST["ID"]) && isset($_POST["ID_Estudiante"])){

    $ID = $_POST["ID"];
    $ID_Estudiante = $_POST["ID_Estudiante"];

    $logica->ModificarEstudianteEstadoDetalleEstudiante($ID,$ID_Estudiante);

}

if(isset($_POST["ID"]) && isset($_POST["Estado"]) && isset($_POST["ID_Estudiante"])&& isset($_POST["ID_Materia"])){

    $Estado = $_POST["Estado"];
    $ID_Estudiante = $_POST["ID_Estudiante"];
    $ID_Materia = $POST["ID_Materia"];
    $ID = $_POST["ID"];

    $logica->ModificarEstadoMateriaYestudianteDetalleEstudiante($ID,$Estado,$ID_Estudiante,$ID_Materia);
}

if(isset($_POST["ID_Detalle"]) && isset($_POST["ID_Materia"])){

    $ID = $_POST["ID_Detalle"];
    $ID_Estudiante = $_POST["ID_Materia"];

    $logica->EliminarDetalleEstudiante($ID_Detalle,$ID_Materia);

}*/









?>