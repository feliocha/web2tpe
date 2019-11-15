<?php

class categoriasmodel {
    private $db;
    
    function __construct(){
        $this->db = new PDO ('mysql:host=localhost;'.'dbname=mfindumentaria;charset=utf8', 'root', '');
    }

    public function getcategorias(){
        $sentencia = $this->db->prepare( "select * from categorias");
        $sentencia->execute();
        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $categorias; 
    }

    public function getcategoria($id_categoria){
        $sentencia = $this->db->prepare("SELECT * FROM categorias WHERE id_categoria=?");
        $sentencia->execute(array($id_categoria));
        $categoria = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $categoria;
    }

    public function insertarcategoria($nombre,$cantidad){
        $sentencia = $this->db->prepare("INSERT INTO categorias(nombre,cantidad) VALUES(?,?)");
        $sentencia->execute(array($nombre,$cantidad));
    }

    public function borrarcategoria($id_categoria){
        $sentencia = $this->db->prepare("DELETE FROM categorias WHERE id_categoria=?");
        $sentencia->execute(array($id_categoria));
    }

    public function modificarcategoria($categoriamodificada,$cantidadnueva,$id_categoria){
        $sentencia = $this->db->prepare("UPDATE categorias SET nombre=?, cantidad=? WHERE id_categoria=?");
        $sentencia->execute(array($categoriamodificada,$cantidadnueva,$id_categoria));
    } 
}