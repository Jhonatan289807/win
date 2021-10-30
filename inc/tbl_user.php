<?php
include_once 'functions.php';

class tblUser{
    public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function show_tbl(){
        $con = $this->connect();
        $ps = $con->prepare("SELECT * FROM tbl_user");
        $ps->execute();
        $array = array();
        while ($data = $ps->fetch(PDO::FETCH_ASSOC)){
            $obj = new user();
            $obj->setId($data["id"]);
            $obj->setUser($data["user"]);
            $obj->setUserpass($data["user_pass"]);
            $obj->setUserphone($data["user_phone"]);
            $obj->setTypeuser($data["type_user"]);
            array_push($array,$obj);
        }
        $this->disconnect();
        return $array;
    }
    public function add_user($user){
        $con = $this->connect();
        $ps = $con->prepare("INSERT INTO tbl_user (user_cod,user_pass,user_phone,type_user) VALUES (?,?,?,?)");
        $ps->bindParam(1,$user['cod'],PDO::PARAM_INT);
        $ps->bindParam(2,$user['pass'],PDO::PARAM_INT);
        $ps->bindParam(3,$user['phone'],PDO::PARAM_INT);
        $ps->bindParam(4,2);
        $ps->execute();
        $this->disconnect();
    }
    public function update_user($user){
        $con = $this->connect();
        $ps = $con->prepare("UPDATE tbl_user SET user_cod=?, user_phone=? WHERE id=?");
        $ps->bindParam(1,$user["cod"],PDO::PARAM_INT);
        $ps->bindParam(2,$user["phone"],PDO::PARAM_INT);
        $ps->bindParam(3,$user["id"],PDO::PARAM_INT);
        $ps->execute();
        $this->disconnect();
    }
    public function validarCodigo($user){
        $con = $this->connect();
        $ps = $con->prepare("SELECT user_cod FROM tbl_user WHERE user_cod = ?");
        $ps->bindParam(1,$user,PDO::PARAM_INT);
        $ps->execute();
        $response = $ps->fetch(PDO::FETCH_ASSOC);
        if($response){
            return true;
        }else{
            return false;
        }
    }
    public function validarPass($user){
        $con = $this->connect();
        $ps = $con->prepare("SELECT user_pass FROM tbl_user WHERE user_cod = ?");
        $ps->bindParam(1,$user[0],PDO::PARAM_INT);
        $ps->execute();
        $response = $ps->fetch(PDO::FETCH_ASSOC);
        if($user[1]==$response['user_pass']){
            return true;
        }else{
            return false;
        }
    }
    public function session_user($user){
        $con = $this->connect();
        $ps = $con->prepare("SELECT id,user,user_phone,type_user FROM tbl_user WHERE user_cod = ?");
        $ps->bindParam(1,$user,PDO::PARAM_INT);
        $ps->execute();
        $data = $ps->fetch(PDO::FETCH_ASSOC);
        if($data != 0 or $data != ""){
            $obj = new user();
            $obj->setId($data["id"]);
            $obj->setUsercod($data["user"]);
            $obj->setUserphone($data["user_phone"]);
            $obj->setTypeuser($data["type_user"]);
            return $obj;
        }else{
            return null;
        }
    }
}
?>