<?php
require_once("./models/indumentariamodel.php");
require_once("./models/categoriasmodel.php");
require_once("./models/comentariosmodel.php");
require_once("./api/ApiController.php");
require_once("./api/JSONView.php");

class IndumentariaApiController extends ApiController{
    
    //COMENTARIOS
    
    public function getcomentarios($params = null) {
        $comentarios = $this->modelcomentarios->getcomentarios();
        $this->view->response($comentarios, 200);
    }
    
    public function getcomentariospromedio($params = null) {
        $id = $params[':ID'];
        
        $promedio = $this->modelcomentarios->getcomentariospromedio($id);
        $this->view->response($promedio, 200);
    }
    

    public function getcomentariosart($params = null) {
        
        $id = $params[':ID'];
        
        $comentarios = $this->modelcomentarios->getcomentariosart($id);
        
        if ($comentarios) {
            $this->view->response($comentarios, 200);   
        } else {
            $this->view->response("No existe", 200);
        }
    }
    
    public function insertarcomentario($params = []) {     
        $body = $this->getData();
        // inserta la tarea
        $id_articulo = $body->id_articulo;
        $usuario = $body->usuario;
        $texto = $body->texto;
        $calificacion = $body->calificacion;
        $comentario = $this->modelcomentarios->insertarcomentario($id_articulo,$usuario,$texto,$calificacion);
    }

    public function borrarcomentario($params = []) {
        $id = $params[':ID'];
        //traer un comentario y chekear
        $this->modelcomentarios->borrarcomentario($id);
        $this->view->response("comentario=$id eliminado con éxito", 200);
    }

    //ARTICULOS
    public function getindumentaria($params = null) {
        $mfindumentaria = $this->modelindumentaria->getarticulos();
        $this->view->response($mfindumentaria, 200);
    }
    
    public function getarticulo($params = null) {
        
        $id = $params[':ID'];
        
        $articulo = $this->modelindumentaria->getarticulo($id);
        
        if ($articulo) {
            $this->view->response($articulo, 200);   
        } else {
            $this->view->response("No existe la tarea con el id={$id}", 404);
        }
    }

    
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

    
   public function insertararticulo($params = []) {     
        $body = $this->getData();

        // inserta la tarea
        $nombre = $body->nombre;
        $precio = $body->precio;
        $categoria = $body->id_categoria;
        $articulo = $this->modelindumentaria->insertararticulo($nombre,$precio,$categoria);
    }

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