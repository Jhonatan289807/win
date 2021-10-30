<?php
class Entregados{
    private $id;
    private $prod;
    private $modelo;
    private $serie01;
    private $serie02;
    private $fechaentrega;
    private $cantidad;
    private $fechaliquido;
    private $estado;
    private $idestado;


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getProd()
    {
        return $this->prod;
    }
    public function setProd($prod)
    {
        $this->prod = $prod;
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
    public function getFechaentrega()
    {
        return $this->fechaentrega;
    }
    public function setFechaentrega($fechaentrega)
    {
        $this->fechaentrega = $fechaentrega;
        return $this;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
        return $this;
    }
    public function getFechaliquido()
    {
        return $this->fechaliquido;
    }
    public function setFechaliquido($fechaliquido)
    {
        $this->fechaliquido = $fechaliquido;
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
    public function getIdestado()
    {
        return $this->idestado;
    }
    public function setIdestado($idestado)
    {
        $this->idestado = $idestado;
        return $this;
    }
}
?>