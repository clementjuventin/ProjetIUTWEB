<?php

class Gateway
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

    public function FindByName($name):array{
        $query="SELECT * FROM artist WHERE nom=:name";

        $this->connexion->executeQuery($query,array(':name'=>array($name,PDO::PARAM_STR)));

        $results = $this->connexion->getResults();

        $final = array();
        foreach ($results as $res){
            array_push($final, new Artiste($res['id'],$res['name'],$res['prenom'],$res['nbAlbumsFaits'],));
        }

        return $final;
    }
}