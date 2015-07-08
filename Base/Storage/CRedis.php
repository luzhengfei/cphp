<?php
/**
 * Created by PhpStorm..
 * User: lzf
 * Date: 15/5/21
 * Time: 18:15
 */

namespace Base\Storage;

use Base\Cbase;

class CRedis extends \Base\CLogger{

    public function connect(){
        $this->db = new Redis();
        $this->db->connect(Cbase::$config['redis']['hosts'],Cbase::$config['redis']['port'])or die('RDMEM ERROR');
    }

    public function record($key,$data){
        $this->db->hMset($key,$data);
    }
}