<?php
class Pedidos{
    private $idped;
    private $iduser;
    private $user;
    private $fecha;
    private $hora;
    private $idestado;
    private $estado;

    public function getIdped()
    {
        return $this->idped;
    }
    public function setIdped($idped)
    {
        $this->idped = $idped;
        return $this;
    }
    public function getIduser()
    {
        return $this->iduser;
    }
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
        return $this;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }
    public function getHora()
    {
        return $this->hora;
    }
    public function setHora($hora)
    {
        $this->hora = $hora;
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