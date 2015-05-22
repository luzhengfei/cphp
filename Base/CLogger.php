<?php
/**
 * Created by PhpStorm.
 * User: mahui
 * Date: 15/5/21
 * Time: 18:10
 */

namespace Base;

class CLogger{
    protected $db;

    public function connect(){

    }

    public function record($key,$data){
        throw new \Exception('Un support record!'.PHP_EOL);
    }
}