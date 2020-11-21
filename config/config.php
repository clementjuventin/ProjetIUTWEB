<?php

// liste des modules à inclure

$dConfig['includes']=array('Validation.php');

//BD

$base="mysql:host=localhost;dbname=todolistproject";
$login="root";
$mdp="";

//Vues
$vues['erreur']=array('url'=>'erreur.php');
$vues['login']=array('url'=>'login.php');
$vues['header']=array('url'=>'header.php');
$vues['footer']=array('url'=>'footer.php');

//Controllers
$cont['contuser']=array('url'=>'Controleur.php');
