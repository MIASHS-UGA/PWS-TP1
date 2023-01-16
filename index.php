<?php
require 'app/bootstrap.php'; //Contient les informations de configuration de l'application

require_once 'app/Controllers/Home.php';
$controller = new Home();
$controller->index();
?>