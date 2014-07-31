<?php
// errorCode <00101 - 00199>
include_once(DOCROOT.'/include/basic.class.php');

class template extends basic {
	var $pageObject;				// ukazovatel na objekt stranky
	var $templateName;				// nazov sablony
	var $templateContent;
	var $templateDir;				// adresar pre sablony
	var $_content;					// obsah suboru sablony
	var $_counter;					// ukazovatel znaku v subore
	var $_output;					// HTML vystup
	var $_vars=array();				// premenne dostupne v sablone
	var $_modules=array();			// zoznam modulov pre danu stranku
	var $_known_commands=array (
		"if"=>array(
			"name"=>"if",
			"start_tag"=>"if",
			"end_tag"=>"/if"
		),
		"module"=>array(
			"name"=>"module",
			"start_tag"=>"module",
			"end_tag"=>""
		),
	);	
	
	function template($_template=null, $_templateContent=null){
		$this->setTemplateDir();
		
		$this->setTemplate($_template);
	
		$this->_output = null;
		$this->templatePath = null;
	}
	
	function setTemplateDir($_templatedir=null){
		$templatedir = null;
		if($_templatedir==null AND defined('DEFAULTTEMPLATEDIR')){
			$templatedir = DEFAULTTEMPLATEDIR;
		} elseif($_templatedir!=null) {
			$templatedir = $_templatedir;
		}
		
		if($templatedir!=null AND is_dir(DOCROOT.'/'.$templatedir)){
			$oldVal = $this->templateDir;
			$this->templateDir = $templatedir;
			return $oldVal;
		}else{
			$this->templateDir = null;
			$this->_error('00102');
			return false;
		}
	}
	
	function getTemplateDir(){
		return $this->templateDir;
	}

	function setTemplate($_template=null){
		if($this->getTemplateDir() == null)
			return false;
			
		$template = null;
		if($_template==null AND defined('DEFAULTTEMPLATENAME')){
			$template = DEFAULTTEMPLATENAME;
		}elseif($_template!=null){
			$template = $_template;
		}
		
		if($template!=null AND is_file(DOCROOT.'/'.$this->getTemplateDir().'/'.$template.'.tpl.html')){
			$oldVal = $this->templateName;
			$this->templateName = $template;
			return $oldVal;
		}else{
			$this->templateName = null;
			$this->_error('00104');
			return false;
		}
	}
	
	function getTemplate(){
		return $this->templateName;
	}

	function getTemplateFullPath(){
		$templFullPath = DOCROOT.'/'.$this->getTemplateDir().'/'.$this->getTemplate().'.tpl.html';
		if($this->getTemplate()==null || $this->getTemplateDir()==null){
			$this->_error('00105');
			return false;
		}elseif(is_file($templFullPath)){
			return $templFullPath;
		}else {
			$this->_error('00106');
			return false;
		}
	}
	
	function setVar($varName=null, $varValue=null){
		if(array_key_exists($varName, $this->_vars) AND $varValue==null){
			// ak premenna uz existuje a varvalue je prazdne - vymazem premennu
			unset($this->_vars[$varName]);
		}elseif($varValue!=null){
			// ak premennna este neexistuje a hodnota nieje prazdna
			$this->_vars[$varName] = $varValue;
		}
	}
	
	function parse(){
		$this->_content = file_get_contents($this->getTemplateFullPath());
		if($this->_content===false){
			$this->_error('00107');
			return false;
		}
		
		$this->_counter = 0;
		$this->_output = '';
		$prev = ''; // predchadzajuci znak
		
		while (strlen($this->_content) > $this->_counter) {
			$char=$this->_content{$this->_counter};
			$this->_counter++;
			if ($char=="{" || $char=="}") {
				// ak narazim na zaciatocnu alebo koncovu znacku prikazu
				if ($prev=="\\") {
					// prislo mi \{, tj. prelozim ako { a ulozim do vysledku
					$this->_output[strlen($this->_output)-1] = $char;
				} else {
					if ($char=="{") {
						// prislo {, nasiel som zaciatok prikazu, musim ho najst cely a vykonat
						$this->_output .= $this->evalCommand($this->findCommandName('}'));
					} else {
						//prislo } bez spetneho lomitka, co je chyba, lebo } v prikaze sa spracuje vo findCommandName
						$this->_error('00107');
						$this->_output .= $char;
					}
				}
			} else {
				// standardny znak, len presuniem do vysledku
				$this->_output .= $char;
			}
			$prev=$char; // zapamatam si znak ako predosli
		}
	}
	
	function findCommandName($_end_char){
		$_result=""; // lokalna premenna pre vysledok hladania
		$end_string_char=""; // lokalna premenna pre chladanie konca retazca

		$prev=""; // pom. premenna pre predchadzajuci znak
		$continue=true; // ci ma cyklus pokracovat
		
		while ((strlen($this->_content) > $this->_counter) && ($continue) ) {
			$char=$this->_content{$this->_counter};
			$this->_counter++;
			
			if ($end_string_char=="") {
				//normalne citanie
				switch ($char) {
					case $_end_char: // nasiel som znak pre koniec prikazu
						$continue = false;
						break;
					case "\"": // znak pre retazec
					case "'": // znak pre retazec
						$end_string_char = $char;
						$_result .= $char;
						break;
					default: // standardny znak
						$_result .= $char; 
				}
			} else {
				// bol zaciatok retazca s uvodzovkami alebo apostrofom
				if ($char == $end_string_char) {
					if ($prev=="\\") {
						// bol predtym opacny apostrof, t.j. nie je ukoncenei retazca
					} else {
						$end_string_char="";
					}
					$_result .= $char;
				} else {
					$_result .= $char;
				}

			}
			$prev=$char;
		}
		if ($continue) {
			//skoncili sme preto ze je koniec kontextu a nie preto ze sme nasli hladany koniec!
			$this->_error('00108');
		}
		return $_result;
	}

