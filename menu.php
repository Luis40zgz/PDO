<?php

class menu
{

    private $familias;
    private $familia_seleccionada;
public function __construct($dbcon,$famila_seleccionada)
{
    $this->familias = $dbcon->muestra_familias();
    $this->familia_seleccionada = $famila_seleccionada;
}
public function __toString(): string
{
    $salida = "<form method=\"post\" action=\"{$_SERVER['PHP_SELF']}\"><select name=\"familia\" id=\"familia\">";
    foreach ($this->familias as $familia){
         if($this->familia_seleccionada!=$familia) {
             $salida .= "<option value=\"$familia\">$familia</option>";
         }else{
             $salida .= "<option value=\"$familia\" selected>$familia</option>";
         }
    }
    $salida .= "</select><button type='submit' name='submit' value='mostrar'>Mostrar</button></form>";
    return $salida;
}
}