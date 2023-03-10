<?php

class lista
{private $familia;
    private $cod;
private $productos;
public function __construct($dbcon,$familia){
    $this->familia = $familia;
    $this->cod = $dbcon->codigo_familia($this->familia);
    $this->productos = $dbcon->muestra_productos($this->cod);
}
public function __toString(){
    $salida = "<table><tr><th>PRODUCTO</th><th>PRECIO</th></tr>";
    foreach ($this->productos as $producto){
        $salida .= "<tr><td>{$producto[0]}</td><td>{$producto[1]}</td></tr>";
    }
    $salida .= "</table>";
    return $salida;

}
}