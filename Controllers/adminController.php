<?php

class AdminController extends Controller
{
    private $mensajes;
    private $datos;
    public function __construct()
    {
        $conn = new Database();
        $msj = new Mensaje($conn->getConnection());
        $this->mensajes=$msj->getAllByIdUserDestino($_SESSION["idusuario"]);
        $this->datos=array();
        $this->datos["controller"]="admin";
    }

    public function index()
    {   
        //require_once(__DIR__ . './../Views/Admin/admin.view.php');
        $this->datos["action"]='';
        $this->datos["mensajes"]=$this->mensajes;
        $this->datos["user_name"]=$_SESSION["nombre"];
        $this->render("Admin/admin",$this->datos,"Admin/layout/admin");
    }
    public function nuevomensaje()
    {
        $this->datos["action"]="nuevomensaje";
        if (isset($_POST["usr_destino"])) {
        
            $conn = new Database();
            $usr = new Mensaje($conn->getConnection());
          
            $this->datos["id_usuario_origen"]=$_SESSION["idusuario"];
            $this->datos["id_usuario_destino"]=$_POST["usr_destino"];
            $this->datos["mensaje"]=$_POST["mensaje"];
            $usr->insertar($this->datos);
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
 
            $this->datos["mensajes"]=$this->mensajes;
            $this->datos["options"]=$options;
            $this->datos["usuarios"]=$usuarios;
            $this->datos["user_name"]=$_SESSION["nombre"];
            //require_once(__DIR__ . './../Views/Admin/admin_nuevomensaje.view.php');
            $this->render("Admin/admin_nuevomensaje",$this->datos,"Admin/layout/admin");

        }
    }

    public function close(){
        session_destroy();
        header("Location: ".URL_PATH."/login");
    }

    public function altaprofesor(){

        $this->datos["action"]="profesor@s";
        $this->datos["mensajes"]=$this->mensajes;
        $this->datos["user_name"]=$_SESSION["nombre"];
        if(isset($_POST["nombre"])){
            $conn = new Database();
            $profesor = new Profesor($conn->getConnection());
          
            $this->datos["dni"]=$_POST["dni"];
            $this->datos["nombre"]=$_POST["nombre"];
            $this->datos["direccion"]=$_POST["direccion"];
            $this->datos["telefono"]=$_POST["telefono"];
            $profesor->insertar($this->datos);
            header("Location:".URL_PATH."/admin");
        }

        $this->render("Admin/altaprofesor",$this->datos,"Admin/layout/admin");
    }

    public function altaalumno(){

        $this->datos["action"]="alumn@s";
        $this->datos["mensajes"]=$this->mensajes;
        $this->datos["user_name"]=$_SESSION["nombre"];
        if(isset($_POST["nombre"])){
            $conn = new Database();
            $alumno = new Alumno($conn->getConnection());        
            $this->datos["expediente"]=$_POST["expediente"];
            $this->datos["nombre"]=$_POST["nombre"];
            $this->datos["apellidos"]=$_POST["apellidos"];
            $this->datos["fecha_nacimiento"]=$_POST["fecha_nacimiento"];
            $alumno->insertar($this->datos);
            header("Location:".URL_PATH."/admin");
        }

        $this->render("Admin/altaalumno",$this->datos,"Admin/layout/admin");
    }

    
    public function curso(){

        $this->datos["action"]="curso";
        $this->datos["mensajes"]=$this->mensajes;
        $this->datos["user_name"]=$_SESSION["nombre"];
        //Obtenemos los Alumnos;
        $conn = new Database();
        $alumno = new Alumno($conn->getConnection());
        $alumnos=$alumno->getAll();
        $optionsAlumnos = "";
        foreach ($alumnos as $key => $value) {
            $optionsAlumnos .= "<option value=" . $value['idalumnos'] . ">" . $value['nombre'] . "</option>";
        }
        $this->datos["optionsAlumnos"]=$optionsAlumnos;
        //Obtenemos los profesores
        $conn = new Database();
        $profesor = new Profesor($conn->getConnection());
        $profesores=$profesor->getAll();
        $optionsProfesores = "";
        foreach ($profesores as $key => $value) {
            $optionsProfesores .= "<option value=" . $value['idprofesores'] . ">" . $value['nombre'] . "</option>";
        }
        $this->datos["optionsProfesores"]=$optionsProfesores;

        if(isset($_POST["nombre"])){

            $conn = new Database();
            $curso = new Curso($conn->getConnection());
            $this->datos=array();
            $this->datos["codigo"]=$_POST["codigo"];
            $this->datos["nombre"]=$_POST["nombre"];
            $this->datos["idprofesores"]=$_POST["idprofesores"];
            $this->datos["idalumnos"]=$_POST["idalumnos"];
            $curso->insertar($this->datos);
            header("Location:".URL_PATH."/admin");
        }

        $this->render("Admin/altacurso",$this->datos,"Admin/layout/admin");
    }

    public function matricular(){

        $this->datos["action"]="matrícula";
        $this->datos["mensajes"]=$this->mensajes;
        $this->datos["user_name"]=$_SESSION["nombre"];
       //Obtenemos los Alumnos;
       $conn = new Database();
       $curso = new Curso($conn->getConnection());
       $cursos=$curso->getAll();
       $optionsCursos = "<option value=''>Selecciona un curso</option>";
       foreach ($cursos as $key => $value) {
           $optionsCursos .= "<option value=" . $value['idcursos'] . ">" . $value['nombre'] . "</option>";
       }
       $this->datos["optionsCursos"]=$optionsCursos;
       

        $this->render("Admin/matricular",$this->datos,"Admin/layout/admin");
    }
}
