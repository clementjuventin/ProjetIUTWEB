<?php


class SessionControler
{

    private $connexion;
    private $vues;
    private $dataVueErreur;
    private $user;
    /**
     * SessionControler constructor.
     */
    public function __construct()
    {
        include_once(__DIR__ . '/../config/config.php');              //Config

        $this->vues = $vues;                                        //Récupère les vues

        //session_start();                                    //Session
        $this->connexion = new Connexion($base, $login, $mdp);              //Connexion
        $this->dataVueErreur = array();                                  //Tableau erreur

        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        } else {
            $this->Session("public", "public");
        }
        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = "NULL";
        }
        try {
            switch ($action) {
                case "NULL":
                    $this->Reinit();
                    break;
                case "signIn":
                    $this->SignIn($_POST['login'], $_POST['password']);
                    break;
                case "public":
                    $this->SignIn($this->user->getLogin(), $this->user->getPassword());
                    break;
                case "signUpRedirect":
                    $this->SignUpRedirect();
                    break;
                case "signUp":
                    $this->SignUp($_POST['login'], $_POST['password'], $_POST['cpassword']);
                    break;
                default:
                    $this->dataVueErreur['action'] = "Action non prise en compte par le controleur";
                    require($this->vues['head']['url']);
                    require($vues['erreur']['url']);
            }
        } catch (PDOException $e) {
            $this->dataVueErreur["PDOException"] = $e->getMessage();
            require($this->vues['head']['url']);
            require($vues['erreur']['url']);
        } catch (Exception $e2) {
            $this->dataVueErreur["Exception"] = $e2->getMessage();
            require($this->vues['head']['url']);
            require($vues['erreur']['url']);
        }
        exit(0);
    }

    function SignIn($login,$password) {
        Validation::val_SignIn($login,$password,$this->dataVueErreur);

        $bool = UserModel::SignIn($this->connexion,$login,$password,$this->dataVueErreur);

        if($bool){
            $this->Session($login, $password);
            $_REQUEST['action'] = "displayTask";
            header('Location: userInterface.php?action=displayTask');
        }else{
            $this->dataVueErreur['Login']="Problème lors de l'identification";
            $this->Reinit();
        }
    }
    function SignUp($login,$password,$cpassword) {

        $bool=false;
        if(Validation::val_SignUp($login,$password,$cpassword,$this->dataVueErreur)){
            $bool = UserModel::SignUp($this->connexion,$login,$password,$this->dataVueErreur);
        }
        if($bool){
            require($this->vues['login']['url']);
        }else{
            $this->SignUpRedirect();
        }
    }
    function SignUpRedirect(){
        require($this->vues['signUp']['url']);
    }

    function Session($login, $password){
        session_start();
        $this->user = new User($login, $password);

        $_SESSION['user'] = $this->user;
    }
    function Reinit(){
        require($this->vues['head']['url']);
        require($this->vues['login']['url']);
        require($this->vues['footer']['url']);
    }
}