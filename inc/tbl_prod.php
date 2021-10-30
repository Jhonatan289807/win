<?php
include_once 'functions.php';
class TablaProducto{
    public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function NuevaCantProd($obj){
        try {
            $con = $this->connect();
            foreach($obj as $prod){
                $ps = $con->prepare("SELECT cant FROM tbl_prod WHERE id = ?");
                $ps->bindValue(1,$prod['tipo'],PDO::PARAM_INT);
                $ps->execute();
                $data = $ps->fetch(PDO::FETCH_ASSOC);
                $this->disconnect();
                if($data['cant'] >= 0){
                    $cant= $data['cant']+$prod['cant'];
                    $this->updateCantProd($cant,$prod['tipo']);
                }
            }
        } catch (Exception $e) {
            return $e;
        }
        
    }
    public function updateCantProd($cant , $id){
        try {
            $con = $this->connect();
            $ps = $con->prepare("UPDATE tbl_prod SET cant = ? WHERE id = ?");
            $ps->bindParam(1,$cant, PDO::PARAM_INT);
            $ps->bindParam(2,$id,PDO::PARAM_INT);
            $ps->execute();
            $this->disconnect();
        } catch (Exception $e) {
            return $e;
        }
    }
    public function mostrarProd(){
        try {
            $con = $this->connect();
            $ps = $con->prepare("SELECT * FROM tbl_prod");
            $ps->execute();
            $array = array();
            while($data = $ps->fetch(PDO::FETCH_ASSOC)){
                $obj = new productos();
                $obj->setIdprod($data['id']);
                $obj->setProd($data['prod']);
                $obj->setCant($data['cant']);
                array_push($array,$obj);
            }
            $this->disconnect();
            return $array;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function agregarOtros($prod){
        try {
            $con = $this->connect();
            $ps = $con->prepare("INSERT INTO tbl_prod (prod,cant) VALUES (?,?)");
            $ps->bindParam(1,$prod[0]);
            $ps->bindParam(2,$prod[1],PDO::PARAM_INT);
            $ps->execute();
            $this->disconnect();
        } catch (Exception $e) {
            return $e;
        }
    }
    public function mostrarCantidad($tipo){
        $con = $this->connect();
		$ps = $con->prepare("SELECT cant FROM tbl_prod WHERE id = ?");
        $ps->bindParam(1,$tipo,PDO::PARAM_INT);
        $ps->execute();
        $data = $ps->fetch(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $data['cant'];
	}
    public function actualizarProd($prod){
        try {
            $con = $this->connect();
            $ps = $con->prepare("UPDATE tbl_prod SET prod = ? , cant = ? WHERE id= ?");
            $ps->bindValue(1,$prod['prod']);
            $ps->bindValue(2,intVal($prod['cant']),PDO::PARAM_INT);
            $ps->bindValue(3,intVal($prod['id']),PDO::PARAM_INT);
            $ps->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>