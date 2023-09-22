<?php
header("Access-Control-Allow-Origin:*");
include  "../Logica/LogicaMesaExamen.php";

$logica = new LogicaMesaExamen();

if (isset($_GET["/"])){
    $logica->TraerMesasExamenes();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datos = json_decode(file_get_contents('php://input'));
    if($datos != null){
        if($datos->tipo == "crear")
            {
                 $logica->CrearMesaDeExamenes($datos->ID,$datos->Fecha,$datos->ID_Materia,$datos->ID_Profesor);
            }
        else if ($datos->tipo == "modificar_fechaExamen")
            {
                $logica->ModificarFechaMesaDeExamenes($datos->ID,$datos->Fecha);
            }  
        else if ($datos->tipo == "modificar_materia")
            {
                $logica->ModificarMateriaMesaDeExamenes($datos->ID,$datos->ID_Materia);
            }
        else if ($datos->tipo == "modificar_profesor")
            {
                $logica->ModificarProfesorMesaDeExamenes($datos->ID,$datos->ID_Profesor);
            }
        else if ($datos->tipo == "modificar_profesor_materia_fercha")
            {
                $logica->ModificarEProfesorMateriaFecha($datos->ID,$datos->ID_Profesor,$datos->Fecha,$datos->ID_Materia);
            }
        else 
            {
                echo json_encode(array("datos mandados incorrectamente","Error"));
            }
    }
}



/*if(isset($_POST["ID"]) && isset($_POST["Fecha"])&& isset($_POST["ID_Materia"])&& isset($_POST["ID_Profesor"])){

    $ID = $_POST["ID"];
    $Fecha = $_POST["Fecha"];
    $ID_Materia = $POST["ID_Materia"];
    $ID_Profesor = $POST["ID_Profesor"];

    $logica->CrearMesaDeExamenes($ID,$Fecha,$ID_Materia,$ID_Profesor);
}

if(isset($_POST["ID"]) && isset($_POST["Fecha"])){

    $ID = $_POST["ID"];
    $Fecha = $_POST["Fecha"];
   

    $logica->ModificarFechaMesaDeExamenes($ID,$Fecha);
}

if(isset($_POST["ID"]) && isset($_POST["ID_Materia"])){

    $ID = $_POST["ID"];
    $ID_Materia = $_POST["ID_Materia"];
   

    $logica->ModificarMateriaMesaDeExamenes($ID,$ID_Materia);
}
if(isset($_POST["ID"]) && isset($_POST["ID_Profesor"])){

    $ID = $_POST["ID"];
    $ID_Profesor = $_POST["ID_Profesor"];
   

    $logica->ModificarProfesorMesaDeExamenes($ID,$ID_Profesor);
}

if(isset($_POST["ID"]) && isset($_POST["Fecha"])&& isset($_POST["ID_Materia"])&& isset($_POST["ID_Profesor"])){

    $ID = $_POST["ID"];
    $Fecha = $_POST["Fecha"];
    $ID_Materia = $POST["ID_Materia"];
    $ID_Profesor = $POST["ID_Profesor"];

    $logica->ModificarEProfesorMateriaFecha($ID,$ID_Profesor,$Fecha,$ID_Materia);
}*/

?>