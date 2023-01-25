<?php
class CursoDTO
{
    public $db;
    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getAlmunosNoMatriculados($id){
        $stm=$this->db->prepare("select *,0 as 'Matriculado' from alumnos where idalumnos not in 
        (select idalumnos from alumnos_curso where idcursos=:id1)
        union
        select *,1 as 'Matriculado' from alumnos where idalumnos  in 
        (select idalumnos from alumnos_curso where idcursos=:id2)");
        $stm->bindValue(":id1",$id);
        $stm->bindValue(":id2",$id);
        $stm->execute();
        return $stm->fetchAll();
    }
}
