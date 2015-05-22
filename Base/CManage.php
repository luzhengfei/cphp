<?php
/**
 * Created by PhpStorm.
 * User: mahui
 * Date: 15/5/21
 * Time: 10:47
 */

namespace Base;

class CManage{
    private static $_me;
    private $_request;
    private function __construct(){}

    public static function &getInstance(){
        if(self::$_me == null){
            self::$_me = new self();
        }
        return self::$_me;
    }

    /**
     * @throws \Exception
     */
    public function run($config = array()){
        try {
            $this->_init();
            $this->_checkEnvironment();
            Cbase::$config = $config;

            $this->_request = Cbase::getRequest();
            //解析命令
            $this->_request->parse();

            $command = Cbase::getCommand($this->_request->getCommandName());
            $command->setParams($this->_request->getParams());
            $command->execute();
        }catch(\Exception $e){
            echo $e->getMessage(),PHP_EOL;
        }
    }

    private function _init(){
        if(DEBUG){
            error_reporting(E_ALL&E_NOTICE);
        }else{
            error_reporting(0);
        }

        date_default_timezone_set('Asia/ShangHai');
        set_time_limit(0);
    }

    private function _checkEnvironment(){
        if (!function_exists('pcntl_signal')) {
            throw new Exception('Need PCNTL extension');
        }

        //命令行下运行
        if (php_sapi_name() != "cli") {
            throw new Exception("only run in command line mode\n");
        }
    }

}