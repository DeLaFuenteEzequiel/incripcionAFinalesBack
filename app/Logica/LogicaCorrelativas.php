<?php
include "../Modelos/Correlativa.php";
include "../Datos/Db.php";

class LogicaCorrelativas{
    private $base;
    private $conecBase;

    public function __construct(){
        $this -> base = new DB();
        $this->conecBase = $this->base->conectar();
    }
    // Metodos publicos
    public function TraerCorrelativas(){
        $sql = $this-> conecBase->prepare($this->QuerySelectAll());
        $sql -> execute();
        $sql -> setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
    public function CrearCorrelativa(int $id_materia, int $id_correlativa){
        $sql = $this-> conecBase->prepare($this->QueryInsert());
        $estado = $this -> conecBase -> prepare($sql);
        $estado -> bindParam(':id_materia',$id_materia,PDO::PARAM_INT);
        $estado -> bindParam(':id_correlativa',$id_correlativa,PDO::PARAM_INT);
        $estado -> execute();
        $postId=$this->conecBase->lastInsertId();
        if ($postId){
            $input['id']=$postId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
    public function ModificarCorrelativa(int $id,int $id_correlativa){
        $estado = $this->conecBase->prepare($this->QueryUpdate());
        $estado->bindParam(':id', $id, PDO::PARAM_INT);
        $estado->bindParam(':id_correlativa', $id_correlativa, PDO::PARAM_INT);
        $estado->execute();
        if($estado -> rowCount() > 0){
            $input['id']=$id;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
    // Metodos privados
    private function QueryUpdate(){
        return "UPDATE correlativas SET ID = :id WHERE ID_Correlativa=:id_correlativa";
    }
    private function QueryInsert(){
        return "INSERT FROM correlativas (ID_Materia,ID,Correlativa) VALUES (:id_materia,:id_correlativa)";
    }
    private function QuerySelectAll(){
        return "SELECT c.ID,mat.ID,mat.Nombre,cor.ID,cor.Nombre FROM correlativas as c
                INNER JOIN materias as mat ON ID_Materia = mat.ID
                INNER JOIN materias as cor ON ID_Correlativa = cor.ID";
    }
}

?>