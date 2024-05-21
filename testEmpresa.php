<?php
include_once 'Cliente.php';
include_once 'Moto.php';
include_once 'Venta.php';
include_once 'Empresa.php';
include_once 'MotoNacional.php';
include_once 'MotoImportada.php';

$cliente1 = new Cliente("Honami","Mochizuki",false,"dni",123);
$cliente2 = new Cliente("Ichika","Hoshino",false,"dni",456);
$moto1 = new MotoNacional(11,2230000,2022,"Benelli Imperiale 400",85,true,10);
$moto2 = new MotoNacional(12,584000, 2021,"Zanella Zr 150 Ohc", 70, true,10);
$moto3 = new MotoNacional(13,999900,2023,"Zanella Patagonian Eagle 250",55,false);
$moto4 = new MotoImportada(14,12499900,2020,"Pitbike Enduro Motocross Apollo Aiii 190cc Plr",100,true,"Francia",6244400);
$colMoto = [$moto1,$moto2,$moto3,$moto4];
$colClientes = [$cliente1,$cliente2];


$empresa = new Empresa("Alta Gama","Av Argenetina 123", $colClientes,$colMoto,[]);
$empresa->registrarVenta([11,12,13,14], $cliente2);
$empresa->registrarVenta([13,14],$cliente2);
$empresa->registrarVenta([14,2],$cliente2);
$empresa->retornarVentasXCliente("dni",123);
$empresa->retornarVentasXCliente("dni",456);
$empresa->informarVentasImportadas();
$empresa->informarSumaVentasNacionales();
echo $empresa;
?>