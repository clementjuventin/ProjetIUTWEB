<?php

//chargement bibliothèque
require_once(__DIR__ . '/Validation.php');
require_once(__DIR__ . '/Connexion.php');
require_once(__DIR__ . '/../gateway/GatewayTask.php');
require_once(__DIR__ . '/../gateway/GatewayUser.php');
require_once(__DIR__ . '/../metier/Task.php');
require_once(__DIR__ . '/../metier/User.php');

//chargement config
include_once(__DIR__ . '/../config/config.php');

$dataVueErreur = array ();

try{
    session_start();

	$connexion = new Connexion($base,$login,$mdp);


	if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }else{
	    $user = new User("public","");
        $_SESSION['user'] = $user;
    }


	//isset($_SESSION['user'])?$_SESSION['user']:"public"

	$action=$_REQUEST['action'];

	switch($action) {
        case "signIn":
            SignIn($_POST['login'],$_POST['password']);
            break;
        case "signUpRedirect":
            SignUpRedirect();
            break;
        case "signUp":
            SignUp($_POST['login'],$_POST['password'],$_POST['cpassword']);
            break;
        case "addTask":
            InitAddTask();
            break;
        case "addTaskSubmit":
            PushTask();
            break;
        default:
            Reinit();
	}
} catch (PDOException $e)
{
	$dataVueErreur["PDOException"] = $e->getMessage();
	require(__DIR__ . '/../vues/erreur.php');
} catch (Exception $e2)
{
	$dataVueErreur["Exception"] =	$e2->getMessage();
	require(__DIR__ . '/../vues/erreur.php');
}
exit(0);

function Reinit()  {
	require(__DIR__ . '/../vues/head.php');
	require(__DIR__ . '/../vues/login.php');
	require(__DIR__ . '/../vues/footer.php');
}
function InitAddTask() {
    require(__DIR__ . '/../vues/head.php');
    require(__DIR__ . '/../vues/header.php');
    require(__DIR__ . '/../vues/addTask.php');
    require(__DIR__ . '/../vues/footer.php');
}
function SignIn($login,$password) {
	global $connexion;
    global $dataVueErreur;
    
    $gtw = new GatewayUser($connexion);

    Validation::val_SignIn($login,$password,$dataVueErreur);
	$bool = $gtw->signIn($login,$password,$dataVueErreur);
	if($bool){
        session($login, $password);
		displayInterface();
	}else{
		Reinit();
	}
}
function SignUp($login,$password,$cpassword) {
    global $connexion;
    global $dataVueErreur;

    $gtw = new GatewayUser($connexion);

    $bool=false;
    if(Validation::val_SignUp($login,$password,$cpassword,$dataVueErreur)){
        $bool = $gtw->signUp($login,$password,$dataVueErreur);
    }
    if($bool){
        require(__DIR__ . '/../vues/login.php');
    }else{
        SignUpRedirect();
    }
}
function SignUpRedirect(){
    require(__DIR__ . '/../vues/signUp.php');
}
function PushTask() {
    //Sous case cochée
    //mail(<adresse du destinataire>,<titre du mail>,<corps du message>);

    global $connexion;
    global $dataVueErreur;

    $user = $_SESSION['user'];

	$gtw = new GatewayTask($connexion);

    $task = new Task($_POST['title'],$_POST['comment'],$user,date('Y-m-d h:i',mktime($_POST['hour'], $_POST['min'], 0, $_POST['month'], $_POST['day'], $_POST['year'])),$_POST['color'],0);
    Validation::val_Task($task,$dataVueErreur);
    $gtw->pushTask($task);

    $_request['action']=NULL;
    header('Location: controleur/Controleur.php');
}
function displayInterface(){
    global $connexion;
    global $dataVueErreur;

    $user = $_SESSION['user'];

    $gtw = new GatewayTask($connexion);

	$task = $gtw->buildDailyTaskForUser($user->getLogin(), date("Y-m-d"));

	require(__DIR__ . '/../vues/head.php');
	require(__DIR__ . '/../vues/header.php');
	require(__DIR__ . '/../vues/toDoList.php');
	require(__DIR__ . '/../vues/footer.php');
}
function makeCookie(){
    //setcookie("titre", "desc", time()+365*24*3600);
}
function session($login, $password){
    session_start();
    $user = new User($login, $password);

    $_SESSION['user'] = $user;

    //var_dump(session_id());
}
