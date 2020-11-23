<?php

class Validation {

    static function val_action($action) {

    if (!isset($action)) { throw new Exception('pas d\'action');}

        //on pourrait aussi utiliser
    //$action = $_GET['action'] ?? 'no';
        // This is equivalent to:
        //$action =  if (isset($_GET['action'])) $action=$_GET['action']  else $action='no';

    }
    static function fil_string(string &$string):bool{
        if($string != filter_var($string, FILTER_SANITIZE_STRING)){
            return false;
        }
        return true;
    }
    static function val_string(string &$string):bool{
        if(!isset($string)||$string==""){
            return 0;
        }
        return 1;
    }

    static function val_SignIn(string &$login, string &$passwd, array &$dataVueErreur) {

        if (!Validation::val_string($login) || !Validation::val_string($passwd)){
            $dataVueErreur[] =	"Mot de passe ou identifiant incorrect";
            $login="";
            $passwd="";
        }
        if (!Validation::fil_string($login) || !Validation::fil_string($passwd))
        {
            $dataVueErreur[] =	"INJECTION";
            $login="";
            $passwd="";
        }
    }

    static function val_Date(string &$day, string &$month, array &$dataVueErreur) {
        if($month%2!=1){
            if(($month==2 && $day>=29)||$day==31){
                $dataVueErreur[] =	"Le jour saisie n'existe pas";
            }
        }
    }

    static function val_Task(string &$titre, string &$commentaire, string &$day, string &$month, array &$dataVueErreur) {

        if (!Validation::val_string($titre)){
            $dataVueErreur[] =	"La saisie d'un titre est obligatoire";
            $titre="";
        }
        if (!Validation::fil_string($titre) || !Validation::fil_string($commentaire))
        {
            $dataVueErreur[] =	"INJECTION";
            $titre="";
            $commentaire="";
        }
        Validation::val_Date($day,$month,$dataVueErreur);
    }
}
?>