	function evalCommand($command) {
		$commandName=false;
		$command = trim($command);
		//skusime ci to nahodou nie je prikaz + medzera paramatre
		if (preg_match('/^\s*([a-zA-Z0-9\_]+)(\s+[^\s]+.*)/is', $command, $reg)) {
			// prikaz s parametrom/ami
			$commandName=$reg[1]; // prikaz
			$params = $this->getParameters($reg[2]); // spracujem parametre
			if (!array_key_exists($commandName, $this->_known_commands)) {
				// ak dany prikza neexistuje
				$this->_error('00109');
				return '';
			}
		} else {
			//prikaz je bez parametrov
			if (array_key_exists($command, $this->_known_commands)) {
				// ak prikaz existuje
				$commandName = $command;
				$params=array();
			}
		}

		if ($commandName === false) {
			// ak prikaz neexistuje - vykonam ako premennu
			$result = $this->evalValue($command);
			return $result;
		} else {
			// ak prikaz existuje, spracujem ho
			$commandProp=$this->_known_commands[$commandName];
			if ($commandProp["end_tag"]!="") {
				// ak je povinny koncovy tag - hladame koncovy tag
				$contents = $this->contentOfEnclosedTag($commandProp["start_tag"], $commandProp["end_tag"]);
				
				// vykonam prikaz
				eval ('$result = $this->processTag_'.$commandProp["name"].'($params, $contents);');
				return $result;
			} else {
				// vykonam prikaz
				eval ('$result = $this->processTag_'.$commandProp["name"].'($params);');
				return $result;
			}
		}
	}

	function getParameters($paramString){
		$paramString = trim($paramString);
		$params = explode(" ",$paramString);
		for($i=0; $i<count($params); $i++){
			$params[$i] = trim($params[$i]);
		}
		
		return $params;
	}
	
	function contentOfEnclosedTag($start_tag, $end_tag) {
		$start_tag_p=0;
		$end_tag_p=0;
		$result="";
		$end_string_char="";
		$prev="";
		$continue=true;
		while ((strlen($this->_content) > $this->_counter) && ($continue) ) {
			$char=$this->_content{$this->_counter};
			$this->_counter++;
			if (($char == "{") || ($char == "}")) {
				if ($prev=="\\") {
					//prislo \{, prelozime ako {
					$result[strlen($result)-1]=$char;
				} else {
					if ($char == "{") {
						//prislo {, bude to teda nejaky prikaz
						$command=$this->findCommandName('}');
						if (substr(ltrim($command),0,strlen($end_tag)) == $end_tag) {
							//nasli sme koniec
							$continue=false;
						} else {
							// nenasiel som koniec hladaneho prikazu
							if (substr(ltrim($command),0,strlen($start_tag)) == $start_tag) {
								// nasli sme rovnaky zaciatok, teda musime najst jeho koniec a pokracovat
								$result .= "{".$command."}".$this->contentOfEnclosedTag($start_tag, $end_tag)."{".$end_tag."}";
								//$result .= $this->evalCommand($command);
							} else {
								// nasli sme nejaky prikaz, ale ten sme nehladali
								$result .= "{".$command."}";
							}
						}
					} else {
						//prislo } bez spetneho lomitka, len tak, to je chyba syntaxe
						$this->_error('00107');
						$result .= $char;
					}
				}
			} else {
				// ziadny specialny znak, presuniem znak do vystupu
				$result .= $char;
			}
			$prev=$char;
		}
		return $result;
	}

	function evalValue($value=null){
		$result = null;
		if(array_key_exists($value,$this->_vars)){
			eval('$result = $this->_vars[\''.$value.'\'];');
		}
		return $result;
	}
	
	function processTag_if($params, $content){
		/*return '
		<?
		$__eval_start = &$this;
		'.$this->evalValue($params["default"], &$this, false).'

		$switch = new AolSwitch(&$__pom2, \''.myAddSlashes($contents).'\');
		$switch->setVarPrefix("getParent().");
		$switch->setParent(&$this);
		pushInStack(&$this);
		print $switch->process();
		$this = popFromStack();
		?>';
		*/
	}
	
	function processTag_module($params=null){
		if($params==null OR !isset($params[0]) OR $params[0]=='' OR !isset($this->_modules[$params[0]])){
			$this->_error('00110');
			return false;
		}
		
		$moduleName = $this->_modules[$params[0]];
		
		if(is_dir(DOCROOT.'/'.MODULESDIR.'/'.$moduleName) AND is_file(DOCROOT.'/'.MODULESDIR.'/'.$moduleName.'/'.$moduleName.'.class.php')){
			include_once(DOCROOT.'/'.MODULESDIR.'/'.$moduleName.'/'.$moduleName.'.class.php');
			eval('$module = new '.$moduleName.'();');
			$module->templateObject = $this;
			$this->_output .= $module->getTHML();
		}else{
			$this->_error('00111');
			return false;
		}
	}
	
	function getHTML(){
		if($this->_output==null)	{
			$this->parse();
		}
		return $this->_output;
	}
}
?>