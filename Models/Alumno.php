<?php
class Alumno extends Orm{
    public function __construct($conn)
    {
        parent::__construct("id", "alumnos", $conn);
    }

    
}