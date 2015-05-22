# cphp
php守护进程管理框架

话说无需求，不编码。
因为最近需要编写rabbitmq的worker程序，处理订单数据，要求worker需要长期守护，
而且针对多个业务不只一个worker，所以有个想法写个worker的管理程序。

使用方法:
1、启动脚本
bin/php c.php start 脚本名
2、停止脚本
bin/php c.php stop 脚本名
3、查看脚本
bin/php c.php info 脚本名
4、列出所有脚本
bin/php c.php list 脚本名

在Tasks目录建立自己的脚本，继承CTask基类。
如有错误和问题可以敬请批评和指证
Email:981864142@qq.com
