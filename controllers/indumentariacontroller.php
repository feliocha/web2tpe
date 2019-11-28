<?php
    require_once "./models/indumentariamodel.php";
    require_once "./models/categoriasmodel.php";
    require_once "./Views/indumentariaview.php";

    
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
            $imagenes = $this->modelindumentaria->getimagenesart($id_articulo);
            $mfindumentaria = $this->modelindumentaria->getarticulo($id_articulo);
            $this->view->displayarticulo($user,$mfindumentaria,$imagenes);
        }

        public function insertararticulo(){
            $this->checkLogIn();
            $rutatempimagenes = $_FILES['imagenes']['tmp_name'];
            if ($this->tipoimgcorrecto($_FILES['imagenes']['type'])) {
                $this->modelindumentaria->insertararticulo($_POST['nombre'], $_POST['precio'], $_POST['categoria'], $rutatempimagenes);    
            }
            header("Location: " . BASE_URL);
        }
        
        private function tipoimgcorrecto($imagenesTipos){
            foreach ($imagenesTipos as $tipo) {
              if($tipo != ('image/jpeg' || 'image/jpg' || 'image/png')) {
                return false;
              }
            }
            return true;
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

        public function borrarimg($id_imagen){
            $this->checkLogin();
            $rutalocal = $this->modelindumentaria->rutaimglocal($id_imagen);
            unlink($rutalocal->path);
            $this->modelindumentaria->borrarimg($id_imagen);
            header("Location: " . BASE_URL); //poner ruta de art
        }
    }