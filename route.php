<?php 
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/controllers/indumentariacontroller.php";
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/controllers/usercontroller.php";
    require_once "C:/xampp/htdocs/proyectos/mfindumentaria/controllers/categoriascontroller.php";

    
    $action = $_GET["action"];
    
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("URL_LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("URL_LOGUEADO", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/entrarcomoinvitado');

    $controller = new mfindumentariacontroller();
    $controlleruser = new usercontroller();
    $categoriascontroller = new categoriascontroller();

    if($action == ''){
        $controller->getindumentaria();
    }
    else{
        if (isset($action)){
            $partesURL = explode("/", $action);

            if($partesURL[0] == "articulos"){
                $controller->getindumentaria();

            }elseif($partesURL[0] == "insertar") {
                $controller->insertararticulo();
            }
            if($partesURL[0] == "borrararticulo") {
                $controller->borrararticulo($partesURL[1]);
            }
            elseif($partesURL[0] == "mostrararticulo"){
                $controller->getarticulo($partesURL[1]);
            }
            elseif($partesURL[0] == "modificararticulo"){
                $controller->modificararticulo($partesURL[1]);
            }
            if($partesURL[0] == "categorias"){
                $controller->getindumentaria();
            }
            elseif($partesURL[0] == "insertar") {
                $categoriascontroller->insertarcategoria();
            }
            elseif($partesURL[0] == "mostrar"){
                $categoriascontroller->getcategoria($partesURL[1]);
            }
            elseif($partesURL[0] == "borrarcategoria") {
                $categoriascontroller->borrarcategoria($partesURL[1]);
            }
            elseif($partesURL[0] == "modificarcategoria"){
                $categoriascontroller->modificarcategoria($partesURL[1]);
            }
            if($partesURL[0] == "login") {
                $controlleruser->Login();
            }
            if($partesURL[0] == "iniciarSesion") {
                $controlleruser->IniciarSesion();
            }
            if($partesURL[0] == "entrarcomoinvitado") {
                $controlleruser->EntrarComoInvitado();
            }
            if($partesURL[0] == "registrarse") {
                $controlleruser->Registrarse();
            }
            if($partesURL[0] == "completarregistro"){
                $controlleruser->Registrar();
            }
            if($partesURL[0] == "mostrararticuloinvitado") {
                $controlleruser->mostrararticuloguest($partesURL[1]);
            }
            elseif($partesURL[0] == "mostrarcategoriainvitado"){
                $controlleruser->mostrarcategoriaguest($partesURL[1]);
            }
            if($partesURL[0] == "logout"){
                $controlleruser->logout();
            }
            if($partesURL[0] == "permiso"){
                $controlleruser->permisos($partesURL[1]);
            }
            if($partesURL[0] == "borrar"){
                $controlleruser->borraruser($partesURL[1]);
            }
        }
    }
?>