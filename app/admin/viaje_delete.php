<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Usuario.php';
require_once '../clases/Viaje.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);


if (!$usuario->esAdmin()) {
    header('Location: login.php');
    exit;
}


$id = $_GET['id'];

if ($id) {
    $viaje = new Viaje($db);
    $viaje->id = $id;
    
    if ($viaje->eliminar()) {
        header('Location: crud.php');
        exit;
    } else {
        die('Error al eliminar el viaje');
    }
} else {
    header('Location: crud.php');
    exit;
}
?>
