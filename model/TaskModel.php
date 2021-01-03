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
        /*
        if($user->getLogin()!="public"){
            $task = array_merge($gtw->buildDailyTaskForUser(new User("public","public"), $date),$task);
        }
        */
        return $task;
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