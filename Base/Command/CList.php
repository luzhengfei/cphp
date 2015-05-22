<?php
/**
 * Created by PhpStorm.
 * User: mahui
 * Date: 15/5/21
 * Time: 17:47
 */

namespace Base\Command;


class CList extends \Base\CCommand{

    public function execute(){
        $taskList = glob(TASKDIR.'*.php');
        foreach($taskList as $v){
            echo $v.PHP_EOL;
        }
    }
}