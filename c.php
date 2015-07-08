<?php
/**
 * Created by PhpStorm..
 * User: lzf
 * Date: 15/5/21
 * Time: 10:23
 */

define('DEBUG',false);
define('DIR',__DIR__);
define('BASE',DIR.DIRECTORY_SEPARATOR.'Base');
define('TASKDIR',DIR.DIRECTORY_SEPARATOR.'Tasks/');
define('PIDS',DIR.DIRECTORY_SEPARATOR.'pids/');

$config = array(
//    'redis' => array(
//        'host' => '127.0.0.1',
//        'port' => 6379
//    )
);

require_once BASE.'/CBase.php';
\Base\Cbase::getManage()->run($config);
