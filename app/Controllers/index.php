<?php
// Manejador de rutas para el controlador
require_once 'TiendaController.php';

$controller = new TiendaController();
$controller->manejarSolicitud();
?>
