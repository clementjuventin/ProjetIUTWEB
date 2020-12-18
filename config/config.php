<?php

// liste des modules à inclure
$dConfig['includes']=array(__DIR__.'Validation.php');

//BD
$base="mysql:host=localhost;dbname=todolistproject";
$login="root";
$mdp="";

//Vues
$vues['erreur']=array('url'=>__DIR__.'\..\view/sample/erreur.php');
$vues['head']=array('url'=>__DIR__.'\..\view/sample/head.php');
$vues['header']=array('url'=>__DIR__.'\..\view/sample/header.php');
$vues['footer']=array('url'=>__DIR__.'\..\view/sample/footer.php');

$vues['login']=array('url'=>__DIR__.'\..\view/login.php');
$vues['signUp']=array('url'=>__DIR__.'\..\view/signUp.php');
$vues['toDoList']=array('url'=>__DIR__.'\..\view/toDoList.php');
$vues['addTask']=array('url'=>__DIR__.'\..\view/addTask.php');

//Controllers
$cont['contPanel']=array('url'=> __DIR__ . '\..\controleur\PanelControler.php');
$cont['contUser']=array('url'=>__DIR__.'\..\controleur\SessionControler.php');
$cont['frontCont']=array('url'=>__DIR__.'\..\controleur\FrontControler.php');

//Classes
require_once(__DIR__ . '\Validation.php');

require_once(__DIR__ . '\..\dataBase\Connexion.php');
require_once(__DIR__ . '\..\dataBase\gateway\GatewayTask.php');
require_once(__DIR__ . '\..\dataBase\gateway\GatewayUser.php');
require_once(__DIR__ . '\..\dataBase\gateway\GatewayList.php');

require_once(__DIR__ . '\..\model\metier\Task.php');
require_once(__DIR__ . '\..\model\metier\User.php');
require_once(__DIR__ . '\..\model\metier\Liste.php');

require_once(__DIR__ . '\..\model\TaskModel.php');
require_once(__DIR__ . '\..\model\UserModel.php');
require_once(__DIR__ . '\..\model\ViewModel.php');

