<?php

class comentariosmodel {
    private $db;
    
    function __construct(){
        $this->db = new PDO ('mysql:host=localhost;'.'dbname=mfindumentaria;charset=utf8', 'root', '');
    }

    public function getcomentarios(){
        $sentencia = $this->db->prepare( "SELECT * FROM comentarios");
        $sentencia->execute();
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $comentarios; 
    }

    public function insertarcomentario($id_articulo,$usuario,$texto,$calificacion){
        $sentencia = $this->db->prepare("INSERT INTO comentarios(id_articulo,usuario,texto,calificacion) VALUES(?,?,?,?)");
        $sentencia->execute(array($id_articulo,$usuario,$texto,$calificacion));
    }

    public function getcomentariosart($id){
        $sentencia = $this->db->prepare( "SELECT * FROM comentarios WHERE id_articulo=?");
        $sentencia->execute(array($id));
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $comentarios; 
    }

    public function getcomentariospromedio($id){
        $sentencia = $this->db->prepare( "SELECT AVG(calificacion) FROM comentarios WHERE id_articulo=?");
        $sentencia->execute(array($id));
        $promedio = $sentencia->fetch(PDO::FETCH_OBJ);

        return $promedio; 
    }

    public function borrarcomentario($id){
        $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario=?");
        $sentencia->execute(array($id));
    }
}