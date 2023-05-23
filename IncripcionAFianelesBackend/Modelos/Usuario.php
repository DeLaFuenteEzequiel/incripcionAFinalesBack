<?php
    class Usuario{
        public int $ID;
        public ?string $Nombre;
        public ?string $Contraseña;
        public ?string $Email;
        public Rol $Rol;

        public function __construct(int $id, ?string $nombre, ?string $contraseña, ?string $email, Rol $rol)
        {
            $this->ID = $id;
            $this->Nombre = $nombre;
            $this->Contraseña = $contraseña;
            $this->Email = $email;
            $this->Rol = $rol;
        }
    }
?>