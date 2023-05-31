<?php
    class DB{
        private $Host;
        private $Db;
        private $Usuario;
        private $Contra;
        private $Charset;

        public function __construct()
        {
            $this->Host = 'localhost';
            $this->Db = 'finalesdb';
            $this->Usuario = 'root';
            $this->Contra = "";
            $this->Charset = 'utf8mb4';            
        }

        function conectar(){
            try{

                $coneccion = "mysql:host=".$this->Host.";dbname=" . this->Db . ";charset=" . this->Charset . ;
                $options=[
                    PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($coneccion,$this->User, $this->Password);
                return $pdo
            }
            catch(Exception $e){                
                return $e->getMessage();
            }
        }
    }
?>