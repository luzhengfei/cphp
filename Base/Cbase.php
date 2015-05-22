<?php
/**
 * Created by PhpStorm.
 * User: lzf
 * Date: 15/5/21
 * Time: 10:40
 * 工厂类，获取系统组件
 */

namespace Base;

class Cbase{
    public static $coreCommandMap = array(
        'start' => '\Base\Command\CStart',
        'stop' => '\Base\Command\CStop',
        'info' => '\Base\Command\CInfo',
        'list' => '\Base\Command\CList'
    );

    public static $config;

    public static function getRequest(){
        return new CRequest();
    }

    public static function getCommand($commandName = ''){
        return new self::$coreCommandMap[$commandName]();
    }

    public static function getManage(){
        return CManage::getInstance();
    }

    public static function loader($class){
        require_once DIR.DIRECTORY_SEPARATOR.str_replace('\\','//',$class).'.php';
    }

    public static function getLogger(){
        if(isset(self::$config['redis'])){
            return new \Base\Storage\CRedis();
        }else{
            return new \Base\CLogger();
        }
    }
}

spl_autoload_register("Base\\Cbase::loader");