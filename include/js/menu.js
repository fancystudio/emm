<!--//--><![CDATA[//><!--

	sfHover = function() {
		var sfEls = document.getElementById("nav").getElementsByTagName("LI");
		for (var i=0; i<sfEls.length; i++) {
			sfEls[i].onmouseover=function() {
				this.className+=" sfhover";
			}
			sfEls[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
			}
		}	
	}

	if (window.attachEvent) window.attachEvent("onload", sfHover);

//--><!]]>

	function go()
	{
		box = document.forms[0].navi;
		destination = box.options[box.selectedIndex].value;
		if (destination) location.href = destination;
	} 


    function changeImg(kategory, imageName){
		if(document.getElementById('picture'))
		if(document.getElementById('picture'))
			document.getElementById('picture').src='/pics/upload/system/design/'+kategory+'/big/'+imageName+'.jpg';
				
		if(document.getElementById('pictureDetail'))
			document.getElementById('pictureDetail').src='/pics/upload/system/design/'+kategory+'/detail/'+imageName+'.jpg';
		if(document.getElementById('contentDesign'))
			document.getElementById('contentDesign').style.backgroundImage = 'url(/pics/upload/system/'+kategory+'/background/'+imageName+'.jpg)';		
		return false;
	}
	
    function changeImg3(kategory, imageName){
		if(document.getElementById('picture'))
		if(document.getElementById('picture'))
			document.getElementById('picture').src='/pics/upload/system/design/'+kategory+'/big/'+imageName+'.jpg';
				
		if (imageName<15) {
			document.getElementById('pictureDetailDoplnky').src='/pics/system/a.jpg';
		}
		else {
			document.getElementById('pictureDetailDoplnky').src='/pics/system/b.jpg';
		}
			
		if(document.getElementById('pictureDetail'))
			document.getElementById('pictureDetail').src='/pics/upload/system/design/'+kategory+'/detail/'+imageName+'.jpg';
		if(document.getElementById('contentDesign'))
			document.getElementById('contentDesign').style.backgroundImage = 'url(/pics/upload/system/'+kategory+'/background/'+imageName+'.jpg)';		
		return false;
	}
	
	
	  function changeImg2(kategory, imageName){
		if(document.getElementById('picture'))
		if(document.getElementById('picture'))
			document.getElementById('picture').src='/pics/upload/system/materialy/'+kategory+'/big/'+imageName+'.jpg';
		if(document.getElementById('pictureDetail'))
			document.getElementById('pictureDetail').src='/pics/upload/system/materialy/'+kategory+'/detail/'+imageName+'.jpg';
		return false;
	}
	
