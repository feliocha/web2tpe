<?php

class UserModel {

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=mfindumentaria;charset=utf8', 'root', '');
    }

    public function getuserdata($user){
        $sentencia = $this->db->prepare( "SELECT * FROM usuarios WHERE email = ?");
        $sentencia->execute(array($user));
        
        $datosuser = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return $datosuser;
    }
    
    public function Registrar($user,$pass,$adm){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sentencia = $this->db->prepare("INSERT INTO usuarios(email,pass,admin) VALUES(?,?,?)");
        $sentencia->execute(array($user,$hash,$adm));
    }

    public function getusers($insession){
        $sentencia = $this->db->prepare("SELECT * FROM usuarios WHERE userId != $insession");
        $sentencia->execute(array($insession));
        $users = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
        return $users;
    }

    public function permisos($userId){
        $sentencia = $this->db->prepare("UPDATE usuarios SET admin = IF(admin = 1,0,1) WHERE userId = ?");
        $sentencia->execute(array($userId));
    }

    public function borraruser($userId){
        $sentencia = $this->db->prepare("DELETE FROM usuarios WHERE userId=?");
        $sentencia->execute(array($userId));
    }
}