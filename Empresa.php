<?php
/**denominación, dirección, la colección de clientes, colección de
motos y la colección de ventas realizadas. */
class Empresa{
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colMotos;
    private $colVentas;

    public function __construct($denominacion,$direccion,$colClientes,$colMotos,$colVentas){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colClientes = $colClientes;
        $this->colMotos = $colMotos;
        $this->colVentas = $colVentas;
    }
    public function getDenominacion(){
        return $this->denominacion;
    }
    public function setDenominacion($newDenominacion){
        $this->denominacion = $newDenominacion;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($newDireccion){
        $this->direccion = $newDireccion;
    }
    public function getColClientes(){
        return $this->colClientes;
    }
    public function setColClientes($newColClientes){
        $this->colClientes = $newColClientes;
    }
    public function getColMotos(){
        return $this->colMotos;
    }
    public function setColMotos($newColMotos){
        $this->colMotos = $newColMotos;
    }
    public function getColVentas(){
        return $this->colVentas;
    }
    public function setColVentas($newColVentas){
        $this->colVentas = $newColVentas;
    }
    public function __toString(){
        $cad = "\nDenominacion: ".$this->getDenominacion()."\nDireccion: ".$this->getDireccion().
        "\n\tClientes";
        $colClientes = $this->getColClientes();
        $i = 1;
        foreach($colClientes as $cliente){
            $cad .= "\n\tCliente ".$i.$cliente."\n";
            $i++;
        }
        $cad .= "\n\tMotos";
        $colMotos = $this->getColMotos();
        $i = 1;
        foreach($colMotos as $moto){
            $cad .= "\n\tMoto ".$i.$moto."\n";
            $i++;
        }
        $cad .= "\n\tVentas";
        $colVentas = $this->getColVentas();
        $i = 1;
        foreach($colVentas as $venta){
            $cad .= "\n\tVenta ".$i.$venta."\n";
            $i++;
        }
        return $cad;
    }
    /**recorre la colección de motos de la Empresa y
retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro */
    public function retornarMoto($codigoMoto){
        $colMotos = $this->getColMotos();
        $encontro = false;
        $i = 0;
        while($i<count($colMotos) && !$encontro){
            $codMoto = $colMotos[$i]->getCodigo();
            if($codigoMoto == $codMoto){
                $encontro = true;
                $objMoto = $colMotos[$i];
            }
            $i++;
        }
        if(!$encontro){
            $objMoto = new Moto(null,null,null,null,null,false);
        }
        return $objMoto;
    }

    /**recibe por parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento 
     * de la colección se busca el objeto moto correspondiente al código y se incorpora a la colección 
     * de motos de la instancia Venta que debe ser creada. Recordar que no todos los clientes ni todas 
     * las motos, están disponibles para registrar una venta en un momento determinado.
     * El método debe setear los variables instancias de venta que corresponda y retornar el importe 
     * final de la venta */
    public function registrarVenta($colCodigosMoto, $objCliente){
        $importeFinal = 0;
        $i = 0;
        $colVentas = $this->getColVentas();
        if(count($colVentas) != null){
            $cantVentas = count($colVentas);
        }else{
            $cantVentas = 0;
        }
        $venta = new Venta($cantVentas+1,"19/05/2024",$objCliente,[],0);
        foreach($colCodigosMoto as $codigo){
            $motoVenta = $this->retornarMoto($codigo);
            $venta->incorporarMoto($motoVenta);
            if($motoVenta->darPrecioVenta() >= 0){
                $importeFinal += $motoVenta->darPrecioVenta();
            }
        }
        if($venta->getPrecioFinal()>0){
            $colVentas[] = $venta;
            $this->setColVentas($colVentas);
        }
        return $importeFinal;
    }
    /**recibe por parámetro el tipo y número de documento de un Cliente y retorna una 
     * colección con las ventas realizadas al cliente */
    public function retornarVentasXCliente($tipoDoc, $numDoc){
        $colClientes = $this->getColClientes();
        $colVentas = $this->getColVentas();
        $i = 0;
        $encontro = false;
        $colVentasCliente = [];
        while($i < count($colClientes) && !$encontro){
            $tipo = $colClientes[$i]->getTipoDni();
            $numero = $colClientes[$i]->getNumDni();
            if($tipo == $tipoDoc && $numero == $numDoc){
                $cliente = $colClientes[$i];
                $encontro = true;
            }
            $i++;
        }
        if($encontro){
            foreach($colVentas as $venta){
                $clienteVenta = $venta->getObjCliente();
                if($clienteVenta == $cliente){
                    $colVentasCliente[] = $venta;
                }
            }
        }
        return $colVentasCliente;
    }
    /**recorre la colección de ventas realizadas por la empresa y retorna el importe total de ventas 
     * DE MOTOS Nacionales realizadas por la empresa. */
    public function informarSumaVentasNacionales(){
        $colVentas = $this->getColVentas();
        $importeNacionales = 0;
        foreach($colVentas as $venta){
            $importeNacionales += $venta->retornarTotalVentaNacional();
        }
        return $importeNacionales;
    }
    /**recorre la colección de ventas realizadas por la empresa y retorna una colección de ventas de motos 
     * importadas. Si en la venta al menos una de las motos es importada la venta debe ser informada.*/
    public function informarVentasImportadas(){
        $colVentas = $this->getColVentas();
        $colVentasImportadas = [];
        foreach($colVentas as $venta){
            if($venta->retornarMotosImportadas() != null){
                $colVentasImportadas[] = $venta;
            }
        }
        return $colVentasImportadas;
    }
}
?>