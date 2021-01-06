<?php


class Factory
{
    public static function makeTask($results,$param){
        switch ($param){
            case "sql":
                $idL = array_pop($results);
                $final = array();
                foreach ($results as $res){
                    $final[] = new Task($res['title'],$res['description'],$idL,$res['color'],$res['id'],$res['isDone']);
                }
                return $final;
            default:
                throw new Exception(__CLASS__." : Paramètre ".$param." inconnu.");
        }
    }
    public static function makeList($results,$param){
        switch ($param){
            case "sql":
                $final = array();
                foreach ($results as $res){
                    $final[] = new Liste($res['label'],$res['listId'],$res['user'],$res['isPublic']);
                }
                return $final;
            default:
                throw new Exception(__CLASS__." : Paramètre ".$param." inconnu.");
        }
    }
}