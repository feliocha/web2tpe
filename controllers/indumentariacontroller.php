<?php
    require_once "./models/indumentariamodel.php";
    require_once "./models/categoriasmodel.php";
    require_once "./models/usermodel.php";
    require_once "./Views/indumentariaview.php";

    
    class mfindumentariacontroller {

        private $modelindumentaria;
        private $modelcat;
        private $view;
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

            //obtengo el usuario en sesion
            //para traer la lista de usuarios excepto el
            $insession = $_SESSION['userId'];
            $users = $this->modeluser->getusers($insession);
            
            $mfindumentaria = $this->modelindumentaria->getarticulos();
            $cat = $this->modelcat->getcategorias();
            $this->view->displayindumentaria($mfindumentaria, $cat, $users);
        }

        
        public function getarticulo($id_articulo){
            $this->checkLogIn();
            $user= $_SESSION['adm'];
            
            $mfindumentaria = $this->modelindumentaria->getarticulo($id_articulo);
            if ($mfindumentaria) {
                $imagenes = $this->modelindumentaria->getimagenesart($id_articulo);
                $this->view->displayarticulo($user,$mfindumentaria,$imagenes);               
            }else {
                //mostrar view generica (no se encontro el id)
            }
            
        }

        public function insertararticulo(){
            $this->checkLogIn();
            //agarra ruta temporal de imagenes
            $imagenes = $_FILES['imagenes'];
            $rutatempimagenes = $_FILES['imagenes']['tmp_name'];
            
            if ($imagenes['name'][0] != ''){
                if ($this->tipoimgcorrecto($imagenes['type'])) {
                    $id = $this->modelindumentaria->insertararticulo($_POST['nombre'], $_POST['precio'], $_POST['categoria']);
                    $this->modelindumentaria->insertarimg($rutatempimagenes,$id);    
                    header("Location: " . BASE_URL);
                }
                else {
                    //mostrar view generica de mostrar error (tipo img incorrecto)
                }
            }
            else {
                $this->modelindumentaria->insertararticulo($_POST['nombre'], $_POST['precio'], $_POST['categoria']);
                header("Location: " . BASE_URL);
            }
        }
        
        
        
        public function borrararticulo($id_articulo){
            $this->checkLogIn();
            $this->modelindumentaria->borrararticulo($id_articulo);
            header("Location: " . BASE_URL);
        }

        public function modificararticulo($id_articulo){
            $this->checkLogIn();
            $this->modelindumentaria->modificararticulo($_POST['nombremodificado'],$_POST['preciomodificado'],$id_articulo);
            header("Location: " . BASE_URL . "mostrararticulo/" . $id_articulo);
        }

        //IMAGENES
        
        public function borrarimg($id_imagen){
            $this->checkLogin();
            $rutalocal = $this->modelindumentaria->rutaimglocal($id_imagen);
            unlink($rutalocal->path);
            $this->modelindumentaria->borrarimg($id_imagen);
            header("Location: " . BASE_URL);
        }
        
        public function agregarnuevaimg($id_articulo){
            $this->checkLogin();
            $rutatempimagenes = $_FILES['imagenes']['tmp_name'];
            if ($this->tipoimgcorrecto($_FILES['imagenes']['type'])) {
                $this->modelindumentaria->insertarimg($id_articulo,$rutatempimagenes);
            }
            header("Location: " . BASE_URL . "mostrararticulo/" . $id_articulo); //poner ruta de art
        }

        private function tipoimgcorrecto($imagenesTipos){
            foreach ($imagenesTipos as $tipo) {
              if($tipo == 'image/jpeg' || $tipo == 'image/jpg' || $tipo == 'image/png') {
                return true;
              }
            }
            return false;
        }
    }