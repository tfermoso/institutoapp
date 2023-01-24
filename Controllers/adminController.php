<?php

class AdminController extends Controller
{
    private $mensajes;
    public function __construct()
    {
        $conn = new Database();
        $msj = new Mensaje($conn->getConnection());
        $this->mensajes=$msj->getAllByIdUserDestino($_SESSION["idusuario"]);
    }

    public function index()
    {   
        //require_once(__DIR__ . './../Views/Admin/admin.view.php');
        $datos=array();
        $datos["mensajes"]=$this->mensajes;
        $datos["user_name"]=$_SESSION["nombre"];
        $this->render("Admin/admin",$datos,"Admin/layout/admin");
    }
    public function nuevomensaje()
    {
        if (isset($_POST["usr_destino"])) {
        
            $conn = new Database();
            $usr = new Mensaje($conn->getConnection());
            $datos=array();
            $datos["id_usuario_origen"]=$_SESSION["idusuario"];
            $datos["id_usuario_destino"]=$_POST["usr_destino"];
            $datos["mensaje"]=$_POST["mensaje"];
            $usr->insertar($datos);
            header("Location:".URL_PATH."/admin");
        } else {

            $user_name = $_SESSION["nombre"];
            $conn = new Database();
            $usr = new Usuario($conn->getConnection());
            $usuarios = $usr->getAllLessMe($_SESSION["idusuario"]);
            $options = "";
            foreach ($usuarios as $key => $value) {
                $options .= "<option value=" . $value['id'] . ">" . $value['nombre'] . "</option>";
            }
            $datos=array();
            $datos["mensajes"]=$this->mensajes;
            $datos["options"]=$options;
            $datos["usuarios"]=$usuarios;
            $datos["user_name"]=$_SESSION["nombre"];
            //require_once(__DIR__ . './../Views/Admin/admin_nuevomensaje.view.php');
            $this->render("Admin/admin_nuevomensaje",$datos,"Admin/layout/admin");

        }
    }

    public function close(){
        session_destroy();
        header("Location: ".URL_PATH."/login");
    }

    public function altaprofesor(){

        $datos=array();
        $datos["mensajes"]=$this->mensajes;
        $datos["user_name"]=$_SESSION["nombre"];
        if(isset($_POST["nombre"])){
            $conn = new Database();
            $profesor = new Profesor($conn->getConnection());
            $datos=array();
            $datos["dni"]=$_POST["dni"];
            $datos["nombre"]=$_POST["nombre"];
            $datos["direccion"]=$_POST["direccion"];
            $datos["telefono"]=$_POST["telefono"];
            $profesor->insertar($datos);
            header("Location:".URL_PATH."/admin");
        }

        $this->render("Admin/altaprofesor",$datos,"Admin/layout/admin");
    }

    public function altaalumno(){

        $datos=array();
        $datos["mensajes"]=$this->mensajes;
        $datos["user_name"]=$_SESSION["nombre"];
        if(isset($_POST["nombre"])){
            $conn = new Database();
            $alumno = new Alumno($conn->getConnection());
            $datos=array();
            $datos["expediente"]=$_POST["expediente"];
            $datos["nombre"]=$_POST["nombre"];
            $datos["apellidos"]=$_POST["apellidos"];
            $datos["fecha_nacimiento"]=$_POST["fecha_nacimiento"];
            $alumno->insertar($datos);
            header("Location:".URL_PATH."/admin");
        }

        $this->render("Admin/altaalumno",$datos,"Admin/layout/admin");
    }

    
    public function curso(){

        $datos=array();
        $datos["mensajes"]=$this->mensajes;
        $datos["user_name"]=$_SESSION["nombre"];
        //Obtenemos los Alumnos;
        $conn = new Database();
        $alumno = new Alumno($conn->getConnection());
        $alumnos=$alumno->getAll();
        $optionsAlumnos = "";
        foreach ($alumnos as $key => $value) {
            $optionsAlumnos .= "<option value=" . $value['idalumnos'] . ">" . $value['nombre'] . "</option>";
        }
        $datos["optionsAlumnos"]=$optionsAlumnos;
        //Obtenemos los profesores
        $conn = new Database();
        $profesor = new Profesor($conn->getConnection());
        $profesores=$profesor->getAll();
        $optionsProfesores = "";
        foreach ($profesores as $key => $value) {
            $optionsProfesores .= "<option value=" . $value['idprofesores'] . ">" . $value['nombre'] . "</option>";
        }
        $datos["optionsProfesores"]=$optionsProfesores;

        if(isset($_POST["nombre"])){

            $conn = new Database();
            $curso = new Curso($conn->getConnection());
            $datos=array();
            $datos["codigo"]=$_POST["codigo"];
            $datos["nombre"]=$_POST["nombre"];
            $datos["idprofesores"]=$_POST["idprofesores"];
            $datos["idalumnos"]=$_POST["idalumnos"];
            $curso->insertar($datos);
            header("Location:".URL_PATH."/admin");
        }

        $this->render("Admin/altacurso",$datos,"Admin/layout/admin");
    }
}
