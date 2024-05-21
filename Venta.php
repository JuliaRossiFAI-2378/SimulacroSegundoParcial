<?php
class Venta{
    private $numero;
    private $fecha;
    private $objCliente;
    private $colMotos;
    private $precioFinal;

    public function __construct($numero,$fecha,$objCliente,$colMotos,$precioFinal){
        $this->numero = $numero;
        $this->fecha = $fecha;
        $this->objCliente = $objCliente;
        $this->colMotos = $colMotos;
        $this->precioFinal = $precioFinal;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function setNumero($newNumero){
        $this->numero = $newNumero;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($newFecha){
        $this->fecha = $newFecha;
    }
    public function getObjCliente(){
        return $this->objCliente;
    }
    public function setObjCliente($newObjCliente){
        $this->objCliente = $newObjCliente;
    }
    public function getColMotos(){
        return $this->colMotos;
    }
    public function setColMotos($newColMotos){
        $this->colMotos = $newColMotos;
    }
    public function getPrecioFinal(){
        return $this->precioFinal;
    }
    public function setPrecioFinal($newPrecioFinal){
        $this->precioFinal = $newPrecioFinal;
    }
    public function __toString(){
        $cad = "\nNumero: ".$this->getNumero()."\nFecha: ".$this->getFecha().
        "\n\tCliente de venta".$this->getObjCliente()."\n\tMotos vendidas";
        $colMotos = $this->getColMotos();
        $i  = 1;
        foreach($colMotos as $moto){
            $cad .= "\n\tMoto ".$i.$moto."\n";
            $i++;
        }
        $cad .= "\nPrecio final: ".$this->getPrecioFinal();
        return $cad;
    }
/**Implementar el método incorporarMoto($objMoto) que recibe por parámetro un objeto moto y lo
incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta. El método cada
vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta.
Utilizar el método que calcula el precio de venta de la moto donde crea necesario */
    public function incorporarMoto($objMoto){
        if(!$this->getObjCliente()->getDadoBaja()){
            if($objMoto->darPrecioVenta() >= 0){
                $colMotos = $this->getColMotos();
                $precioVenta = $objMoto->darPrecioVenta();
                $precioTotal = $this->getPrecioFinal();
                $precioTotal += $precioVenta;
                $this->setPrecioFinal($precioTotal);
                $colMotos[] = $objMoto;
                $this->setColMotos($colMotos);
            }
        }
    }
    /**retorna  la sumatoria del precio venta de cada una de las motos Nacionales vinculadas a la venta.*/
    public function retornarTotalVentaNacional(){
        $colMotos = $this->getColMotos();
        $precioNacionales = 0;
        foreach($colMotos as $moto){
            if($moto instanceof MotoNacional){
                $precioNacionales += $moto->getCosto();
            }
        }
        return $precioNacionales;
    }
    /**retorna una colección de motos importadas vinculadas a la venta. Si la venta solo se corresponde con 
     * motos Nacionales la colección retornada debe ser vacía.*/
    public function retornarMotosImportadas(){
        $colImportadas = [];
        $colMotos = $this->getColMotos();
        foreach($colMotos as $moto){
            if($moto instanceof MotoImportada){
                $colImportadas[] = $moto;
            }
        }
        return $colImportadas;
    }
}
?>