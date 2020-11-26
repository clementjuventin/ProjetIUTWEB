<?php

class Validation {

    static function val_action($action) {
    if (!isset($action)) { throw new Exception('pas d\'action');}
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

    static function val_Task(&$title,&$comment,&$date,&$color,&$dataVueErreur){

        if (!Validation::val_string($title) || !Validation::val_string($date) || !Validation::val_string($color)){
            $dataVueErreur[] =	"Erreur dans la saisie";
            $title="";
            $comment="";
            $date="";
            $color="";
        }
        $title=filter_var($title, FILTER_SANITIZE_STRING);
        $comment=filter_var($comment, FILTER_SANITIZE_STRING);
        $date=filter_var($date, FILTER_SANITIZE_STRING);
        $color=filter_var($color, FILTER_SANITIZE_STRING);

        //Comment enlever les < mais pas les '
    }

    static function val_Date(string &$day, string &$month, array &$dataVueErreur) {
        if($month%2!=1){
            if(($month==2 && $day>=29)||$day==31){
                $dataVueErreur[] =	"Le jour saisie n'existe pas";
            }
        }
    }
}
?>
