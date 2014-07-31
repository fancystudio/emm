<?php
function importantMessage($message){
	return '<div class="importantMessage">'.$message.'</div>';
}

function getCloseWinLink(){
	return '<p class="closqWin"><a href="" onclick="window.opener.location.reload(true);window.close();return(false);" class="darkLink">'._('Close window').'</a></p>';
}

function str2asci($str){
	$search = array (	
		'�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�',
		'�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�'
	);
	$replace = array(
		'A','C','D','E','E','I','N','O','R','S','T','U','U','Y','Z','L','L','A','R','O',
		'a','c','d','e','e','i','n','o','r','s','t','u','u','y','z','l','l','a','r','o'
	);
	return str_replace($search, $replace, $str);
}

function specUnit2readableHTML($specUnit=null){
	if($specUnit==null)
		return ;
	
	return eregi_replace('([0-9]+)','<sup>\\1</sup>',strtolower($specUnit));
}

function datetime2local($datetime=null, $onlyDate=false){
	
	if($datetime==null)
		return false;
	
	$datetimeParts = explode(" ",$datetime);
	
	if(count($datetimeParts)!=2)
		return false;
		
	$date = implode(".",array_reverse(explode("-",$datetimeParts[0])));
	$timeParts = explode(":",$datetimeParts[1]);
	while(list($key,$val)=each($timeParts)){
		$timeParts[$key] = intval($val);
	}
	$time = implode(":",$timeParts);
	
	if($onlyDate)
		return $date;
	else
		return $date.' '.$time;
}



?>