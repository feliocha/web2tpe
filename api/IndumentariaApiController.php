<?php
require_once("./models/indumentariamodel.php");
require_once("./models/categoriasmodel.php");
require_once("./api/ApiController.php");
require_once("./api/JSONView.php");

class IndumentariaApiController extends ApiController{
  
    public function getindumentaria($params = null) {
        $mfindumentaria = $this->modelindumentaria->getarticulos();
        $this->view->response($mfindumentaria, 200);
    }

    /**
     * Obtiene una tarea dado un ID
     * 
     * $params arreglo asociativo con los parámetros del recurso
     */
    public function getarticulo($params = null) {
        // obtiene el parametro de la ruta
        $id = $params[':ID'];
        
        $articulo = $this->modelindumentaria->getarticulo($id);
        
        if ($articulo) {
            $this->view->response($articulo, 200);   
        } else {
            $this->view->response("No existe la tarea con el id={$id}", 404);
        }
    }

    // TareasApiController.php
    public function borrararticulo($params = []) {
        $id = $params[':ID'];
        $articulo = $this->modelindumentaria->getarticulo($id);

        if ($articulo) {
            $this->modelindumentaria->borrararticulo($id);
            $this->view->response("articulo=$id eliminado con éxito", 200);
        }
        else 
            $this->view->response("articulo id=$_id not found", 404);
    }

    // TareaApiController.php
   public function insertararticulo($params = []) {     
        $body = $this->getData();

        // inserta la tarea
        $nombre = $body->nombre;
        $precio = $body->precio;
        $categoria = $body->id_categoria;
        $articulo = $this->modelindumentaria->insertararticulo($nombre,$precio,$categoria);
    }

    // TaskApiController.php
    public function actualizararticulo($params = []) {
        $id = $params[':ID'];
        $articulo = $this->modelindumentaria->getarticulo($id);

        if ($articulo) {
            $body = $this->getData();
            $nombre = $body->nombre;
            $precio = $body->precio;
            $categoria = $body->id_categoria;
            $articulo = $this->modelindumentaria->actualizararticulo($nombre,$precio,$id);
            $this->view->response("articulo id=$id actualizado con éxito", 200);
        }
        else 
            $this->view->response("articulo id=$id not found", 404);
    }


}