<?php


class TaskModel
{
    static function PushTask($con, $task){
        $gtw = new GatewayTask($con);
        $gtw->pushTask($task);
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
    static function PullList($con, $user){
        $gtw = new GatewayList($con);
        $list = $gtw->buildList($user);
        /*
        if($user->getLogin()!="public"){
            $task = array_merge($gtw->buildDailyTaskForUser(new User("public","public"), $date),$task);
        }
        */
        return $list;
    }
}
    static function PushList($con, $list){
        $gtw = new GatewayList($con);
        $gtw->pushList($list);
        /*
        if($user->getLogin()!="public"){
            $task = array_merge($gtw->buildDailyTaskForUser(new User("public","public"), $date),$task);
        }
        */
    
    }
}