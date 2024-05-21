<?php
class Moto{
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcentajeIncremento;
    private $activa;

    public function __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentajeIncremento,$activa){
        $this->codigo = $codigo;
        $this->costo = $costo;
        $this->anioFabricacion = $anioFabricacion;
        $this->descripcion = $descripcion;
        $this->porcentajeIncremento = $porcentajeIncremento;
        $this->activa = $activa;
    }
    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($newCodigo){
        $this->codigo = $newCodigo;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function setCosto($newCosto){
        $this->costo = $newCosto;
    }
    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }
    public function setAnioFabricacion($newAnioFabricacion){
        $this->anioFabricacion = $newAnioFabricacion;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($newDescripcion){
        $this->descripcion = $newDescripcion;
    }
    public function getPorcentajeIncremento(){
        return $this->porcentajeIncremento;
    }
    public function setPorcentajeIncremento($newPorcentajeIncremento){
        $this->porcentajeIncremento = $newPorcentajeIncremento;
    }
    public function getActiva(){
        return $this->activa;
    }
    public function setActiva($newActiva){
        $this->activa = $newActiva;
    }
    public function __toString(){
        $cad = "\nCodigo: ".$this->getCodigo()."\nCosto: ".$this->getCosto()."\nAnio de fabricacion: ".
        $this->getAnioFabricacion()."\nDescripcion: ".$this->getDescripcion()."\nPorcentaje de incremento anual: ".
        $this->getPorcentajeIncremento()."\nEsta activa: ";
        if($this->getActiva()){
            $cad .= "Si.";
        }else{
            $cad .= "No.";
        }
        return $cad;
    }

    public function darPrecioVenta(){
        $precioVenta = -1;
        if($this->getActiva()){
            $costoMoto = $this->getCosto();
            $anio = 2024 - $this->getAnioFabricacion();
            $porcentajeIncremento = $this->getPorcentajeIncremento() / 100;
            $porcentajeIncremento *= $anio;
            $precioVenta = $costoMoto + $costoMoto * $porcentajeIncremento;
        }
        return $precioVenta;
    }
}
?>