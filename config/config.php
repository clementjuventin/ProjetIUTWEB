<?php

// liste des modules à inclure
$dConfig['includes']=array(__DIR__.'Validation.php');

//BD
$base="mysql:host=localhost;dbname=todolistproject";
$login="root";
$mdp="";

//Vues
$vues['erreur']=array('url'=> __DIR__ . '\..\view/erreur.php');
$vues['head']=array('url'=>__DIR__.'\..\view/sample/head.php');
$vues['header']=array('url'=>__DIR__.'\..\view/sample/header.php');
$vues['footer']=array('url'=>__DIR__.'\..\view/sample/footer.php');

$vues['login']=array('url'=>__DIR__.'\..\view/login.php');
$vues['signUp']=array('url'=>__DIR__.'\..\view/signUp.php');
$vues['toDoList']=array('url'=>__DIR__.'\..\view/toDoList.php');
$vues['addTask']=array('url'=>__DIR__.'\..\view/addTask.php');
$vues['addList']=array('url'=>__DIR__.'\..\view/addList.php');

//Controllers
$cont['UserCont']=array('url'=> __DIR__ . '\..\controleur\UserControler.php');
$cont['frontCont']=array('url'=>__DIR__.'\..\controleur\FrontControler.php');
$cont['PublicCont']=array('url'=>__DIR__.'\..\controleur\PublicControler.php');

