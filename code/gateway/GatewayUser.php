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

        $query="SELECT * FROM user WHERE login=:log;";
        $this->connexion->executeQuery($query,array(':log'=>array($login,PDO::PARAM_STR)));

        $results = $this->connexion->getResults();

        if($this->connexion->getSucceed()){
            if(password_verify($password, $results[0]['password'])){
                return true;
            }
        }
        return false;
    }
    public function signUp($login, $password, &$dataVueErreur): bool
    {
        $options = [
            'cost' => 12,
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        $query = "INSERT INTO user(login,password) VALUES(:login, :password)";
        try {
            $this->connexion->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR),
                ':password' => array($password, PDO::PARAM_STR)));
        }catch (PDOException $e){
            $dataVueErreur['Login']="L'identifiant saisie existe d&eacute;j&agrave;";
            return false;
        }
        return true;
    }
}