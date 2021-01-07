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
            $action = 'null';
        }
        try {
            switch ($action) {
                case "public":
                    $_SESSION['role'] = 'public';
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
                case "null":
                    $this->Reinit();
                    break;
                case "signIn":
                    $this->SignIn($_POST['login'], $_POST['password']);
                    if(isset($_SESSION['user'])){
                        $_SESSION['role'] = 'user';
                        new UserControler($vues,$base,$login,$mdp);
                    }
                    break;
                case "signUpRedirect":
                    $this->SignUpRedirect();
                    break;
                case "signUp":
                    $this->SignUp($_POST['login'], $_POST['password'], $_POST['cpassword']);
                    break;
                case "logOut":
                    session_unset();
                    session_destroy();
                    $_REQUEST['action']=NULL;
                    $this->Reinit();
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
        if(!isset($_POST['listLabel'])){
            $_POST['listLabel']="";
        }
        try{
            $task = new Task($_POST['title'],$_POST['comment'],$_POST['listLabel'],$_POST['color'],0,0);
            Validation::fil_Task($task,$this->dataVueErreur);
            TaskModel::PushTask($this->connexion,$task);
            $this->displayInterface();
        }catch (Exception $e){
            $this->initAddTask();
        }
    }
    function pushList() {
        
        $list = new Liste($_POST['title'],0,'',true);
        Validation::fil_Liste($list,$this->dataVueErreur);

        TaskModel::PushListe($this->connexion,$list);


        $this->displayInterface();
    }

    function deleteTask() {
    
        if(Validation::valId($_POST['id'],$this->dataVueErreur))
        TaskModel::DeleteTask($this->connexion,$_POST['id']);

        $this->displayInterface();
    }

    function deleteList() {
    
        if(Validation::valId($_POST['id'],$this->dataVueErreur))
        TaskModel::DeleteList($this->connexion,$_POST['id']);

        $this->displayInterface();
    }

    function doneTask() {
    
        if(Validation::valId($_POST['id'],$this->dataVueErreur))
        TaskModel::DoneTask($this->connexion,$_POST['id']);

        $this->displayInterface();
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
    function SignIn($login,$password) {
        Validation::val_SignIn($login,$password,$this->dataVueErreur);

        $bool = UserModel::SignIn($this->connexion,$login,$password,$this->dataVueErreur);

        if($bool){
            $this->Session($login, $password);
        }else{
            $this->dataVueErreur['Login']="Probl&egrave;me lors de l'identification";
            $this->Reinit();
        }
    }
    function SignUp($login,$password,$cpassword) {

        $bool=false;
        if(Validation::val_SignUp($login,$password,$cpassword,$this->dataVueErreur)){
            $bool = UserModel::SignUp($this->connexion,$login,$password,$this->dataVueErreur);
        }
        if($bool){
            require($this->vues['head']['url']);
            require($this->vues['login']['url']);
        }else{
            $this->SignUpRedirect();
        }
    }
    function SignUpRedirect(){
        require($this->vues['head']['url']);
        require($this->vues['signUp']['url']);
    }
    function Reinit(){
        require($this->vues['head']['url']);
        require($this->vues['login']['url']);
        require($this->vues['footer']['url']);
    }
    function Session($login, $password){
        $this->user = new User($login, $password);

        $_SESSION['user'] = $this->user;
    }
}