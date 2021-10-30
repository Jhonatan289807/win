<?php
class OntMesh{
	private $id;
	private $tipo;
	private $serie01;
	private $serie02;
	private $modelo;
	private $idestado;
	private $estado;

	public function getId()
	{
	    return $this->id;
	}
	public function setId($id)
	{
	    $this->id = $id;
	    return $this;
	}
	public function getTipo()
	{
	    return $this->tipo;
	}
	public function setTipo($tipo)
	{
	    $this->tipo = $tipo;
	    return $this;
	}
	public function getSerie01()
	{
	    return $this->serie01;
	}
	public function setSerie01($serie01)
	{
	    $this->serie01 = $serie01;
	    return $this;
	}
	public function getSerie02()
	{
	    return $this->serie02;
	}
	public function setSerie02($serie02)
	{
	    $this->serie02 = $serie02;
	    return $this;
	}
	public function getModelo()
	{
	    return $this->modelo;
	}
	public function setModelo($modelo)
	{
	    $this->modelo = $modelo;
	    return $this;
	}
	public function getIdestado()
	{
	    return $this->idestado;
	}
	public function setIdestado($idestado)
	{
	    $this->idestado = $idestado;
	    return $this;
	}
	public function getEstado()
	{
	    return $this->estado;
	}
	public function setEstado($estado)
	{
	    $this->estado = $estado;
	    return $this;
	}
}
?>