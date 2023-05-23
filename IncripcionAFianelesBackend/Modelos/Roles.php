<?php
    class Rol{
        public int $ID;
        public ?string $Nombre;

        public function __construct(int $id, ?string $nombre)
        {
            $this->ID = $id;
            $this->Nombre = $nombre;
        }
}

?>