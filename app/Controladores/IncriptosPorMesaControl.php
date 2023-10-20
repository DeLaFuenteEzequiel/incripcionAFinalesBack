<?php
header("Access-Control-Allow-Origin:*");
include  "../Logica/LogicaIncriptosPorMesa.php";

$logica = new LogicaInscriptosXMesa();

if (isset($_GET["/"])){
    $logica->TraerIncriptoPorMesas();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datos = json_decode(file_get_contents('php://input'));
    if($datos != null){
        if($datos->tipo == "crear")
            {
                 $logica->CrearIncriptosPorMesas($datos->ID,$datos->ID_MesaDeExamen,$datos->ID_Estudiante);
            }
        else if ($datos->tipo == "modificar_mesa")
            {
                $logica->ModificarMesaDeExamnesDeIncriptoPorMesas($datos->ID,$datos->ID_MesaDeExamen);
            }  
         else if ($datos->tipo == "modificar_estudiante")
            {
                $logica->ModificarEstudianteDeIncriptoPorMesas($datos->ID,$datos->ID_Estudiante);
            }
        else if ($datos->tipo == "modificar_mesa_estudiante")
            {
                $logica->ModificarMesaDeexmanesYestudianteDeIncriptoPorMesas($datos->ID,$datos->ID_MesaDeExamen,$datos->ID_Estudiante);
            }
        else if ($datos->tipo == "eliminar")
            {
                $logica->EliminarIncriptosPorMsa($datos->ID_MesaDeExamen,$datos->ID_Estudiante);
            }
        else 
            {
                echo json_encode(array("datos mandados incorrectamente","Error"));
            }
    }
}



/*if(isset($_POST["ID"]) && isset($_POST["ID_MsaDeExamen"])&& isset($_POST["ID_Estudiante"])){

    $ID = $_POST["ID"];
    $ID_MsaDeExamen = $_POST["ID_MsaDeExamen"];
    $ID_Estudiante = $POST["ID_Estudiante"];

    $logica->CrearIncriptosPorMesas($ID,$ID_MsaDeExamen,$ID_Estudiante);
}

if(isset($_POST["ID"]) && isset($_POST["ID_MesaDeExamen"])) {

    $ID_MesaDeExamen = $_POST["ID_MesaDeExamen"];
    $ID = $_POST["ID"];

    $logica->ModificarMesaDeExamnesDeIncriptoPorMesas($ID , $ID_MesaDeExamen);

}

if(isset($_POST["ID"]) && isset($_POST["ID_Estudiante"])) {

    $ID_Estudiante = $_POST["ID_Estudiante"];
    $ID = $_POST["ID"];

    $logica->ModificarEstudianteDeIncriptoPorMesas($ID , $ID_Estudiante);

}

if(isset($_POST["ID"]) && isset($_POST["ID_MsaDeExamen"])&& isset($_POST["ID_Estudiante"])){

    $ID = $_POST["ID"];
    $ID_MsaDeExamen = $_POST["ID_MsaDeExamen"];
    $ID_Estudiante = $POST["ID_Estudiante"];

    $logica->ModificarMesaDeexmanesYestudianteDeIncriptoPorMesas($ID,$ID_MsaDeExamen,$ID_Estudiante);
}

if(isset($_POST["ID_MesaDeExamen"]) && isset($_POST["ID_Estudiante"])) {

    $ID_Estudiante = $_POST["ID_Estudiante"];
    $ID = $_POST["ID_MesaDeExamen"];

    $logica->EliminarIncriptosPorMsa($ID_MesaDeExamen , $ID_Estudiante);

}*/

?>