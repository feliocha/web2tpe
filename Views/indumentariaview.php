<?php

require_once('libs/Smarty.class.php');

class indumentariaview {

    function __construct(){

    }

    public function displayindumentaria($mfindumentaria, $cat, $users){
       
        $smarty = new Smarty();
        $smarty->assign('titulo',"mfindumentaria");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('lista_indumentaria',$mfindumentaria);
        $smarty->assign('lista_categorias',$cat);
        $smarty->assign('lista_users',$users);
        $smarty->display('templates/show_indumentaria.tpl');
    }

    public function displaycategoria($mfindumentaria, $cate){
       
        $smarty = new Smarty();
        $smarty->assign('titulo',"mfindumentaria");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('lista_indumentaria',$mfindumentaria);
        $smarty->assign('categoria',$cate);
        $smarty->display('templates/show_categoria.tpl');
    }

    public function displayarticulo($mfindumentaria){
       
        $smarty = new Smarty();
        $smarty->assign('titulo',"mfindumentaria");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('articulo',$mfindumentaria);
        $smarty->display('templates/show_articulo.tpl');
    }
}