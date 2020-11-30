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

    public function buildDailyTaskForUser(User $user, $date):array{
        $query="SELECT * FROM task WHERE user=:usr AND date BETWEEN :dte AND :dte2;";

        $date2 = date('Y-m-d',strtotime($date)+3600*24);

        $date = $date." 00:00:00.000000";
        $date2 = $date2." 00:00:00.000000";

        $this->connexion->executeQuery($query,array(':usr'=>array($user->getLogin(),PDO::PARAM_STR),':dte'=>array($date,PDO::PARAM_STR),':dte2'=>array($date2,PDO::PARAM_STR)));

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