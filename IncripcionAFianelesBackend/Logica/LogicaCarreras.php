<?php  

    include "../Modelos/Carrera.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";


        class Carreras
        {
            private $base;
            private $conecBase;

        public function __construct()
        {
            $this->base = new DB();
            $this->conecBase = $this->base->conectar();
        }


            public function TraerCarreras(){                            
                //Mostrar todos los usuarios
                $sql = $this->conecBase->prepare("SELECT * FROM carreras");
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($sql->fetchAll());
                exit();                                 
            }

            public function CrearCarrera(string $Nombre )
            {            
                $sql = "INSERT INTO carreras(Nombre) VALUES ($Nombre)";
                $estado = $this->conecBase->prepare($sql);
                $estado->execute();
                header("HTTP/1.1 200 OK");
                echo json_encode($sql);
                exit();
            }

            
            public function ModificarCarreras(int $id,string $nombre ){
                $input = $_POST;
                $sql = "UPDATE carreras SET Nombre = $nombre, WHERE ID=$id";
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