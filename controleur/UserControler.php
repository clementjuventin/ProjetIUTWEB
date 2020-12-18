<?php


class UserControler
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
            $action = 'null';
        }
        try {
            switch ($action) {
                case "null":
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
                case "addPublicListSubmit":
                    $this->pushPublicList();
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

    function pushPublicList() {
        $user = $_SESSION['user'];

        $list = new Liste($_POST['label'],0,$user,1);
        //Validation::fil_Task($task,$this->dataVueErreur);

        TaskModel::PushList($this->connexion,$list);

        header('Location: index.php');
        }
    }
    function displayInterface(){
        $user = $_SESSION['user'];


        $list = TaskModel::PullList($this->connexion,$user);
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
    

