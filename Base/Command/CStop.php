<?php
/**
 * Created by PhpStorm..
 * User: lzf
 * Date: 15/5/21
 * Time: 14:53
 */

namespace Base\Command;


class CStop extends \Base\CCommand{

    public function execute(){
        $this->_checkTaskName();
        $taskName = '\Tasks\\'.$this->_tName;

        $pid = $this->checkPid();
        if($pid <= 0){
            throw new \Exception('Pid not exists!'.PHP_EOL);

        }
        @unlink(PIDS.$this->_tName);
        posix_kill($pid, SIGKILL);
        echo 'Stop success!'.PHP_EOL;
    }
}