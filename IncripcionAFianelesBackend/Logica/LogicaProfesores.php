<?php
include "../Modelos/Profesor.php";
include "../Datos/Db.php";

class LogicaProfesores{
    private $base;
    private $conecBase;

    public function __construct(){
        $this -> base = new DB();
        $this->conecBase = $this->base->conectar();
    }

    public function TraerProfesores(){
        //Mostrar todos los profesores
        $sql = $this-> conecBase->prepare("SELECT * FROM profesores");
        $sql -> execute();
        $sql -> setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
    public function TraerProfesorPorID(int $id){
        //Mostrar un profesor por id
        $sql = $this->conecBase->prepare("SELECT * FROM profesores WHERE ID=:id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }
    public function TraerProfesorPorApellido(string $apellido){
        //Mostrar uno o mas profesores por apellido
        $sql = $this->conecBase->prepare("SELECT * FROM profesores WHERE Apellido=:apellido");
        $estado = $this -> conecBase -> prepare($sql);
        $estado->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $estado->execute();
        header("HTTP/1.1 200 OK");
        $result = $estado->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        exit();
    }
    public function CrearProfesor(string $nombre, string $apellido){
        $input = $_POST;
        $sql = "INSERT  INTO profesores (Nombre, Apellido) VALUES (:nombre,:apellido)";
        $estado = $this -> conecBase -> prepare($sql);
        $estado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $estado->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $estado->execute();
        $postId=$this->conecBase->lastInsertId();
        if($postId){
            $input['id']=$postId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
    public function ModificarProfesor_Nombre(int $id,string $nombre){
        $sql = "UPDATE profesores SET Nombre = :nombre WHERE id=:id";
        $estado = $this->conecBase->prepare($sql);
        $estado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $estado->bindParam(':id', $id, PDO::PARAM_INT);
        $estado->execute();
        if($estado -> rowCount() > 0){
            $input['id']=$id;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
    public function ModificarProfesor_Apellido(int $id,string $apellido){
        $input = $_POST;
        $sql = "UPDATE profesores SET Apellido = :apellido WHERE id=:id";
        $estado = $this->conecBase->prepare($sql);
        $estado->bindParam(':id', $id, PDO::PARAM_INT);
        $estado->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $estado->execute();
        $postId=$this->conecBase->lastInsertId();
        if($postId){
            $input['id']=$postId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
}
?>