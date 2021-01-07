<?php


class Factory
{
    public static function makeTask($results,$param){
        switch ($param){
            case "sql":
               
                $final = array();
                foreach ($results as $res){
                    $final[] = new Task($res['title'],$res['description'],$res['listId'],$res['color'],$res['id'],$res['isDone']);
                }
                return $final;
            default:
                throw new Exception(__CLASS__." : Param�tre ".$param." inconnu.");
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
                throw new Exception(__CLASS__." : Param�tre ".$param." inconnu.");
        }
    }
}