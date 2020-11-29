<?php


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

    public function buildDailyTaskForUser($user,$date):array{
        $query="SELECT * FROM task WHERE user=:usr AND date=:dte;";

        $this->connexion->executeQuery($query,array(':usr'=>array($user,PDO::PARAM_STR),':dte'=>array($date,PDO::PARAM_STR)));

        $results = $this->connexion->getResults();

        $final = array();
        foreach ($results as $res){
            $date = date('Y-m-d h:i',strtotime($res['date']));
            $final[] = new Task($res['title'],$res['description'],$res['user'],$date,$res['color'],$res['id']);
        }

        return $final;
    }

    public function pushTask(Task $task){
        $query="INSERT INTO task (user,title,description,date,color) VALUES(:usr,:title,:description,:dte,:color)";

        $date = $task->getDate().' '.$task->getHour().':00';

        $this->connexion->executeQuery($query,array(
            ':usr'=>array($task->getUser(),PDO::PARAM_STR),
            ':title'=>array($task->getTitre(),PDO::PARAM_STR),
            ':description'=>array($task->getDescription(),PDO::PARAM_STR),
            ':dte'=>array($date,PDO::PARAM_STR),
            ':color'=>array($task->getColor(),PDO::PARAM_STR)
        ));
    }
}