<?php
class productos{
    private $idprod;
    private $cant;
    private $prod;
    public function getIdprod()
    {
        return $this->idprod;
    }
    public function setIdprod($idprod)
    {
        $this->idprod = $idprod;
        return $this;
    }
    public function getCant()
    {
        return $this->cant;
    }
    public function setCant($cant)
    {
        $this->cant = $cant;
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
}
?>