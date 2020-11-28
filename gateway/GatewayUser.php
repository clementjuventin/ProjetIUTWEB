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

        /*
        $t = $this->connexion->fetch($res);
        if(!password_verify($password, $t['password'])) {
            echo '<p>erreur</p>';
            return false;
        }
         */

        $succes = $this->connexion->getSucceed();
        if(!$succes){
            $dataVueErreur["Login"] =	"Mot de passe ou identifiant invalide";
        }
        return $succes;
    }
    public function signUp($login, $password, &$dataVueErreur): bool
    {
        /*
        $options = [
            'cost' => 12,
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);
        */
        $query = "INSERT INTO user(login,password) VALUES(:login, :password)";
        try {
            $this->connexion->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR),
                ':password' => array($password, PDO::PARAM_STR)));
        }catch (PDOException $e){
            $dataVueErreur['Login']="L'identifiant saisie existe déjà";
            return false;
        }



        return true;
    }
}