<?php
class MotoNacional extends Moto{
    private $porcentajeDescuento;

    public function __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentajeIncremento,$activa,$porcentajeDescuento = 15)
    {
        parent::__construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentajeIncremento,$activa);
        $this->porcentajeDescuento = $porcentajeDescuento;
    }
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }
    public function setPorcentajeDescuento($newPorcentajeDescuento){
        $this->porcentajeDescuento = $newPorcentajeDescuento;
    }
    public function __toString()
    {
        $cad = parent::__toString()."\nPorcentaje de descuento: %".$this->getPorcentajeDescuento();
        return $cad;
    }

    public function darPrecioVenta(){
        $precioVenta = -1;
        if($this->getActiva()){
            $costoMoto = $this->getCosto();
            $anio = 2024 - $this->getAnioFabricacion();
            $porcentajeIncremento = $this->getPorcentajeIncremento() - $this->getPorcentajeDescuento();
            $porcentajeIncremento /= 100;
            $porcentajeIncremento *= $anio;
            $precioVenta = $costoMoto + $costoMoto * $porcentajeIncremento;
        }
        return $precioVenta;
    }
}
?>