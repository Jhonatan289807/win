<?php
class PedDetalle{
	private $iddet;
	private $idped;
	private $tipoprod;
	private $prod;
	private $cantidad;

	public function getIddet()
	{
	    return $this->iddet;
	}
	public function setIddet($iddet)
	{
	    $this->iddet = $iddet;
	    return $this;
	}
	public function getIdped()
	{
	    return $this->idped;
	}
	public function setIdped($idped)
	{
	    $this->idped = $idped;
	    return $this;
	}
	public function getTipoprod()
	{
	    return $this->tipoprod;
	}
	public function setTipoprod($tipoprod)
	{
	    $this->tipoprod = $tipoprod;
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
	public function getCantidad()
	{
	    return $this->cantidad;
	}
	public function setCantidad($cantidad)
	{
	    $this->cantidad = $cantidad;
	    return $this;
	}
}
?>