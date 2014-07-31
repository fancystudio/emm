$(document).ready(function(){

	direction = ['right','right','bottom'];
	var pfold = $('.uc-container').pfold( {
	folds : 4,
	perspective : 1200,
	folddirection : direction,
	speed : 2900,
	folddelay : 1,
	onEndFolding : function() { opened = false; },
	} );

	$(".sub-o-nas li a").click(function(){
		$(".podstranka").show();
		pfold.unfold();
	});
    $('.sq-1').plaxify({"xRange":20,"yRange":20, "invert":true})
    $('.sq-2').plaxify({"xRange":20,"yRange":20})
    $('.sq-3').plaxify({"xRange":20,"yRange":20, "invert":true})
    $('.sq-4').plaxify({"xRange":20,"yRange":20})
    $('.sq-5').plaxify({"xRange":20,"yRange":20, "invert":true})
    $('.sq-6').plaxify({"xRange":20,"yRange":20})
    $('.background').plaxify({"xRange":3,"yRange":3,"invert":true})
    $.plax.enable();
    	
	hasPerspective	= Modernizr.csstransforms3d;
	var par = true;
	if(hasPerspective){
		$(".te-wrapper").on({
			'webkitAnimationStart' : function( event ) {
				
			},
			'webkitAnimationEnd'   : function( event ) {
				$(".te-front").hide();
			}
		});
		$(".submenu-bezpecnost-is").on({
			'webkitAnimationStart' : function( event ) {
				console.log("zaciatok");
			},
			'webkitAnimationEnd'   : function( event ) {
				$(this).css("visibility","hidden");
			}
		});
		$(".submenu-it-riesenia").on({
			'webkitAnimationStart' : function( event ) {
				console.log("zaciatok");
			},
			'webkitAnimationEnd'   : function( event ) {
				$(this).css("visibility","hidden");
			}
		});
		$(".submenu-technicka-bezpecnost").on({
			'webkitAnimationStart' : function( event ) {
				console.log("zaciatok");
			},
			'webkitAnimationEnd'   : function( event ) {
				$(this).css("visibility","hidden");
			}
		});
		$(".submenu-aktuality").on({
			'webkitAnimationStart' : function( event ) {
				console.log("zaciatok");
			},
			'webkitAnimationEnd'   : function( event ) {
				$(".submenu-bezpecnost-is").hide();
				$(".submenu-it-riesenia").hide();
				$(".submenu-technicka-bezpecnost").hide();
				$(this).hide();
				$(".o-spolocnosti").addClass("active");
			}
		});
	}
	$(".ospol").click(function(){
		//$(".nav-level-3").show();
		//pfoldMenu.unfold();

		$(this).addClass("active");
		$(".te-transition").addClass("te-rotation4");
		$(".te-transition").addClass("te-show");
		if(par){
			$(".te-front").hide();
			$(".te-back").show();
			par = false;
		}else{
			$(".te-front").show();
			$(".te-back").hide();
			par = true;
		}
	});
	$(".sub-o-nas li").click(function(){
		$(".sub-o-nas li").removeClass("active");
		$(this).addClass("active");
		$(".submenu-bezpecnost-is").addClass("disable1");
		$(".submenu-it-riesenia").addClass("disable2");
		$(".submenu-technicka-bezpecnost").addClass("disable3");
		$(".submenu-aktuality").addClass("disable4");
	});


$(".disable1").on('webkitAnimationEnd', function(){ $(this).hide(); });

});


