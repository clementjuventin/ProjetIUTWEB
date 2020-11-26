<?php
$page = $_GET['page'];
$error = array();

Validation::val_page(&$page,&$error);

$connexion = new Connexion($dtb,$login,$password);
$gtw = new Gateway($connexion);

$new = $gtw->GetNews($page*10,$page*10+10);
?>

