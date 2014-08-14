<?php

class googleAnalytics extends basic {

	function googleAnalytics(){
	}

	function getCode() {

		$html ='<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9326604-1");
pageTracker._trackPageview();
} catch(err) {}</script>';

	return $html;
	}
	
	function getTHML(){

		$html = $this->getCode();
		
		
        return $html;
	}
}
?>
