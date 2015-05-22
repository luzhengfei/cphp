<?php
/**
 * Created by PhpStorm.
 * User: mahui
 * Date: 15/5/21
 * Time: 11:51
 */

namespace Base\Command;


class CStart extends \Base\CCommand{

    public function execute(){
        //获取任务名称
        $this->_checkTaskName();
        $taskName = '\Tasks\\'.$this->_tName;

        $task = new $taskName();
        $this->beginFork();
        $task->setCommand($this);

        $task->run();
    }
}