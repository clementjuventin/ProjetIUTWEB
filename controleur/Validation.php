<?php

class Validation {

    static function val_SignIn(string &$login, string &$passwd, array &$dataVueErreur) {

        if(!isset($login)||$login==""){
            $dataVueErreur['Titre'] = "Identifiant ou mot de passe non entré.";
        }
        if(!isset($passwd)||$passwd==""){
            $dataVueErreur['Titre'] = "Identifiant ou mot de passe non entré.";
        }
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
