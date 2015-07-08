<?php
/**
 * Created by PhpStorm..
 * User: lzf
 * Date: 15/5/21
 * Time: 11:52
 */

namespace Base;

abstract class CCommand{
    protected $_params;
    protected $_tName;
    abstract public function execute();

    public function setParams($params = array()){
        $this->_params = $params;
    }

    protected function _checkTaskName(){
        $taskName = $this->_params['0'];

        if(!preg_match('/^[\w\d]{1,50}$/ie',$taskName)){
            throw new \Exception('Task\'s name include illegal character!');
        }

        if(!file_exists(TASKDIR.$taskName.'.php')){
            throw new \Exception('Task\'s file not exists!');
        }

        $this->_tName = $taskName;
    }

    /**
     * 分叉子进程
     * @throws \Exception
     */
    protected function beginFork(){
        //是父进程，父进程退出
        if (pcntl_fork() != 0) {
            exit();
        }

        //设置新会话组长，脱离终端
        posix_setsid();

        //是第一子进程，结束第一子进程
        if (pcntl_fork() != 0) {
            exit();
        }

        chdir("/");
        //获取进程id
        $pid = posix_getpid();
        $this->createPid($pid);
    }

    protected function createPid($pid){
        $pidFile = PIDS.$this->_tName;
        if(!$pid){
            throw new \Exception('PID error'.PHP_EOL);
        }

        if($this->checkPid() > 0){
            throw new \Exception($this->_tName.' is running'.PHP_EOL);
        }

        if(!is_dir(PIDS)){
            throw new \Exception("cannot create pid file");
        }


        $fp = fopen($pidFile, 'w');
        fwrite($fp,$pid);
        fclose($fp);
    }

    /**
     * 检查pid是否存在
     * @return int|string
     */
    public function checkPid(){
        $pidFile = PIDS.$this->_tName;
        if(file_exists($pidFile)){
            $pid = file_get_contents($pidFile);
            $pid = intval($pid);
            //给进程发送信息，检查进程是否活着
            if($pid > 0 && posix_kill($pid, 0)){
                return $pid;
            }
        }
        return 0;
    }

    public function getTName(){
        return $this->_tName;
    }
}