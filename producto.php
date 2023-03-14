<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['logged'])){
    header('location:index.php');
    die;
}

include "conection.php";
$carga = fn($clase)=>require "$clase.php";
spl_autoload_register($carga);
$conection = new dbcon();
if(isset($_POST['submit'])){
    $parametros = [$_POST['nombre'],$_POST['descripcion'],$_POST['PVP'],$_POST['familia'],$_POST['codigo']];
    $conection->actualizar_producto($parametros);
}
$codigo_producto = htmlspecialchars($_GET['cod'] ?? $_POST['codigo']);
$producto = $conection->getProduct($codigo_producto);
$codigo =htmlspecialchars($producto[0]);
$nombre=htmlspecialchars($producto[1]);
$desc=htmlspecialchars($producto[2]);
$precio=htmlspecialchars($producto[3]);
$familia=htmlspecialchars($producto[4]);
$nombre_familia = $conection->getnombre_familia($familia);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
    <label for="codigo">Código</label>
    <input type="text" name="nombre" id="nombre" value="<?=$nombre;?>">
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion" value="<?=$desc;?>">
    <label for="PVP">Precio</label>
    <input type="text" name="PVP" id="PVP" value="<?=$precio;?>">
    <label for="familia">Familia</label>
    <input type="text" name="familia" id="familia" value="<?=$familia;?>">
    <input type="text" name="codigo" id="codigo" value="<?=$codigo;?>">
    <label for="nombre">Nombre</label>
    <button type="submit" name="submit" value="update">Actualizar</button>
</form>
<form action="principal.php" method="post">
    <input type="text" name="familia" value="<?=$nombre_familia;?>" hidden>
 <button type="submit" name="submit" value="submit">Volver</button>
</form>
<form action="<?=$_SERVER['PHP_SELF'];?> method="post"">
    <button type="submit" name="logout" value="logout">LOG OUT</button>
</form>
</body>
</html>
