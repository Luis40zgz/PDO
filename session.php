<?php
session_start();
if(!isset($_SESSION['logged']) && $_SERVER['PHP_SELF'] != "index.php"){
    header('location:index.php');
    die();
}
