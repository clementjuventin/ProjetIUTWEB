<?php


class TaskModel
{
    static function PushTask($con, $task){
        $gtw = new GatewayTask($con);
        $gtw->pushTask($task);
    }
    static function Pulltask($con, $user, $date){
        $gtw = new GatewayTask($con);
        $task = $gtw->buildDailyTaskForUser($user, $date);
        if($user->getLogin()!="public"){
            $task = array_merge($gtw->buildDailyTaskForUser(new User("public","public"), $date),$task);
        }
        return $task;
    }
}