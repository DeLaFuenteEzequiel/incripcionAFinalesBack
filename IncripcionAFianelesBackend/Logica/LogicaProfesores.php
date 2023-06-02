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
        $sql->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        exit();
    }
    public function CrearProfesor(string $nombre, string $apellido){
        $input = $_POST;
        $sql = "INSERT  INTO profesores (Nombre, Apellido) VALUES (:nombre,:apellido)";
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $estado = $this -> conecBase -> prepare($sql);
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
        $input = $_POST;
        $sql = "UPDATE profesores SET Nombre = :nombre WHERE id=:id";
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $estado = $this->conecBase->prepare($sql);
        $estado->execute();
        $postId=$this->conecBase->lastInsertId();
        if($postId){
            $input['id']=$postId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
    public function ModificarProfesor_Apellido(int $id,string $apellido){
        $input = $_POST;
        $sql = "UPDATE profesores SET Apellido = :apellido WHERE id=:id";
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $estado = $this->conecBase->prepare($sql);
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