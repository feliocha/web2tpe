<?php
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/models/indumentariamodel.php";
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/models/categoriasmodel.php";
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/Views/indumentariaview.php";


    class categoriascontroller {
        
        private $modelindumentaria;
        private $modelcat;
        private $view;
        private $userview;
    
        function __construct() {
            $this->modelindumentaria = new indumentariamodel();
            $this->modelcat = new categoriasmodel();
            $this->view = new indumentariaview();
        }

        private function checkLogIn() {
            session_start();       
            if (!isset($_SESSION['userId']) || ($_SESSION['adm'] == 0)){
                header('Location: ' . URL_LOGIN);
                die();
            }           
        }

        public function getcategoria($id_categoria){
            $this->checkLogIn();
            $mfindumentaria = $this->modelindumentaria->getarticuloscat($id_categoria);
            $cate = $this->modelcat->getcategoria($id_categoria);
            $this->view->displaycategoria($mfindumentaria, $cate);
        }

        public function insertarcategoria(){
            $this->checkLogIn();
            $this->modelcat->insertarcategoria($_POST['nombre'],$_POST['cantidad']);
            header("Location: " . BASE_URL);
        }

        public function borrarcategoria($id_categoria){
            $this->checkLogIn();
            $this->modelcat->borrarcategoria($id_categoria);
            header("Location: " . BASE_URL);
        }

        public function modificarcategoria($id_categoria){
            $this->checkLogIn();
            $this->modelcat->modificarcategoria($_POST['categoriamodificada'],$_POST['cantidadnueva'],$id_categoria);
            header("Location: " . BASE_URL);
        }
    }