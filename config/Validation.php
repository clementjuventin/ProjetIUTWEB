<?php

class Validation {

    static function val_SignIn(string &$login, string &$passwd, array &$dataVueErreur) {
        if(!isset($login)||$login==""){
            $dataVueErreur['Login'] = "Identifiant non entr&eacute;";
        }
        if(!isset($passwd)||$passwd==""){
            $dataVueErreur['Password'] = "Mot de passe non entr&eacute;";
        }
    }
    static function val_SignUp(string &$login, string &$passwd, string &$cpasswd, array &$dataVueErreur):bool {
        if($passwd!=$cpasswd){
            $dataVueErreur['Password'] = "Les mots de passe saisis ne sont pas identiques";
            return false;
        }
        if(strlen($passwd)<7){
            $dataVueErreur['Password'] = "La longueur du mot de passe doit &ecirc;tre sup&eacute;rieure &agrave; 7 caract&egrave;res.";
            return false;
        }
        if(!isset($login)||$login==""){
            $dataVueErreur['Login'] = "Identifiant ou mot de passe non entr&eacute;";
            return false;
        }
        if(!isset($passwd)||$passwd==""||!isset($cpasswd)||$cpasswd==""){
            $dataVueErreur['Password'] = "Identifiant ou mot de passe non entr&eacute;";
            return false;
        }
        if (filter_var($login, FILTER_SANITIZE_STRING)!=$login)//Utiliser validate
        {
            $dataVueErreur['Login'] = "Caract&egrave;res utilis&eacute;s incorrectes";
            $login="";
            return false;
        }
        
        return true;
    }
    static function valId($id, array &$dataVueErreur):bool {
        
         if (filter_var($id, FILTER_SANITIZE_NUMBER_INT)!=$id) {
            $dataVueErreur['ID'] = "Erreur suppression Id;"; 
            return false;
         }
         return true;
    }

    static function fil_Task(Task &$task,&$dataVueErreur){
        $tmp = $task->getTitre();
        if(!isset($tmp)||$tmp==""){
            $dataVueErreur['Titre'] = "Aucun titre renseign&eacute;";
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

        $tmp = $task->getListId();
        if(!isset($tmp)||$tmp==""){
            $dataVueErreur['ListId'] = "[ERR] Aucun id n'a �t� entr� pour la liste";
            throw new Exception("Invalid parameter");
        }
        $task->setId(filter_var($tmp, FILTER_SANITIZE_STRING));
    }

     static function fil_Liste(Liste &$list,&$dataVueErreur){
         $tmp = $list->getLabel();
         if(!isset($tmp)||$tmp==""){
             $dataVueErreur['Titre'] = "Aucun titre renseign&eacute;";
         }
         $list->setLabel(filter_var($tmp, FILTER_SANITIZE_STRING));
     }
}
?>
