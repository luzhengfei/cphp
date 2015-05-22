<?php
/**
 * Created by PhpStorm.
 * User: mahui
 * Date: 15/5/21
 * Time: 12:09
 */

namespace Base;

class CTask{
    public $command;
    public $loger;

    public function __construct(){
        $this->loger = Cbase::getLogger();
        $this->successInfo();
    }

    public function setCommand(CCommand $cmd){
        $this->command = $cmd;
    }

    public function report($message = ""){
        //报警逻辑
        //mail("admin@emila.com","warn",$message);
    }

    /**
     * 进程检查器
     * 防止pid被删除后，重启任务导致任务重覆执行.
     */
    protected function Checker(){
        if(!$this->command->checkPid()){
            $tName = $this->command->getTName();
            $this->report("illegal Exit");
            if(function_exists('shell_exec') && $tName){
                shell_exec('ps -ef|grep "c.php start '.$tName.'"|awk \'{print $2}\'|xargs kill -9');
            }
        }
    }

    private function successInfo(){
        echo "Start Success!".PHP_EOL;
    }
}