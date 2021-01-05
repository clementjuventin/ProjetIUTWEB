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
                case "displayTask":
                    $this->displayInterface();
                    break;
                case "addTask":
                    $this->initAddTask();
                    break;
                case "addList":
                    $this->initAddList();
                    break;
                case "addTaskSubmit":
                    $this->pushTask();
                    break;
                case "addListSubmit":
                    $this->pushList();
                    break;
                case "delTask":
                    $this->deleteTask();
                    break; 
                case "delList":
                    $this->deleteList();
                        break;     
                case "doneTask":
                    $this->doneTask();
                    break; 
                       
                case "logOut":
                    session_unset();
                    session_destroy();
                    header('Location: index.php');
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
            var_dump($_REQUEST['action']);
        }
        exit(0);
    }

    function initAddTask() {

        $list = TaskModel::PullList($this->connexion,true,'');
        require ($this->vues['head']['url']);
        require ($this->vues['header']['url']);
        require ($this->vues['addTask']['url']);
        require ($this->vues['footer']['url']);
    }

    function initAddList() {

        require ($this->vues['head']['url']);
        require ($this->vues['header']['url']);
        require ($this->vues['addList']['url']);
        require ($this->vues['footer']['url']);
    }

    function pushTask() {
        $task = new Task($_POST['title'],$_POST['comment'],$_POST['listLabel'],$_POST['color'],0,0);
        Validation::fil_Task($task,$this->dataVueErreur);

        TaskModel::PushTask($this->connexion,$task);

        header('Location: index.php');
    }
    function pushList() {
        $list = new Liste($_POST['title'],0,'',true);
        Validation::fil_Liste($list,$this->dataVueErreur);

        TaskModel::PushListe($this->connexion,$list);

        header('Location: index.php');
    }

    function deleteTask() {
    
        if(Validation::valId($_POST['id'],$this->dataVueErreur))
        TaskModel::DeleteTask($this->connexion,$_POST['id']);

        header('Location: index.php');
    }

    function deleteList() {
    
        if(Validation::valId($_POST['id'],$this->dataVueErreur))
        TaskModel::DeleteList($this->connexion,$_POST['id']);

        header('Location: index.php');
    }

    function doneTask() {
    
        if(Validation::valId($_POST['id'],$this->dataVueErreur))
        TaskModel::DoneTask($this->connexion,$_POST['id']);

        header('Location: index.php');
    }


    function displayInterface(){
        $list = TaskModel::PullList($this->connexion,true, '');
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