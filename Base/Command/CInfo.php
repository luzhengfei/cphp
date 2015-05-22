<?php
/**
 * Created by PhpStorm.
 * User: lzf
 * Date: 15/5/21
 * Time: 17:04
 */
namespace Base\Command;

class CInfo extends \Base\CCommand{

    public function execute(){
        $this->_checkTaskName();

        if(!function_exists('shell_exec')){
            throw new \Exception('Need support shell_exec'.PHP_EOL);
        }

        $result = shell_exec('ps aux|grep "c.php start '.$this->_tName.'"');
        $output = explode(PHP_EOL,$result);
        if(count($output) < 3){
            throw new \Exception($this->_tName.' Info Empty'.PHP_EOL);
        }

        $taskInfo = preg_split('/\s+/ie',$output[2]);
        $outStr = sprintf("User:%s PID:%s CPU:%s MEM:%s StartTime:%s During:%s",
            $taskInfo[0].PHP_EOL,
            $taskInfo[1].PHP_EOL,
            $taskInfo[2].PHP_EOL,
            $taskInfo[3].PHP_EOL,
            $taskInfo[8].PHP_EOL,
            $taskInfo[9].PHP_EOL);
        echo $outStr;
    }
}