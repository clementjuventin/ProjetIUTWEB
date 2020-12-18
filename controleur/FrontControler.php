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

        $this->vues = $vues;                                        //R�cup�re les vues

        session_start();                                    //Session

        $this->connexion = new Connexion($base, $login, $mdp);              //Connexion
        $this->dataVueErreur = array();                                  //Tableau erreur


        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = 'null';
        }
        try {
            switch ($action) {
                case "null":
                    if(!isset($_SESSION['user'])){
                        new PublicControler($vues,$base,$login,$mdp);
                    }
                    else{
                        new UserControler($vues,$base,$login,$mdp);
                    }
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

    function Session($login, $password){
        session_start();
        $this->user = new User($login, $password);

        $_SESSION['user'] = $this->user;
    }
}