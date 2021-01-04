<?php


class TaskModel
{
    static function PushTask($con, $task){
        $gtw = new GatewayTask($con);
        $gtw->pushTask($task);
    }

    static function PushListe($con, $liste){
        $gtw = new GatewayList($con);
        $gtw->pushList($liste);
    }

    static function Pulltask($con, $id){
        $gtw = new GatewayTask($con);
        $task = $gtw->buildTask($id);

        return $task;
    }

    static function DeleteTask($con, $id){
        $gtw = new GatewayTask($con);
        $gtw->deleteTask($id);
    }

    static function DoneTask($con, $id){
        $gtw = new GatewayTask($con);
        $gtw->doneTask($id);
    }
    static function PullList($con,$isPublic,$user){
        $gtw = new GatewayList($con);
        if($isPublic){
            $list = $gtw->buildPublicList();
        }
        else{
            $list = $gtw->buildList($user);
        }
        return $list;
    }
}