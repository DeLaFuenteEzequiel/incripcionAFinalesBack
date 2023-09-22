<?php

include "../Modelos/Rol.php";
include "../Datos/Db.php";
include "../Utilidades/Utilidades.php";

class LogicaRol{

    private $base;
    private $conecBase;

    public function __construct()
    {
        $this->base = new DB();
        $this->conecBase = $this->base->conectar();
    }

    public function TraerRoles(){                            
        //Mostrar todos los usuarios
        $sql = $this->conecBase->prepare("SELECT * FROM roles");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();                                 
    }

    public function TraerRolesPorID(int $id){
        //Mostrar un usuario
        $sql = $this->conecBase->prepare("SELECT * FROM roles WHERE id=$id");
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }

    public function CrearRol(string $nombre){
        $input = $_POST;
        $sql = "INSERT INTO roles(Nombre) VALUES ($nombre)";
        $estado = $this->conecBase->prepare($sql);
        //bindAllValues($estado, $input);
        $estado->execute();
        $postId=$this->conecBase->lastInsertId();
        if($postId){
            $input['id']=$postId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }

    public function ModificarRol(int $id,string $nombre){
        $input = $_POST;
        $sql = "UPDATE roles SET Nombre = $nombre WHERE id=$id";
        $estado = $this->conecBase->prepare($sql);
        //bindAllValues($estado, $input);
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