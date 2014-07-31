<?php
// errorCode <00301 - 00399>
class sql {
	// postreSQL
	var $allowedConnections;
	var $defaultConnection;
	var $selectedConnections;
	var $sqlConnection;

	function sql($con_name=null){
		$this->allowedConnections['emm']['type'] 		= 'pgSQL';
		$this->allowedConnections['emm']['cstring'] 	= 'dbname = emm-sk user=emm-sk password=ycTZaz17';
		//$this->allowedConnections['emm']['cstring'] 	= 'dbname = test8 user=test8 password=test8';
		
		$this->defaultConnection = 'emm';
		$this->sqlConnection = null;

		if ($con_name==null) { //ak nieje zadane meno pripojenia, pouzijem defaultne meno
			$this->selectedConnections = $this->defaultConnection;
		} else {
			// inak skontroluj ci je povolena konekcia
			if(array_key_exists($con_name, $this->allowedConnections)){
				$this->selectedConnections = $con_name;
			}else{
				return false;
			}
		}
		return true;
	}
	
	/**
 	* Vytvorenie spojenia na databazu podla mena spojenia, povolene spojenia musia byt v poli $allowedConnections
 	*
 	* @param string $con_name
 	* @return resource ID alebo false
 	*/
	function sql_connect(){
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		
		// vykonam a zapamatam si pripojenie
		switch ($allowedCon['type']){
			case 'pgSQL':
				$this->sqlConnection = pg_connect($allowedCon['cstring']);
				break;
			case 'MSSQL';
				$this->sqlConnection = mssql_connect($allowedCon['host'],$allowedCon['user'], $allowedCon['passwd']);
				break;
		}
		
		// vratim hodnotu z funkcie pre pripojenie
		return $this->sqlConnection;
	}

	/**
 	* Uzavretie spojenia s databazou podla mena spojenia
 	*
 	* @param string $con_name
 	* @return bool
 	*/
	function sql_close(){
		if ($this->sqlConnection==null OR $this->sqlConnection==false) {
			// ak nemam vytvorene spojenie nemam co zatvarat
			return true;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		
		$result = false;
		switch ($allowedCon['type']){
			case 'pgSQL':
				$result = pg_close($this->sqlConnection);
				break;
			case 'MSSQL';
				$result = mssql_close($this->sqlConnection);
				break;
		}
		
		if ($result!=false) {
			$this->sqlConnection = null;
		}
		
		return $result;
	}

	/**
 	* Spustenie poziadavky na SQL databazu
 	*
 	* @param string $query
 	* @param string $con_name
 	* @return resource alebo false
 	*/
	function sql_query($query){
		if($this->sqlConnection==false OR $this->sqlConnection==null){
			// ak nemam vytvorene spojenie, vytvorim ho
			if($this->sql_connect()==false)
				return false;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		
		switch ($allowedCon['type']){
			case 'pgSQL':
				return pg_query($this->sqlConnection, $query);
				break;
			case 'MSSQL';
				return mssql_query($query, $this->sqlConnection);
				break;
		}
	
		return false;
	}

	/**
 	* Zistenie poctu vratenych riadkov v SELECTe
 	*
 	* @param resource $result
 	* @param string $con_name
 	* @return int alebo -1 pri chybe
 	*/
	function sql_num_rows($result){
		if (!isset($result) OR $result==false) {
			return -1;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		switch ($allowedCon['type']){
			case 'pgSQL':
				return pg_num_rows($result);
				break;
			case 'MSSQL';
				return mssql_num_rows($result);
				break;
		}
	
		return -1;
	}

	/**
 	* Zistenie poctu upravenych riadkov pomocou INSERT, UPDATE, DELETE
 	*
 	* @param unknown_type $result
 	* @param unknown_type $con_name
 	* @return unknown
 	*/
	function sql_affected_rows($result){
		if (!isset($result) OR $result==false) {
			return -1;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		switch ($allowedCon['type']){
			case 'pgSQL':
				return pg_affected_rows($result);
				break;
			case 'MSSQL';
				return mssql_rows_affected($result);
				break;
		}
	
		return -1;
	}

	/**
 	* Vrati aktualny riadok zo zdroju a posuniu ukazatel na nasledujuci riadko
 	*
 	* @param resource $result
 	* @param string $con_name
 	* @return array alebo false ak niesu uz riadky
 	*/
	function sql_fetch_row($result){
		if (!isset($result) OR $result==false) {
			return false;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		switch ($allowedCon['type']){
			case 'pgSQL':
				return pg_fetch_array($result);
				break;
			case 'MSSQL';
				return mssql_fetch_row($result);
				break;
		}
	
		return false;
	}

	/**
 	* Nastavenie ukazovatela v resulte na zadany offset
 	*
 	* @param resource $result
 	* @param int $offset
 	* @param string $con_name
 	* @return bool
 	*/
	function sql_result_seek($result, $offset){
		if (!isset($result) OR $result==false OR !isset($offset) OR intval($offset)<0) {
			return false;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		switch ($allowedCon['type']){
			case 'pgSQL':
				return pg_result_seek($result, intval($offset));
				break;
			case 'MSSQL';
				return mssql_data_seek($result, intval($offset));
				break;
		}
	
		return false;
	}

	/**
 	* Uvolni result z pamati
 	*
 	* @param resource $result
 	* @param string $con_name
 	* @return bool
 	*/
	function sql_free_result($result){
		if (!isset($result) OR $result==false) {
			return false;
		}
	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		switch ($allowedCon['type']){
			case 'pgSQL':
				return pg_free_result($result);
				break;
			case 'MSSQL';
				return mssql_free_result($result);
				break;
		}
	
		return false;
	}

	function sql_select_db($database_name){
		if (!isset($database_name) OR $database_name=='') {
			return false;
		}

		if($this->sqlConnection==false OR $this->sqlConnection==null){
			// ak nemam vytvorene spojenie, vytvorim ho
			if($this->sql_connect()==false)
				return false;
		}

	
		$allowedCon = &$this->allowedConnections[$this->selectedConnections];	// zapamatam si nastavenia pre vybrane spojenie
		switch ($allowedCon['type']){
			case 'MSSQL';
				return mssql_select_db($database_name, $this->sqlConnection);
				break;
		}
	
		return false;
	}
}
?>
