<?php 
    include "../Modelos/Materia.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";

    class LogicaMateria{

        private $base;
        private $conecBase;
    
        public function __construct()
        {
            $this->base = new DB();
            $this->conecBase = $this->base->conectar();
        }

        public function TraerMaterias(){                            
            //Mostrar todos las materias
            $sql = $this->conecBase->prepare("SELECT * FROM materias");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();                                 
        }

        public function TraerMateriasPorID(int $ID){
            //Mostrar una materia
            $sql = $this->conecBase->prepare("SELECT * FROM materias WHERE ID=$ID");
            $sql->execute();
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
            exit();
        }

        public function CrearMAterias(string $Nombre){
            $input = $_POST;
            $sql = "INSERT INTO materias(Nombre) VALUES ($Nombre)";
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input); // nose que onda pero yo lo comento xD
            $estado->execute();
            $postId=$this->conecBase->lastInsertId();
            if($postId){
                $input['id']=$postId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
        }

        public function ModificarMaterias(int $ID,string $Nombre){
            $input = $_POST;
            $sql = "UPDATE materias SET Nombre = $Nombre WHERE ID=$ID";
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);// nose que onda pero yo lo comento xD x2
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

      /*  public function EliminarMateria (string $Nombre ,int $ID){
            $input = $_POST;
            $sql = "DELETE FROM materias where (Nombre = $Nombre) and (ID=$ID)";  // nose si agarra bien los parentesis
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);// nose que onda pero yo lo comento xD x2
            $estado->execute();
            $postId=$this->conecBase->lastInsertId();
            if($postId){
                $input['id']=$postId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
            

        }*/

?>