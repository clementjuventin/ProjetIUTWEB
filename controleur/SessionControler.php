<?php

//chargement bibliothèque
require_once(__DIR__.'/Validation.php');
require_once(__DIR__.'/Connexion.php');
require_once(__DIR__.'/../gateway/GatewayUser.php');
require_once(__DIR__.'/../metier/User.php');

//chargement config
include_once(__DIR__.'/../config/Config.php');

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

    $action=$_REQUEST['action'];

    switch($action) {
        case "signIn":
            SignIn($_POST['login'],$_POST['password']);
            break;
        case "public":
            SignIn("public","public");
            break;
        case "signUpRedirect":
            SignUpRedirect();
            break;
        case "signUp":
            SignUp($_POST['login'],$_POST['password'],$_POST['cpassword']);
            break;
        default:
            session_destroy();
            Reinit();
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
function SignIn($login,$password) {
    global $connexion;
    global $dataVueErreur;

    $gtw = new GatewayUser($connexion);

    Validation::val_SignIn($login,$password,$dataVueErreur);
    $bool = $gtw->signIn($login,$password,$dataVueErreur);
    if($bool){
        session($login, $password);
        $_REQUEST['action'] = "displayTask";
        header('Location: PanelControler.php?action=displayTask');
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
        require (__DIR__.'/../vues/login.php');
    }else{
        SignUpRedirect();
    }
}
function SignUpRedirect(){
    require (__DIR__.'/../vues/signUp.php');
}

function session($login, $password){
    session_start();
    $user = new User($login, $password);

    $_SESSION['user'] = $user;
    //var_dump(session_id());
}
