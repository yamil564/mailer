<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexion
 *
 * @author User
 */
class Conexion {   
    //varible de conexion
    private $conexion;
    
    //contructor
    public function __construct() {
        try{
            $cadena="mysql:host=".DB_HOST.";dbname=".DB_NAME.";.DB_CHARSET.";
            $this->conexion = new PDO($cadena, DB_USER, DB_PASSWORD);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            $this->conexion = "Error de conexion";
            echo "ERROR: ".$ex->getMessage();
        }
    }

    //funciones
    public function conectar(){
        return $this->conexion;
    }
    
    public function desconectar(){
        $this->conexion->close();
    }   
}
