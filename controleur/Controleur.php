<?php

//chargement biblio
require_once(__DIR__.'/Validation.php');
require_once(__DIR__.'/Connexion.php');
require_once(__DIR__.'/Gateway.php');
require_once(__DIR__.'/../metier/Task.php');

//chargement config
include_once(__DIR__.'/../config/Config.php');

//debut

//on initialise un tableau d'erreur
$dataVueErreur = array ();

try{
	$connexion = new Connexion($base,$login,$mdp);
	$gtw = new Gateway($connexion);

	$action=$_REQUEST['action'];

	switch($action) {
	//pas d'action, on réinitialise 1er appel
	case NULL:
		Reinit();
		break;

	case "signIn":
		SignIn($_POST['login'],$_POST['password']);
		break;
	default:
		echo "pas d action";
	break;
	}
} catch (PDOException $e)
{
	//si erreur BD, pas le cas ici
	$dataVueErreur[] =	"Erreur inattendue!!! ";
	require (__DIR__.'/../vues/erreur.php');

}
catch (Exception $e2)
	{
	$dataVueErreur[] =	"Erreur inattendue!!! ";
	require (__DIR__.'/../vues/erreur.php');
	}


//fin
exit(0);


function Reinit()  {
	require (__DIR__.'/../vues/head.php');
	require (__DIR__.'/../vues/login.php');
	require (__DIR__.'/../vues/footer.php');
}

function SignIn($login,$password) {
	global $gtw;
	$bool = $gtw->signIn($login,$password);
	if($bool){
		displayInterface($login);
	}else{
		Reinit();
	}
}

function displayInterface($user){
	global $gtw;
	$task = $gtw->buildTaskForUser($user);

	require (__DIR__.'/../vues/head.php');
	require (__DIR__.'/../vues/header.php');
	require (__DIR__.'/../vues/toDoList.php');
	require (__DIR__.'/../vues/footer.php');
}

