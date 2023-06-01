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
        }

        public function conectar(){
            try{

                $coneccion = "mysql:host=".$this->Host.";dbname=".$this->Db;
                $options=[
                    PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($coneccion,$this->Usuario, $this->Contra);
                return $pdo;
            }
            catch(Exception $e){                
                exit($e->getMessage());
            }
        }
    }
?>