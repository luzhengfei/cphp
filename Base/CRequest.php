<?php
/**
 * Created by PhpStorm.
 * User: mahui
 * Date: 15/5/21
 * Time: 11:03
 */

namespace Base;

class CRequest{
    private $commandMap;
    private $_commandName;
    private $_params;

    public function parse(){
        global $argc,$argv;

        if($argc <= 1){
            throw new \Exception('Please given params!'.PHP_EOL);
        }

        if(!isset(Cbase::$coreCommandMap[$argv[1]])){
            throw new \Exception('Command not exists!'.PHP_EOL);
        }

        $this->_commandName = $argv[1];
        $this->_params = array_slice($argv,2,count($argv));
    }

    public function getCommandName(){
        return $this->_commandName;
    }

    public function getParams(){
        return $this->_params;
    }
}