var scroller = {
  init:   function() {
    //collect the variables
    scroller.docH = document.getElementById("sccontent").offsetHeight;
    scroller.contH = document.getElementById("sccontainer").offsetHeight;
    scroller.scrollAreaH = document.getElementById("scrollArea").offsetHeight-31;
      
    //calculate height of scroller and resize the scroller div
    //(however, we make sure that it isn't to small for long pages)
    //scroller.scrollH = (scroller.contH * scroller.scrollAreaH) / scroller.docH;
    //scroller.scrollH = (scroller.contH * scroller.scrollAreaH) / scroller.docH;
    
    //alert(scroller.docH);
    
    if(scroller.contH < scroller.docH){
    	scroller.scrollH = 16;
    }else{
    	scroller.scrollH = 15;
    }
    document.getElementById("scroller").style.height = Math.round(scroller.scrollH) + "px";
    
    //what is the effective scroll distance once the scoller's height has been taken into account
    scroller.scrollDist = Math.round(scroller.scrollAreaH-scroller.scrollH);
        
    //make the scroller div draggable
    Drag.init(document.getElementById("scroller"),null,0,0,-1,scroller.scrollDist);
    
    //add ondrag function
    if(scroller.scrollH > 15){
	    document.getElementById("scroller").onDrag = function (x,y) {
	      var scrollY = parseInt(document.getElementById("scroller").style.top);
	      var docY = 0 - (scrollY * (scroller.docH - scroller.contH) / scroller.scrollDist);
	      document.getElementById("sccontent").style.top = docY + "px";
	    }
    }

  }
}

function handle(delta) {
	var s = delta + ": ";
	if (delta < 0)
		s += "down";
	else
		s += "up";
	
	Drag.init(document.getElementById("scroller"),null,0,0,-1,scroller.scrollDist);	
	//alert(s);
}

function wheel(event){
	var delta = 0;
	if (!event) event = window.event;
	if (event.wheelDelta) {
		delta = event.wheelDelta/120; 
		if (window.opera) delta = -delta;
	} else if (event.detail) {
		delta = -event.detail/3;
	}
	if (delta)
		handle(delta);
}

/* Initialization code. */
if (window.addEventListener)
	window.addEventListener('DOMMouseScroll', wheel, false);
window.onmousewheel = document.onmousewheel = wheel;
