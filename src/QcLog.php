<?php

namespace Qc;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
* 
*/
class QcLog
{

	public function __call($name, $arguments){
		$dateFormat = config('qclog.dateFormat', 'Y-m-d H:i:s');
		$outputFormat = config('qclog.outputFormat', '[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n');

		if(!empty(config("qclog.$name")) && $name !== 'dateFormat' && $name !== 'outputFormat'){
			if(!empty(config("qclog.$name.dateFormat"))){
				$dateFormat = config("qclog.$name.dateFormat");
			}

			if(!empty(config("qclog.$name.outputFormat"))){
				$outputFormat = config("qclog.$name.dateFormat");
			}

			$logger = new Logger($name);
			$logger->pushHandler(new StreamHandler(config("qclog.$name.file"), storage_path() . '/logs/laravel.log'));

			return $logger;
		} else {
			$logger = new Logger;
			if (in_array($name, ['addInfo', 'addDebug', 'addNotice', 'addWarnning','addEmergency', 'addAlert', 'addCritical', 'addError'])) {
				$logger->$name($arguments[0]);
			}else{
				throw new Exception("别逗，这个方法不支持~", 1);
				
			}
		}

	}
}