<?php 
 public class MesaDeExamen 
 {
    public int $ID;
    public DateTime  $Fecha ;
    public Materia $Materia;
    public Profesor $Profesor;

    public function _construct(int $id, DateTime $fecha ,Materia $materia ,Profesor $profesor)
    {
        $this->$ID =$id;
        $this->$fecha =;
        $this->$Materia=$materia;
        $this->$Profesor=$profesor;

    }
 }

?>