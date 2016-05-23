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