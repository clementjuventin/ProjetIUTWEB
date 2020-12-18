<?php
/*
 * A ajouter: Authentification lors de chaque opération avec la base de donnée
 *
 */

class GatewayTask
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

    public function buildTask($id):array{
        $query="SELECT * FROM task WHERE listId=:id;";

        $this->connexion->executeQuery($query,array(':id'=>array($id,PDO::PARAM_STR)));

        $results = $this->connexion->getResults();

        $final = array();
        foreach ($results as $res){
            $final[] = new Task($res['title'],$res['description'],$id,$res['color'],$res['id']);
        }
        return $final;
    }

    public function pushTask(Task $task){
        $query="INSERT INTO task (title,description,listId,color) VALUES(:title,:description,:id,:color)";

        $this->connexion->executeQuery($query,array(
            ':title'=>array($task->getTitre(),PDO::PARAM_STR),
            ':description'=>array($task->getDescription(),PDO::PARAM_STR),
            ':id'=>array($task->getListId(),PDO::PARAM_STR),
            ':color'=>array($task->getColor(),PDO::PARAM_STR)
        ));
    }
}