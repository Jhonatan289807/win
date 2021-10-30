<?php
include_once 'functions.php';
class TablaOntMesh{
	public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function MostrarMeshDisp(){
    	$con  = $this->connect();
    	$ps = $con->prepare("SELECT * FROM tbl_ont_mesh WHERE tipo_prod_fk = 2 AND id_estado_fk = 3");
    	$ps->execute();
    	$array = array();
    	while($data = $ps->fetch(PDO::FETCH_ASSOC)){
    		$obj = new OntMesh();
    		$obj->setId($data['id']);
    		$obj->setTipo($data['tipo_prod_fk']);
    		$obj->setSerie01($data['serie01']);
    		$obj->setSerie02($data['serie02']);
    		$obj->setModelo($data['modelo']);
    		array_push($array,$obj);
    	}
		$this->disconnect();
		return $array;
    }
    public function MostrarOntDisp(){
    	$con  = $this->connect();
    	$ps = $con->prepare("SELECT * FROM tbl_ont_mesh WHERE tipo_prod_fk = 1 AND id_estado_fk = 3");
    	$ps->execute();
    	$array = array();
    	while($data = $ps->fetch(PDO::FETCH_ASSOC)){
    		$obj = new OntMesh();
    		$obj->setId($data['id']);
    		$obj->setTipo($data['tipo_prod_fk']);
    		$obj->setSerie01($data['serie01']);
    		$obj->setSerie02($data['serie02']);
    		$obj->setModelo($data['modelo']);
    		array_push($array,$obj);
    	}
		$this->disconnect();
		return $array;
    }
	public function agregarONTMESH($data){
		try {
			$con = $this->connect();
			$ps = $con->prepare("INSERT INTO tbl_ont_mesh (tipo_prod_fk,serie01,serie02,modelo,id_estado_fk)VALUES(?,?,?,?,?)");
			$ps->bindValue(1,$data[0],PDO::PARAM_INT);
			$ps->bindValue(2,$data[1]);
			$ps->bindValue(3,$data[2]);
			$ps->bindValue(4,$data[3]);
			$ps->bindValue(5,3,PDO::PARAM_INT);
			$ps->execute();
			$this->disconnect();
		} catch (Exception $e) {
			echo ($e);
		}
	}
	public function mostrarOntMesh($tipo){
		try {
			$con  = $this->connect();
			$ps = $con->prepare("SELECT om.id,pr.prod, om.serie01, om.serie02, om.modelo, om.id_estado_fk, est.tipo_estado FROM tbl_ont_mesh om INNER JOIN tbl_estado est ON om.id_estado_fk = est.id INNER JOIN tbl_prod pr ON om.tipo_prod_fk = pr.id WHERE pr.id = ?");
			$ps->bindValue(1,$tipo,PDO::PARAM_INT);
			$ps->execute();
			$array = array();
			while($data = $ps->fetch(PDO::FETCH_ASSOC)){
				$obj = new OntMesh();
				$obj->setId($data['id']);
				$obj->setTipo($data['prod']);
				$obj->setSerie01($data['serie01']);
				$obj->setSerie02($data['serie02']);
				$obj->setModelo($data['modelo']);
				$obj->setIdestado($data['id_estado_fk']);
				$obj->setEstado($data['tipo_estado']);
				array_push($array,$obj);
			}
			$this->disconnect();
			return $array;
		} catch (Exception $e) {
			var_dump($e);
		}
	}
	public function actualizar($data){
		try {
			$con = $this->connect();
			$ps = $con->prepare("UPDATE tbl_ont_mesh SET serie01 = ? , serie02 = ? , modelo = ? WHERE id = ?");
			$ps->bindValue(1,$data['s01']);
			$ps->bindValue(2,$data['s02']);
			$ps->bindValue(3,$data['mod']);
			$ps->bindValue(4,intVal($data['id']));
			$ps->execute();
			$this->disconnect();
		} catch (Exception $e) {
			var_dump($e);
		}
	}
	public function actualizarEstado($data){
		try {
			$con = $this->connect();
			foreach($data as $ontmesh){
				$ps = $con->prepare("UPDATE tbl_ont_mesh SET id_estado_fk = ? WHERE id = ?");
				$ps->bindValue(1,4,PDO::PARAM_INT);
				$ps->bindValue(2,$ontmesh['id'],PDO::PARAM_INT);
				$ps->execute();
			}
			$this->disconnect();
		} catch (Exception $e) {
			var_dump($e);
		}
	}
}
?>