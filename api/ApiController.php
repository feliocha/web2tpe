<?php

abstract class ApiController {
    protected $modelcat;
    protected $modelindumentaria;
    protected $modelcomentarios;
    protected $view;
    private $data; 

    public function __construct() {
        $this->view = new JSONView();
        $this->data = file_get_contents("php://input"); 
        $this->modelindumentaria = new indumentariamodel();
        $this->modelcat = new categoriasmodel();
        $this->modelcomentarios = new comentariosmodel();
    }

    function getData(){ 
        return json_decode($this->data); 
    }  
}