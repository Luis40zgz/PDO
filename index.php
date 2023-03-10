<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if(isset($_SESSION['logged'])){
    header('location:principal.php');
    die;
}
if(isset($_POST['submit'])) {
    include "conection.php";
    $carga = fn($clase)=>require "$clase.php";
    spl_autoload_register($carga);
    $conection = new dbcon();
    $usuario = htmlspecialchars($_POST['user']);
    $password = htmlspecialchars($_POST['pass']);
    if($conection->validar_usuario($usuario, $password)){
        $_SESSION = ['logged'=>true, 'usuario'=>$usuario];
        header('location:principal.php');
        die;
    }else{
        $alert = "<h2>Los datos no son correctos</h2>";
    }
}
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
<main>
    <h1>Bienvenido</h1>
    <?= $alert ?? "";?>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <label for="user" value="<?=$usuario ?? "";?>">Usuario</label>
        <input type="text" name="user" id="user">
        <label for="pass">Password</label>
        <input type="text" name="pass" id="pass">
        <button type="submit" name="submit" value="1">Log in</button>
    </form>
</main>
</body>
</html>
