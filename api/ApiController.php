<?php

abstract class ApiController {
    protected $modelcat;
    protected $modelindumentaria;
    protected $view;
    private $data; 

    public function __construct() {
        $this->view = new JSONView();
        $this->data = file_get_contents("php://input"); 
        $this->modelindumentaria = new indumentariamodel();
        $this->modelcat = new categoriasmodel();
    }

    function getData(){ 
        return json_decode($this->data); 
    }  
}