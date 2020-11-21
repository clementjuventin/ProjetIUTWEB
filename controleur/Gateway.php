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

    public function buildTaskForUser($user):array{
        $query="SELECT * FROM task WHERE user=:usr;";

        $this->connexion->executeQuery($query,array(':usr'=>array($user,PDO::PARAM_STR)));

        $results = $this->connexion->getResults();

        $final = array();
        foreach ($results as $res){
            $date = date('Y-m-d h:i',strtotime($res['date']));
            array_push($final, new Task($res['title'],$res['description'],$res['user'],$date,$res['color'],$res['id']));
        }

        return $final;
    }

    public function signIn($login, $password):bool{
        $query="SELECT * FROM user WHERE login=:log AND password=:pswd;";

        $this->connexion->executeQuery($query,array(':log'=>array($login,PDO::PARAM_STR),':pswd'=>array($password,PDO::PARAM_STR)));

        return $this->connexion->getSucceed();
    }

    public function pushTask(Task $task){
        $query="INSERT INTO task (user,title,description,date,color) VALUES(:usr,:title,:description,:dte,:color)";



        $this->connexion->executeQuery($query,array(
            ':usr'=>array($task->getUser(),PDO::PARAM_STR),
            ':title'=>array($task->getTitre(),PDO::PARAM_STR),
            ':description'=>array($task->getDescription(),PDO::PARAM_STR),
            ':dte'=>array($task->getDate(),PDO::PARAM_STR),
            ':color'=>array($task->getColor(),PDO::PARAM_STR)
        ));
    }
}