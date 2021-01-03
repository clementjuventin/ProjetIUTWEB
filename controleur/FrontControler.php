<?php


class FrontControler
{
    private $connexion;
    private $vues;
    private $dataVueErreur;
    /**
     * SessionControler constructor.
     */
    public function __construct()
    {
        include_once(__DIR__ . '/../config/config.php');              //Config

        $this->vues = $vues;                                        //Récupère les vues

        session_start();                                    //Session

        $this->connexion = new Connexion($base, $login, $mdp);              //Connexion
        $this->dataVueErreur = array();                                  //Tableau erreur

        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = 'null';
        }

        if(isset($_SESSION['role'])){
            if($_SESSION['role'] == 'public'){
                return new PublicControler($vues,$base,$login,$mdp);
            }
            if($_SESSION['role'] == 'user'){
                return new UserControler($vues,$base,$login,$mdp);
            }
            $this->dataVueErreur['Role'] = 'Role non definit';
        }

        try {
            switch ($action) {
                case "public":
                    $_SESSION['role'] = 'public';
                    new PublicControler($vues,$base,$login,$mdp);
                    break;
                case "null":
                    $action = NULL;
                    $this->Reinit();
                    break;
                case "signIn":
                    $this->SignIn($_POST['login'], $_POST['password']);
                    if(isset($_SESSION['user'])){
                        $_SESSION['role'] = 'user';
                        new UserControler($vues,$base,$login,$mdp);
                    }
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
                    require($this->vues['erreur']['url']);
            }
        } catch (PDOException $e) {
            $this->dataVueErreur["PDOException"] = $e->getMessage();
            require($this->vues['head']['url']);
            require($this->vues['erreur']['url']);
        } catch (Exception $e2) {
            $this->dataVueErreur["Exception"] = $e2->getMessage();
            require($this->vues['head']['url']);
            require($this->vues['erreur']['url']);
        }
        exit(0);
    }
    function SignIn($login,$password) {
        Validation::val_SignIn($login,$password,$this->dataVueErreur);

        $bool = UserModel::SignIn($this->connexion,$login,$password,$this->dataVueErreur);

        if($bool){
            $this->Session($login, $password);
        }else{
            $this->dataVueErreur['Login']="Probl&egrave;me lors de l'identification";
            $this->Reinit();
        }
    }
    function SignUp($login,$password,$cpassword) {

        $bool=false;
        if(Validation::val_SignUp($login,$password,$cpassword,$this->dataVueErreur)){
            $bool = UserModel::SignUp($this->connexion,$login,$password,$this->dataVueErreur);
        }
        if($bool){
            require($this->vues['head']['url']);
            require($this->vues['login']['url']);
        }else{
            $this->SignUpRedirect();
        }
    }
    function SignUpRedirect(){
        require($this->vues['head']['url']);
        require($this->vues['signUp']['url']);
    }
    function Reinit(){
        require($this->vues['head']['url']);
        require($this->vues['login']['url']);
        require($this->vues['footer']['url']);
    }
    function Session($login, $password){
        $this->user = new User($login, $password);

        $_SESSION['user'] = $this->user;
    }
}