<?php

require '../model/model.php';

$activitats = getActivitats();
$nomGrups = getNomGrups();
$nomGrups = array_chunk($nomGrups, 2);
require '../View/alumne.activitats.vista.php';



?>