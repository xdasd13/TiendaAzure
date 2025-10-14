<?php
// Manejador de rutas para el controlador
require_once __DIR__ . '/TiendaController.php';

$controller = new TiendaController();
$controller->manejarSolicitud();
?>
