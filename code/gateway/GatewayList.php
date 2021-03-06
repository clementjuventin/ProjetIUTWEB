<?php
/*
 * A ajouter: Authentification lors de chaque op�ration avec la base de donn�e
 *
 */

class GatewayList
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

    public function buildList(User $user):array{
        $query="SELECT * FROM list WHERE user=:usr OR isPublic='1'";

        $this->connexion->executeQuery($query,array(':usr'=>array($user->getLogin(),PDO::PARAM_STR)));

        $results = $this->connexion->getResults();

        return Factory::makeList($results, "sql");
    }
    public function deleteList($listId){
        $query="DELETE FROM list WHERE listId=:listId;";

        $this->connexion->executeQuery($query,array(':listId'=>array($listId,PDO::PARAM_STR)));
    }

    public function buildPublicList():array{
        $query="SELECT * FROM list WHERE isPublic='1'";

        $this->connexion->executeQuery($query,array());

        $results = $this->connexion->getResults();


        return Factory::makeList($results, "sql");
    }

    public function pushList(Liste $list){
        $query="INSERT INTO list (label,user,isPublic) VALUES(:label,:user,:isPublic)";


        $this->connexion->executeQuery($query,array(
            ':label'=>array($list->getLabel(),PDO::PARAM_STR),
            ':user'=>array($list->getUser(),PDO::PARAM_STR),
            ':isPublic'=>array($list->isPublic(),PDO::PARAM_STR),
        ));
    }
}