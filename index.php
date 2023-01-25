<?php
require_once("config.php");
require_once("router.php");
require_once("./Models/Database.php");
require_once("./Models/Orm.php");
require_once("./Models/Usuario.php");
require_once("./Models/Mensaje.php");
require_once("./Models/Profesor.php");
require_once("./controllers/controller.php");
require_once("./Models/Alumno.php");
require_once("./Models/Curso.php");
require_once("./Models/CursoDTO.php");





$ruta=isset($_GET["route"])?$_GET["route"]:"";
$route=new Router($ruta);
$route->run();

