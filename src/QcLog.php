<?php

namespace Qc;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
*	MonoLog基于现有业务使用场景的简单封装
* 
*/
class QcLog
{

	public function __callStatic($name, $arguments){
		$dateFormat = config('qclog.dateFormat', 'Y-m-d H:i:s');
		$outputFormat = config('qclog.outputFormat', "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n");

		if(!empty(config("qclog.$name")) && $name !== 'dateFormat' && $name !== 'outputFormat'){
			if(!empty(config("qclog.$name.dateFormat"))){
				$dateFormat = config("qclog.$name.dateFormat");
			}

			if(!empty(config("qclog.$name.outputFormat"))){
				$outputFormat = config("qclog.$name.dateFormat");
			}

			$logger = new Logger($name);
     		$formatter = new LineFormatter($outputFormat, $dateFormat, false, false);
      		$stream = new StreamHandler(config("qclog.$name.file",storage_path() . '/logs/laravel.log'));
      		$stream->setFormatter($formatter);
			$logger->pushHandler($stream);

			return $logger;
		} else {
			$logger = new Logger('laravel');
			if (in_array($name, ['addInfo', 'addDebug', 'addNotice', 'addWarning','addEmergency', 'addAlert', 'addCritical', 'addError'])) {
        		$logger->pushHandler(new StreamHandler(storage_path() . '/logs/laravel.log'));
        		$logger->$name($arguments[0]);
			}else{
				throw new \Exception("别逗，这个方法不支持~", 1);
				
			}
		}

	}
}