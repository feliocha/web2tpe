<?php

class indumentariamodel {
    private $db;
    
    function __construct(){
        $this->db = new PDO ('mysql:host=localhost;'.'dbname=mfindumentaria;charset=utf8', 'root', '');
    }

    public function getarticulos(){
        $sentencia = $this->db->prepare( "SELECT * FROM articulos");
        $sentencia->execute();
        $articulos = $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $articulos;
    }

    public function getarticulo($id_articulo){
        //hay que poner el JOIN para poner el nombre de la categoria al lado de cada articulo
        $sentencia = $this->db->prepare("SELECT * FROM articulos WHERE id_articulo=?");
        $sentencia->execute(array($id_articulo));
        $articulo = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $articulo;
    }
    
    public function getarticuloscat($id_categoria){
        $sentencia = $this->db->prepare("SELECT * FROM articulos WHERE id_categoria=?");
        $sentencia->execute(array($id_categoria));
        $articulos = $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $articulos;
    }

    public function insertararticulo($nombre,$precio,$categoria,$rutatemporal){
        $sentencia = $this->db->prepare("INSERT INTO articulos(nombre,precio,id_categoria) VALUES(?,?,?)");
        $sentencia->execute(array($nombre,$precio,$categoria));
        $id_articulo = $this->db->lastInsertId();
        $rutas = $this->subirImagenes($rutatemporal);
        $sentenciaimg = $this->db->prepare("INSERT INTO imagenes(id_articulo,path) VALUES(?,?)");
        foreach ($rutas as $ruta) {
            $sentenciaimg->execute(array($id_articulo,$ruta));
        }
    }

    private function subirImagenes($imagenes){
        $rutas = [];
        foreach ($imagenes as $imagen) {
          $destino_final = 'img/articulos/' . uniqid() . '.jpg';
          move_uploaded_file($imagen, $destino_final);
          $rutas[]=$destino_final;
        }
        return $rutas;
      }
    

    
    private function moveFile($imagen) {
        $filepath = "img/articulos/" . uniqid() . "." . strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));  
        move_uploaded_file($imagen['tmp_name'], $filepath);
        return $filepath;
    }

    public function getimg($id_articulo){
        $sentencia = $this->db->prepare("SELECT * FROM imagenes WHERE id_articulo=?");
        $sentencia->execute(array($id_articulo));
        $imagenes = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $imagenes;
    }

    public function borrararticulo($id_articulo){
        $sentencia = $this->db->prepare("DELETE FROM articulos WHERE id_articulo=?");
        $sentencia->execute(array($id_articulo));
    }

    public function modificararticulo($nombremodificado,$preciomodificado,$id_articulo){
        $sentencia = $this->db->prepare("UPDATE articulos SET nombre=?, precio=? WHERE id_articulo=?");
        $sentencia->execute(array($nombremodificado,$preciomodificado,$id_articulo));
    }
}