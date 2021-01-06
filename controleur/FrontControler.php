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


        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'public') {
                if(!isset($_REQUEST['action'])){
                    $_REQUEST['action'] = "displayTask";
                }
                return new PublicControler($vues, $base, $login, $mdp);
            }
            if ($_SESSION['role'] == 'user') {
                return new UserControler($vues, $base, $login, $mdp);
            }
            $this->dataVueErreur['Role'] = 'Role non definit';
            require($this->vues['head']['url']);
            require($this->vues['erreur']['url']);
        }
        new PublicControler($vues, $base, $login, $mdp);
    }
}