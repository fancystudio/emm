<?php
include_once(DOCROOT.'/include/config.inc.php');

class basic {
	var $errorCode;					// chybovy kod
	var $errorMessage;				// chybova sprava

	function _error($_errorCode='00000'){
		$this->errorCode = $_errorCode;
		$this->errorMessage = _($this->errorCode);

		if(DEBUG==1)
			echo "(".$this->errorCode.") ".$this->errorMessage."<br>";
	}
	
	function vardump(&$var){
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
	
	function getModuleName(){
		global $modules, $progModules;
		$className = get_class($this);
		
		while (list($key,$val)=each($modules)){
			if(strtolower($val['name']) == $className)
				return $val['menutext'];
		}
		
		while (list($key,$val)=each($progModules)){
			if(strtolower($val['name']) == $className)
				return $val['menutext'];
		}

		return false;
	}
}

?>