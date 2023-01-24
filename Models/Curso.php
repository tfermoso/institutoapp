<?php
class Curso extends Orm{
    public function __construct($conn)
    {
        parent::__construct("id", "cursos", $conn);
    }
}