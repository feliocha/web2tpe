<?php

require_once('libs/Smarty.class.php');

class userview {

    function __construct(){

    }

    public function DisplayLogin(){

        $smarty = new Smarty();
        $smarty->assign('titulo',"Login");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->display('templates/login.tpl');
    }
    
    public function ingresarinvitado($mfindumentaria, $cat){
        $smarty= new Smarty();
        $smarty->assign('titulo',"Home");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('lista_indumentaria',$mfindumentaria);
        $smarty->assign('lista_categorias',$cat);
        $smarty->display('templates/invitado.tpl');
    }

    public function Registrarse(){
        $smarty= new Smarty();
        $smarty->assign('titulo',"Registrarse");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->display('templates/register.tpl');
    }

    public function mostrararticuloguest($mfindumentaria,$usuario,$usuarioname,$imagenes){
        $smarty = new Smarty();
        $smarty->assign('titulo',"mfindumentaria");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('articulo',$mfindumentaria);
        $smarty->assign('user',$usuario);
        $smarty->assign('nombreusuario',$usuarioname);
        $smarty->assign('imagenes',$imagenes);
        $smarty->display('templates/showarticuloinvitado.tpl');
    }

    public function mostrarcategoriaguest($mfindumentaria, $cate){
        $smarty = new Smarty();
        $smarty->assign('titulo',"mfindumentaria");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('lista_indumentaria',$mfindumentaria);
        $smarty->assign('categoria',$cate);
        $smarty->display('templates/showcategoriainvitado.tpl');
    }
}