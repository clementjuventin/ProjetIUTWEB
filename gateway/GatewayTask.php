<?php
/*
 * A ajouter: Authentification lors de chaque op�ration avec la base de donn�e
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

        $results['idL']=$id;

        return Factory::makeTask($results,"sql");
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

    public function deleteTaskperListId($listId){

        $query="DELETE FROM task WHERE listId=:listId;";

        $this->connexion->executeQuery($query,array(':listId'=>array($listId,PDO::PARAM_STR)));

    }
    public function deleteTaskPerId($id){
     
        $query="DELETE FROM task WHERE id=:id;";

        $this->connexion->executeQuery($query,array(':id'=>array($id,PDO::PARAM_STR)));

    }

    public function doneTask($id){
    $query="UPDATE task SET isDone = 1 WHERE id=:id;";
    $this->connexion->executeQuery($query,array(':id'=>array($id,PDO::PARAM_STR)));
}

}