<?php
class Cliente{
    private $nombre;
    private $apellido;
    private $dadoBaja;
    private $tipoDni;
    private $numDni;

    public function __construct($nombre,$apellido,$dadoBaja,$tipoDni,$numDni){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dadoBaja = $dadoBaja;
        $this->tipoDni = $tipoDni;
        $this->numDni = $numDni;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($newApellido){
        $this->apellido = $newApellido;
    }
    public function getNumDni(){
        return $this->numDni;
    }
    public function setNumDni($newNumDni){
        $this->numDni = $newNumDni;
    }
    public function getDadoBaja(){
        return $this->dadoBaja;
    }
    public function setDadoBaja($newDadoBaja){
        $this->dadoBaja = $newDadoBaja;
    }
    public function getTipoDni(){
        return $this->tipoDni;
    }
    public function setTipoDni($newTipoDni){
        $this->tipoDni = $newTipoDni;
    }
    public function __toString(){
        $cad = "\nNombre: ".$this->getNombre()."\nApellido: ".$this->getApellido().
        "\nTipo y numero de dni: ".$this->getTipoDni()." ".$this->getNumDni()."\nEsta dado de baja: ";
        if($this->getDadoBaja()){
            $cad .= "Si.";
        }else{
            $cad .= "No.";
        }
        return $cad;
    }
}
?>