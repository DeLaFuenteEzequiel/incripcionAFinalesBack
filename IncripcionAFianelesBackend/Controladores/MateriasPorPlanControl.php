<?php
header("Access-Control-Allow-Origin:*");
include  "../Logica/LogicaMateriasPorPlan.php";

$logica = new LogicaDetalleEstudiantes();

if (isset($_GET["/"])){
    $logica->TraerMateriaPorPlan();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datos = json_decode(file_get_contents('php://input'));
    if($datos != null){
        if($datos->tipo == "crear")
            {
                 $logica->CrearMateriasPorPlan($datos->ID,$datos->ID_Materia,$datos->ID_PlanDeEstudio);
            }
        else if ($datos->tipo == "modificar")
            {
                $logica->ModificarMateriaPorPlan($datos->ID,$datos->ID_Materia,$datos->ID_PlanDeEstudio);
            }  
        else if ($datos->tipo == "eliminar")
            {
                $logica->EliminarMateriasPorPlan($datos->ID_Materia,$datos->ID_PlanDeEstudio);
            }
         else 
            {
                echo json_encode(array("datos mandados incorrectamente","Error"));
            }
    }




/*if(isset($_POST["ID"]) && isset($_POST["ID_Materia"])&& isset($_POST["ID_PlanDeestudio"])){

    $ID = $_POST["ID"];
    $ID_Materia = $_POST["ID_Materia"];
    $ID_PlanDeestudio = $POST["ID_PlanDeestudio"];

    $logica->CrearMateriasPorPlan($ID,$ID_Materia,$ID_PlanDeestudio);
}

if(isset($_POST["ID"]) && isset($_POST["ID_Materia"])&& isset($_POST["ID_PlanDeestudio"])){

    $ID = $_POST["ID"];
    $ID_Materia = $_POST["ID_Materia"];
    $ID_PlanDeestudio = $POST["ID_PlanDeestudio"];

    $logica->ModificarMateriaPorPlan($ID,$ID_Materia,$ID_PlanDeestudio);
}
if(isset($_POST["ID_Materia"]) && isset($_POST["ID_PlanDeestudio"])){

    $ID_Materia = $_POST["ID_Materia"];
  
    $ID_PlanDeestudio = $POST["ID_PlanDeestudio"];

    $logica->EliminarMateriasPorPlan($ID_Materia,$ID_PlanDeestudio);
}*/

?>