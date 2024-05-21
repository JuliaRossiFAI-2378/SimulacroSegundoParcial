<?php
class MotoImportada extends Moto{
    private $pais;
    private $impuestos;

    public function __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentajeIncremento,$activa,$pais,$impuestos)
    {
        parent::__construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentajeIncremento,$activa);
        $this->pais = $pais;
        $this->impuestos = $impuestos;
    }
    public function getPais(){
        return $this->pais;
    }
    public function setPais($newPais){
        $this->pais = $newPais;
    }
    public function getImpuestos(){
        return $this->impuestos;
    }
    public function setImpuestos($newImpuestos){
        $this->impuestos = $newImpuestos;
    }
    public function __toString()
    {
        $cad = parent::__toString()."\nPais de origen: ".$this->getPais()."\nImpuestos de importacion: ".
        $this->getImpuestos();
        return  $cad;
    }

    public function darPrecioVenta(){
        $precioVenta = -1;
        if($this->getActiva()){
            $costoMoto = $this->getCosto();
            $anio = 2024 - $this->getAnioFabricacion();
            $porcentajeIncremento = $this->getPorcentajeIncremento() / 100;
            $porcentajeIncremento *= $anio;
            $precioVenta = $costoMoto + $costoMoto * $porcentajeIncremento;
            $precioVenta += $this->getImpuestos();
        }
        return $precioVenta;
    }
}
?>