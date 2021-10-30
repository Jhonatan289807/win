<?php
include_once 'functions.php';

class Conexion{
    private $conexion;

    public function __construct(){
        try {
            $this->conexion = new PDO('mysql:host='.SERVER.';dbname='.BD,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false));
        }catch (PDOException $e) {
            return $e;
        }
    }
    public function getConn(){
        if($this->conexion instanceof PDO){
            return $this->conexion;
        }else{
            return false;
        }
    }
    public function disconnected(){
        $this->conexion = null;
    }
}
?>