<?php
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/models/indumentariamodel.php";
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/models/categoriasmodel.php";
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/Views/indumentariaview.php";

    
    class mfindumentariacontroller {

        private $modelindumentaria;
        private $modelcat;
        private $view;
        private $userview;
        private $modeluser;

        function __construct() {
            $this->modelindumentaria = new indumentariamodel();
            $this->modelcat = new categoriasmodel();
            $this->view = new indumentariaview();
            $this->modeluser = new UserModel();
        }

        private function checkLogIn() {
            session_start();       
            if (!isset($_SESSION['userId']) || ($_SESSION['adm'] == 0)){
                header('Location: ' . URL_LOGIN);
                die();
            }           
        }

    //muestra todo
    
        public function getindumentaria(){
            $this->checkLogIn();
            session_start();
            $insession = $_SESSION['userId'];
            $mfindumentaria = $this->modelindumentaria->getarticulos();
            $cat = $this->modelcat->getcategorias();
            $users = $this->modeluser->getusers($insession);
            $this->view->displayindumentaria($mfindumentaria, $cat, $users);
        }

        
        public function getarticulo($id_articulo){
            $this->checkLogIn();
            $user= $_SESSION['adm'];
            $imagenes = $this->modelindumentaria->getimg($id_articulo);
            $mfindumentaria = $this->modelindumentaria->getarticulo($id_articulo);
            $this->view->displayarticulo($user,$mfindumentaria,$imagenes);
        }

        public function insertararticulo(){
            $this->checkLogIn();
            if ($_FILES['imagen']['name']) {
                if ($_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/png") {
                    $this->modelindumentaria->insertararticulo($_POST['nombre'], $_POST['precio'], $_POST['categoria'], $_FILES['imagen']);
                }
                else {
                    $error = "Formato no aceptado";
                    var_dump($error);
                    die();
                }
            }
            else {
                $this->modelindumentaria->insertararticulo($_POST['nombre'], $_POST['precio'], $_POST['categoria']);
            }
            header("Location: " . BASE_URL);
        }
        
        public function borrararticulo($id_articulo){
            $this->checkLogIn();
            $this->modelindumentaria->borrararticulo($id_articulo);
            header("Location: " . BASE_URL);
        }

        public function modificararticulo($id_articulo){
            $this->checkLogIn();
            $this->modelindumentaria->modificararticulo($_POST['nombremodificado'],$_POST['preciomodificado'],$id_articulo);
            header("Location: " . BASE_URL);
        
        }
    }