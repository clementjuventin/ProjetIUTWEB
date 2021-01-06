<?php


class Autoload
{
    private static $_instance = null;

    public static function charge(){
        if(self::$_instance==null) {
            self::$_instance = new self();
        }
        spl_autoload_register(function ($className){
            self::_autoload($className);
        });
    }

    private static function _autoload($class){
        $filename = $class.'.php';
        $dir = array('config/','controleur/','database/','gateway/','model/','model/metier/','factory/');
        foreach ($dir as $d){
            $file = './'.$d.$filename;
            if(file_exists($file)){
                include $file;
                break;
            }
        }
    }
}