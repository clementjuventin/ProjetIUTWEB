<?php


class PublicControler
{
    private $connexion;
    private $vues;
    private $dataVueErreur;
    private $user;
    /**
     * SessionControler constructor.
     */
    public function __construct($vues,$base,$login,$mdp)
    {
        include_once(__DIR__ . '/../config/config.php');              //Config

        $this->vues = $vues;                                        //R�cup�re les vues

        $this->connexion = new Connexion($base, $login, $mdp);              //Connexion
        $this->dataVueErreur = array();                                  //Tableau erreur


        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = 'public';
        }
        try {
            switch ($action) {
                case "public":
                    $this->displayInterface();
                    break;
                case "addTask":
                    $this->initAddTask();
                    break;
                case "addTaskSubmit":
                    $this->pushTask();
                    break;
                case "addPublicList":
                    $this->initAddPublicList();
                    break;
                default:
                    $this->dataVueErreur['action'] = "Action non prise en compte par le controleur";
                    require($this->vues['head']['url']);
                    require($this->vues['erreur']['url']);

            }
        } catch (PDOException $e) {
            $this->dataVueErreur["PDOException"] = $e->getMessage();
            require($this->vues['head']['url']);
            require($this->vues['erreur']['url']);
        } catch (Exception $e2) {
            $this->dataVueErreur["Exception"] = $e2->getMessage();
            require($this->vues['head']['url']);
            require($this->vues['erreur']['url']);
        }
        exit(0);
    }

    function initAddTask() {
        $user = $_SESSION['user'];

        $list = TaskModel::PullList($this->connexion,$user);
        require ($this->vues['head']['url']);
        require ($this->vues['header']['url']);
        require ($this->vues['addTask']['url']);
        require ($this->vues['footer']['url']);
    }

    function pushTask() {
        $task = new Task($_POST['title'],$_POST['comment'],$_POST['listLabel'],$_POST['color'],0);
        Validation::fil_Task($task,$this->dataVueErreur);

        TaskModel::PushTask($this->connexion,$task);

        header('Location: index.php');
    }

    function initAddPublicList() {
        require ($this->vues['head']['url']);
        require ($this->vues['header']['url']);
        require ($this->vues['addPublicList']['url']);
        require ($this->vues['footer']['url']);
    }   

    function displayInterface(){
        $list = TaskModel::PullList($this->connexion,new User("",""));
        foreach ($list as $l){
            $l->addToList(TaskModel::Pulltask($this->connexion,$l->getId()));
        }
        require ($this->vues['head']['url']);
        require ($this->vues['header']['url']);
        require ($this->vues['toDoList']['url']);
        require ($this->vues['footer']['url']);
    }
    function Session($login, $password){
        session_start();
        $this->user = new User($login, $password);

        $_SESSION['user'] = $this->user;
    }
}