<?php
class Profesor extends Orm{
    public function __construct($conn)
    {
        parent::__construct("id", "profesores", $conn);
    }
}