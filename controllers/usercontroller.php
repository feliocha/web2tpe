<?php
require_once "./models/usermodel.php";
require_once "./Views/userview.php";
require_once "./Views/indumentariaview.php";
require_once "./models/indumentariamodel.php";
require_once "./models/categoriasmodel.php";

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
    
    public function IniciarSesion(){
        $password = $_POST['pass'];
        $usuario = $this->model->GetPassword($_POST['user']);

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
            header("Location: " . URL_LOGIN);
        }
    }

    //muestra el login
    public function Login(){
        $this->view->DisplayLogin();
    }
    
    public function logout(){
        session_start();
        session_destroy();
        header("Location: " . URL_LOGIN);
    }

    public function Registrarse(){
        $this->view->Registrarse();
    }

    public function Registrar(){
        $this->model->Registrar($_POST['user'],$_POST['pass'],$_POST['admin']);
        header("Location: " . URL_LOGIN);
    }

    public function EntrarComoInvitado(){
        session_start();
        if (!isset($_SESSION['userId'])) {
            $_SESSION['adm'] = 3;
        }
        $mfindumentaria = $this->modelindumentaria->getarticulos();
        $cat = $this->modelcat->getcategorias();
        $this->view->ingresarinvitado($mfindumentaria, $cat);
    }

    public function mostrararticuloguest($id_articulo){
        
        $mfindumentaria = $this->modelindumentaria->getarticulo($id_articulo);
        $usuario = $_SESSION['adm'];
        $this->view->mostrararticuloguest($mfindumentaria,$usuario);
    }

    public function mostrarcategoriaguest($id_categoria){
        $mfindumentaria = $this->modelindumentaria->getarticuloscat($id_categoria);
        $cate = $this->modelcat->getcategoria($id_categoria);
        $this->view->mostrarcategoriaguest($mfindumentaria, $cate);
    }

    public function permisos($userId){      
        $this->model->permisos($userId);
        header("Location: " . BASE_URL);
    }

    public function borraruser($userId){      
        $this->model->borraruser($userId);
        header("Location: " . BASE_URL);
    }
}