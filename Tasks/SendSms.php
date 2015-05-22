<?php
/**
 * Created by PhpStorm.
 * User: lzf
 * Date: 15/5/21
 * Time: 13:58
 */

namespace Tasks;

class SendSms extends \Base\CTask{
    public function __construct(){
        parent::__construct();
    }

    public function run(){
        while(1){


            //任务开始----
            sleep(2);
            file_put_contents(DIR.DIRECTORY_SEPARATOR.'logs/ccc.log',date('Y-m-d H:i:s'),FILE_APPEND);
            //任务结束----


            //循环检查自身pid是否存在，如果不存在，杀掉自身线程
            $this->Checker();
        }

        //记录当前任务执行的状态，可根据自已要求定制数据格式。
        //$this->loger->record('dd','sdfdsf');
    }
}