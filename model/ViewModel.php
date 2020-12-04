<?php


class ViewModel
{
    public static $colors = array("#ffadad","#ffd6a5","#fdffb6","#caffbf","#9bf6ff","#a0c4ff","#bdb2ff","#ffc6ff");

    public static function getColors(){
        return ViewModel::$colors;
    }
    public static function getColor():string{
        return ViewModel::$colors[rand(0,count(ViewModel::$colors)-1)];
    }
}