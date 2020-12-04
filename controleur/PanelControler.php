<?php


class PanelControler
{
    private $connexion;
    private $vues;
    private $dataVueErreur;
    private $colors = array("#ffadad","#ffd6a5","#fdffb6","#caffbf","#9bf6ff","#a0c4ff","#bdb2ff","#ffc6ff");
    /**
     * SessionControler constructor.
     */
    public function __construct()
    {
        include_once(__DIR__ . '/../config/config.php');              //Config

        $this->vues = $vues;                                        //Récupère les vues

        session_start();                                    //Session

        $this->connexion = new Connexion($base, $login, $mdp);              //Connexion
        $this->dataVueErreur = array();                                  //Tableau erreur


        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = NULL;
        }

        try {
            switch ($action) {
                case "logOut":
                    header('Location: index.php?action=NULL');
                    break;
                case "addTask":
                    $this->initAddTask();
                    break;
                case "addTaskSubmit":
                    $this->pushTask();
                    break;
                case "displayTask":
                    $this->displayInterface();
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
        require ($this->vues['head']['url']);
        require ($this->vues['header']['url']);
        require ($this->vues['addTask']['url']);
        require ($this->vues['footer']['url']);
    }
    function pushTask() {
        //Sous case cochée
        //mail(<adresse du destinataire>,<titre du mail>,<corps du message>);

        $user = $_SESSION['user'];

        $task = new Task($_POST['title'],$_POST['comment'],$user,date('Y-m-d h:i',mktime($_POST['hour'], $_POST['min'], 0, $_POST['month'], $_POST['day'], $_POST['year'])),$_POST['color'],0);
        Validation::fil_Task($task,$this->dataVueErreur);

        TaskModel::PushTask($this->connexion,$task);

        header('Location: userInterface.php?action=displayTask');
    }
    function displayInterface(){
        $user = $_SESSION['user'];

        $task = TaskModel::Pulltask($this->connexion,$user,date("Y-m-d"));

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