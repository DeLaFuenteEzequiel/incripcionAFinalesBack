<?php
    class Profesor{
        public int $ID;
        public ?string $Nombre;
        public ?string $Apellido;

        public function __construct(int $id, ?string $nombre, ?string $apellido){
            $this->ID = $id;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
        }
    }
?>