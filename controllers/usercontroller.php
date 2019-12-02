<?php

require_once "./models/usermodel.php";
require_once "./models/indumentariamodel.php";
require_once "./models/categoriasmodel.php";
require_once "./Views/userview.php";

class usercontroller {

    private $model;
    private $view;
    private $modelindumentaria;
    private $modelcat;

	function __construct(){
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->modelindumentaria = new indumentariamodel();
        $this->modelcat = new categoriasmodel();
    }

    private function checkLogIn() {
        session_start();       
        if (!isset($_SESSION['userId']) || ($_SESSION['adm'] == 0)){
            header('Location: ' . URL_LOGIN);
            die();
        }           
    }
    
    //INICIAR SESION
    
    public function IniciarSesion(){
        
        $password = $_POST['pass'];
        $usuario = $this->model->getuserdata($_POST['user']);

        if (isset($usuario) && $usuario != null && password_verify($password, $usuario->pass)){
            session_start();
            $_SESSION['user'] = $usuario->email;
            $_SESSION['userId'] = $usuario->userId;
            $_SESSION['adm'] = $usuario->admin;
            
            if ($usuario->admin == 1){
                header('Location:' . BASE_URL);
            }else{
                header('Location:' . URL_LOGUEADO);
            }

        }else{
            header("Location: " . URL_LOGIN); //o mostrar una vista de inicio erroneo de sesion
        }
    }

    //CERRAR SESION
    
    public function logout(){
        session_start();
        session_destroy();
        header("Location: " . URL_LOGIN);
    }
    
    //REGISTRARSE
    
    public function Registrar(){
        $this->model->Registrar($_POST['user'],$_POST['pass'],$_POST['admin']);
        header("Location: " . URL_LOGIN);
    }

    
    //MOSTRAR VISTA INVITADO/LOGEADO
    
    public function EntrarComoInvitado(){
        $mfindumentaria = $this->modelindumentaria->getarticulos();
        $cat = $this->modelcat->getcategorias();
        $this->view->ingresarinvitado($mfindumentaria, $cat);
    }

    public function mostrararticuloguest($id_articulo){
        
        session_start();
        
        if (!isset($_SESSION['adm'])) {
            $usuariopermiso = 3;
        }else {
            $usuariopermiso = 0;
        }
        
        if (isset($_SESSION['user'])) {
            $usuarioname = $_SESSION['user'];
        }else {
            $usuarioname = "invitado";
        }

        $imagenes = $this->modelindumentaria->getimagenesart($id_articulo);
        $mfindumentaria = $this->modelindumentaria->getarticulo($id_articulo);
        $this->view->mostrararticuloguest($mfindumentaria,$usuariopermiso,$usuarioname,$imagenes);
    }
    
    public function mostrarcategoriaguest($id_categoria){
        $mfindumentaria = $this->modelindumentaria->getarticuloscat($id_categoria);
        $cate = $this->modelcat->getcategoria($id_categoria);
        $this->view->mostrarcategoriaguest($mfindumentaria, $cate);
    }

    //ADMINISTRADOR
    
    public function permisos($userId){      
        $this->model->permisos($userId);
        header("Location: " . BASE_URL);
    }

    public function borraruser($userId){      
        $this->model->borraruser($userId);
        header("Location: " . BASE_URL);
    }
    
    //VIEWS

    public function Login(){
        $this->view->DisplayLogin();
    }

    public function Registrarse(){
        $this->view->Registrarse();
    }
}