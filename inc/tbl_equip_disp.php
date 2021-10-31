<?php
include_once 'functions.php';
class TablaEquiposDisponibles{
    public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function insertEquipoUser($user,$prod){
        try {
            $con = $this->connect();
            $ps = $con->prepare("INSERT INTO tbl_equip_disp (id_prod_fk,id_user_fk,cant_disp) VALUES (?,?,?)");
            $ps->bindValue(1,$prod,PDO::PARAM_INT);
            $ps->bindValue(2,$user,PDO::PARAM_INT);
            $ps->bindValue(3,0,PDO::PARAM_INT);
            $ps->execute();
            $this->disconnect();
        } catch (Exception $e){
            var_dump($e);
        }
    }
}
?>