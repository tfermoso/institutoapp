<?php
class CursoDTO
{
    public $db;
    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getAlmunosNoMatriculados($id){
        $stm=$this->db->prepare("select * from alumnos where idalumnos not in 
        (select idalumnos from alumnos_curso where idcursos=:id)");
        $stm->bindValue(":id",$id);
        $stm->execute();
        return $stm->fetchAll();
    }
}
