<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['logged'])){
    header('location:index.php');
    die();
}
include "conection.php";
$carga = fn($clase)=>require "$clase.php";
spl_autoload_register($carga);
$conection = new dbcon();

$familia = $_POST['familia']??"";
if (isset($_POST['submit']))
        $lista = new lista($conection,$familia);


$menu = new menu($conection,$familia );
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
    <?= $menu;?>
    <?= $lista ?? "";?>
</form>
    <form action=""></form>
<button type="submit" name="logout" value="logout">LOG OUT</button>
</body>
</html>
