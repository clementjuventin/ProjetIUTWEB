<?php

//chargement bibliothèque
require_once(__DIR__.'/Validation.php');
require_once(__DIR__.'/Connexion.php');
require_once(__DIR__.'/../gateway/GatewayTask.php');
require_once(__DIR__.'/../gateway/GatewayUser.php');
require_once(__DIR__.'/../metier/Task.php');
require_once(__DIR__.'/../metier/User.php');

//chargement config
include_once(__DIR__.'/../config/Config.php');

$dataVueErreur = array ();

try{
	$connexion = new Connexion($base,$login,$mdp);

	$user = new User();
	$user->setLogin('clem');

	$action=$_REQUEST['action'];

	switch($action) {
	case NULL:
		Reinit();
		break;
	case "signIn":
		SignIn($_POST['login'],$_POST['password']);
		break;
	case "addTask":
	    InitAddTask();
	    break;
	case "addTaskSubmit":
        PushTask($user);
        break;
	default:
		echo "--";
	}
} catch (PDOException $e)
{
	$dataVueErreur["PDOException"] = $e->getMessage();
	require (__DIR__.'/../vues/erreur.php');
} catch (Exception $e2)
{
	$dataVueErreur["Exception"] =	$e2->getMessage();
	require (__DIR__.'/../vues/erreur.php');
}
exit(0);

function Reinit()  {
	require (__DIR__.'/../vues/head.php');
	require (__DIR__.'/../vues/login.php');
	require (__DIR__.'/../vues/footer.php');
}
function InitAddTask() {
    require (__DIR__.'/../vues/head.php');
    require (__DIR__.'/../vues/header.php');
    require (__DIR__.'/../vues/addTask.php');
    require (__DIR__.'/../vues/footer.php');
}
function SignIn($login,$password) {
	global $user;
	global $connexion;
    global $dataVueErreur;
    
    $gtw = new GatewayUser($connexion);

    //Validation::val_SignIn($login,$password,$dataVueErreur);
	$bool = $gtw->signIn($login,$password,$dataVueErreur);
	if($bool){
        $user->setLogin($login);
		displayInterface($user);
	}else{
		Reinit();
	}
}
function PushTask() {
	global $user;
    global $connexion;
    global $dataVueErreur;

	$gtw = new GatewayTask($connexion);


    $task = new Task($_POST['title'],$_POST['comment'],$user,date('Y-m-d h:i',mktime($_POST['hour'], $_POST['min'], 0, $_POST['month'], $_POST['day'], $_POST['year'])),$_POST['color'],0);
    Validation::val_Task($task,$dataVueErreur);
    $gtw->pushTask($task);

    $_request['action']=NULL;
    header('Location: controleur/Controleur.php');
}
function displayInterface($user){
	global $user;
    global $connexion;
    global $dataVueErreur;

    $gtw = new GatewayTask($connexion);

	$task = $gtw->buildDailyTaskForUser($user->getLogin(), date("Y-m-d"));

	require (__DIR__.'/../vues/head.php');
	require (__DIR__.'/../vues/header.php');
	require (__DIR__.'/../vues/toDoList.php');
	require (__DIR__.'/../vues/footer.php');
}

