<?php


class GatewayUser
{
    public $connexion;

    /**
     * Gateway constructor.
     * @param $connexion
     */
    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function signIn($login, $password,&$dataVueErreur):bool{

        $query="SELECT * FROM user WHERE login=:log AND password=:pswd;";
        $this->connexion->executeQuery($query,array(':log'=>array($login,PDO::PARAM_STR),':pswd'=>array($password,PDO::PARAM_STR)));

        $succes = $this->connexion->getSucceed();
        if(!$succes){
            $dataVueErreur[] =	"Mot de passe ou identifiant incorrect";
        }
        return $succes;
    }
}