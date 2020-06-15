<?php
namespace App\config;
use App\Entity\Error;
require 'Entity\Error.php';
$Error = new Error();
$Error->setFlash('Mon Message','success');
header('Location:index.php');