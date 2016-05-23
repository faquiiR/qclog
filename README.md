## qclog
Monolog简单封装，可以方便的指定日志输出格式和日志路径。
### usage

拷贝`qclog.php`到`app\config`目录下，默认的配置如下：
```php
<?php

return [
  
  'dateFormat' => "Y-m-d H:i:s",  //时间格式
  'outputFormat' => "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n", //日志格式

  'userLog' => [
    //'file' => '/var/log/php/user.log',
    'dateFormat' => 'Y n j, g:i a'
  ],

  'goodsLog' => [
    'file' => '/var/log/php/goods.log'
  ],
  
];
```

'dateFormat'和'outputFormat'指定时间格式和日志输出格式。  
'userLog'和'goodsLog'里面配置的'dateFormat'和'outputFormat'会覆盖外层配置。
'file'配置日志输出的文件。

然后可以这样使用：
```php
use Qc\QcLog;

QcLog::userLog()->addInfo('hello');
QcLog::goodsLog()->addWarning('this goods is missing');
QcLog::addInfo('this message will be wirtten in storage/logs/laravel.log');
```
类似`addInfo`的方法有：
'addInfo', 'addDebug', 'addNotice', 'addWarning','addEmergency', 'addAlert', 'addCritical', 'addError'  

这些是monolog基础方法。

