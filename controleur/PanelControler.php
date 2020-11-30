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
    session_start();

    $connexion = new Connexion($base,$login,$mdp);

    /*
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }else{
        $user = new User("public","");
        $_SESSION['user'] = $user;
    }
    */

    $action=$_REQUEST['action'];

    switch($action) {
        case "addTask":
            initAddTask();
            break;
        case "addTaskSubmit":
            pushTask();
            break;
        case "displayTask":
            displayInterface();
            break;
        default:
            $_REQUEST['action'] = "logOut";
            header('Location: SessionControler.php');
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

function initAddTask() {
    require (__DIR__.'/../vues/head.php');
    require (__DIR__.'/../vues/header.php');
    require (__DIR__.'/../vues/addTask.php');
    require (__DIR__.'/../vues/footer.php');
}
function pushTask() {
    //Sous case cochée
    //mail(<adresse du destinataire>,<titre du mail>,<corps du message>);

    global $connexion;
    global $dataVueErreur;

    $user = $_SESSION['user'];
    $gtw = new GatewayTask($connexion);

    $task = new Task($_POST['title'],$_POST['comment'],$user,date('Y-m-d h:i',mktime($_POST['hour'], $_POST['min'], 0, $_POST['month'], $_POST['day'], $_POST['year'])),$_POST['color'],0);
    Validation::fil_Task($task,$dataVueErreur);

    $gtw->pushTask($task);

    header('Location: PanelControler.php?action=displayTask');
}
function displayInterface(){
    global $connexion;
    global $dataVueErreur;

    $user = $_SESSION['user'];

    $gtw = new GatewayTask($connexion);

    $task = $gtw->buildDailyTaskForUser($user, date("Y-m-d"));
    if($user->getLogin()!="public"){
        $task = array_merge($gtw->buildDailyTaskForUser(new User("public","public"), date("Y-m-d")),$task);
    }

    require (__DIR__.'/../vues/head.php');
    require (__DIR__.'/../vues/header.php');
    require (__DIR__.'/../vues/toDoList.php');
    require (__DIR__.'/../vues/footer.php');
}
function makeCookie(){
    //setcookie("titre", "desc", time()+365*24*3600);
}
