<?php

class Validation {

    static function val_SignIn(string &$login, string &$passwd, array &$dataVueErreur) {
        if(!isset($login)||$login==""){
            $dataVueErreur['Login'] = "Identifiant non entré.";
        }
        if(!isset($passwd)||$passwd==""){
            $dataVueErreur['Password'] = "Mot de passe non entré.";
        }
    }
    static function val_SignUp(string &$login, string &$passwd, string &$cpasswd, array &$dataVueErreur):bool {
        if($passwd!=$cpasswd){
            $dataVueErreur['Password'] = "Les mots de passe saisis ne sont pas identiques.";
            return false;
        }
        if(!isset($login)||$login==""){
            $dataVueErreur['Login'] = "Identifiant ou mot de passe non entré.";
            return false;
        }
        if(!isset($passwd)||$passwd==""||!isset($cpasswd)||$cpasswd==""){
            $dataVueErreur['Password'] = "Identifiant ou mot de passe non entré.";
            return false;
        }
        if (filter_var($login, FILTER_SANITIZE_STRING)!=$login)
        {
            $dataVueErreur['Login'] = "Caractères utilisés incorrectes";
            $login="";
            return false;
        }
        return true;
    }

    static function val_Task(Task &$task,&$dataVueErreur){
        $tmp = $task->getTitre();
        if(!isset($tmp)||$tmp==""){
            $dataVueErreur['Titre'] = "Aucun titre renseigné.";
        }
        $task->setTitre(filter_var($tmp, FILTER_SANITIZE_STRING));
        $tmp = $task->getDescription();
        if(!isset($tmp)){
            $dataVueErreur['Description'] = "[ERR] Description";
        }
        $task->setDescription(filter_var($tmp, FILTER_SANITIZE_STRING));
        $tmp = $task->getColor();
        if(!isset($tmp)||$tmp==""){
            $dataVueErreur['Color'] = "[ERR] Color";
        }
        $task->setColor(filter_var($tmp, FILTER_SANITIZE_STRING));
        $tmp = $task->getDate();
        if(!isset($tmp)||$tmp==""){
            $dataVueErreur['Date'] = "[ERR] Date";
        }
        $task->setDate(filter_var($tmp, FILTER_SANITIZE_STRING));
    }
}
?>
