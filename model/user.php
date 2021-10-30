<?php
class user{
    private $id;
    private $user;
    private $user_cod;
    private $user_pass;
    private $user_phone;
    private $type_user;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function getUsercod(){
        return $this->user_cod; 
    }
    public function setUsercod($user_cod){
        $this->user_cod = $user_cod;
    }
    public function getUserpass(){
        return $this->user_pass;
    }
    public function setUserpass($user_pass){
        $this->user_pass= $user_pass;
    }
    public function getUserphone(){
        return $this->user_phone;
    }
    public function setUserphone($user_phone){
        $this->user_phone = $user_phone;
    }
    public function getTypeuser(){
        return $this->type_user;
    }
    public function setTypeuser($type_user){
        $this->type_user = $type_user;
    }
}
?>