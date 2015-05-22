# cphp
php守护进程管理框架

话说无需求，不编码。
因为最近需要编写rabbitmq的worker程序，处理订单数据，要求worker需要长期守护，
而且针对多个业务不只一个worker，所以有个想法写个worker的管理程序。

在Tasks目录建立自己的脚本，继承CTask基类。
例如下方发送短信的worker
namespace Tasks;

class SendSms extends \Base\CTask{
    public function __construct(){
        parent::__construct();
    }

    public function run(){
        while(1){


            //任务开始----
            sleep(2);
            file_put_contents(DIR.DIRECTORY_SEPARATOR.'logs/ccc.log',date('Y-m-d H:i:s'),FILE_APPEND);
            //任务结束----


            //循环检查自身pid是否存在，如果不存在，杀掉自身线程
            $this->Checker();
        }

        //记录当前任务执行的状态，可根据自已要求定制数据格式。
        //$this->loger->record('dd','sdfdsf');
    }
}
