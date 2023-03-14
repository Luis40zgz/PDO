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
    if(count($this->productos)>0) {
        $salida = "<table><tr><th>PRODUCTO</th><th>PRECIO</th><th></th></tr>";
        foreach ($this->productos as $producto) {
            $salida .= "<tr><td>{$producto[1]}</td><td>{$producto[2]}</td><td><a href='./producto.php?cod={$producto[0]}'>Editar</a></td></tr>";
        }
        $salida .= "</table>";
    }else{
        $salida = "No hay productos para mostrar";
    }
    return $salida;

}
}