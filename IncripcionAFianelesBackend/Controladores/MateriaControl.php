<?php
header("Access-Control-Allow-Origin:*");
include  "../Logica/LogicaMateria.php";

$logica = new LogicaMateria();

if (isset($_GET["/"])){
    $logica->TraerMaterias();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datos = json_decode(file_get_contents('php://input'));
    if($datos != null){
        if($datos->tipo == "traer_por_id")
            {
                 $logica->TraerMateriasPorID($datos->ID);
            }
         else if ($datos->tipo == "crear")
            {
                $logica->CrearMAterias($datos->Nombre);
            }  
        else if ($datos->tipo == "modificar")
            {
                $logica->ModificarMaterias($datos->ID,$datos->Nombre);
            } 
         else 
            {
                echo json_encode(array("datos mandados incorrectamente","Error"));
            } 
        }
    }
           




/*if(isset($_POST["ID"]) ){

    $ID = $_POST["ID"];
  

    $logica->TraerMateriasPorID($ID);
}

if(isset($_POST["Materia"]) ){

    $Materia = $_POST["Materia"];
  

    $logica->CrearMAterias($Materia);
}

if(isset($_POST["ID"]) && isset($_POST["Nombre"])) {

    $Nombre = $_POST["Nombre"];
    $ID = $_POST["ID"];

    $logica->ModificarMaterias($ID , $Nombre);

}*/



?>