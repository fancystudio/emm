<?php
function smarty_function_js_init($params, &$template)
{
	?>
	<script type="text/javascript">
	var actualLang = "sk";
	var hasPerspective = Modernizr.csstransforms3d;
	var hasIndexBoxesShow = true;
	var hasSubpageShow = false;
	var contentIsLoad = false;
	var contentId = 0;
	var actualFirstLevelMenu = "";
	var $oldFirstLevelMenu = null;
	var oldContentAlias = "";
	var actualThirdLevelAlias = "";
	var oldThirdLevelAlias = "";
	var actualTypeOfContent = "content";
	var verticalCubesCount = 0;
	var hasFourCubesHorizontal = false;
	var actualHasFourCubesHorizontal = false;
	var onlyOneRow = false;
	var oldVerticalCubesCountThirdMenu = 0;
	var animationInProgress = false;
	var animationSpeedPerCube = 170;
	var isBezpecnostIs = true;
	var submenuItRiesenia = true;
	var submenuTechnickaBezpecnost = true;
	var submenuAktuality = true;
	var isSafary = false;
	var isFirefox = false;
	var isIExplorer = false;
	var ieVer = 0;
	$(document).ready(function(){
		activeMenuFirstLevelTransition = false;
		$(".submenu-aktuality li a,.bx-archiv").click(function(){
			if(!animationInProgress){	
				zobrazNovinku(this);
			}
		});
		  isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
		  isIExplorer = isIE();
		  if(isIExplorer){
			  ieVer = ieVersion();
			  if(ieVer >= 10){
				$("body").addClass("ie" + ieVer);
			  }
		  }
		  ua = navigator.userAgent.toLowerCase(); 
		  if (ua.indexOf('safari') != -1) { 
		    if (ua.indexOf('chrome') > -1) {
		    } else {
		    	isSafary = true;
		    	hasPerspective = true;
		    }
		  }

			$(".main-menu li a,.menuThirdLevelBuild li a,.index-boxes.not-news li a, .fakeContent .newpage, .selflink").click(function(){
				if(!animationInProgress){
					window.location.hash = "";
					if(!hasIndexBoxesShow && !$(".submenu-aktuality").hasClass("disable4")){
						$(".submenu-aktuality").removeClass("enable4");
						$(".submenu-aktuality").addClass("disable4");
					}
					if(hasPerspective){
						animationInProgress = true;
					}
					if($(this).attr("has_child") == 1){
					if(hasPerspective){
						if(contentIsLoad){
							hideOldContent("none",null,hasFourCubesHorizontal,null);
						}
						if($(this).parents("ul").hasClass("firstLevel")){
							animationInProgress = false;
							if(oldThirdLevelAlias != ""){
								hideThirdLevelMenu(null,oldThirdLevelAlias,null,oldVerticalCubesCountThirdMenu);
							}
							isActiveMenu = $(".firstLevel li a.active").length;
							$(".firstLevel li a,.firstLevel li,.secondLevel li").removeClass("active");
							$("." + $(this).attr("class") + ".te-transition").addClass("te-rotation4");
							$("." + $(this).attr("class") + ".te-transition").addClass("te-show");
							if(actualFirstLevelMenu == ''){ 
								//pokial sa prvy krat po nacitani DOM stlaci prvok z menu tak sa vysunie a nastavi ako aktualny
								$("." + $(this).attr("class") + ".te-front").hide();
								$("." + $(this).attr("class") + ".te-back").show();
								$oldFirstLevelMenu = $(this);
								actualFirstLevelMenu = $(this).attr("class");
								$(this).addClass("active");
								$(this).parent().addClass("active");
							}else if(actualFirstLevelMenu != '' && actualFirstLevelMenu == $(this).attr("class")){
								if(isActiveMenu){
									//pokial sa stlaci opat aktualny prvok menu a prvok je vysunuty tak sa len zasunie - skryje
									if(isFirefox || isIE()){
										$("." + $(this).attr("class")).removeClass("te-rotation4");
										$("." + $(this).attr("class")).removeClass("te-show");
										animationInProgress = false;				
									}
									$("." + $(this).attr("class") + ".te-front").show();
									$("." + $(this).attr("class") + ".te-back").hide();
								}else{
									//pokial sa stlaci opat aktualny prvok menu a prvok nie je vysunuty tak sa vysunie
									$("." + $(this).attr("class") + ".te-front").hide();
									$("." + $(this).attr("class") + ".te-back").show();
									$(this).addClass("active");
									$(this).parent().addClass("active");
									if(isFirefox){
										animationInProgress = false;				
									}
								}
							}else{
								//pokial je otvorene nejake menu druhej urovne a stlaci sa iny prvok z menu prvej urovne, podmenu sa zasunie a vysunie stlacene podmenu 
								if(isActiveMenu){
									if(isFirefox || isIE()){
										$("." + actualFirstLevelMenu).removeClass("te-rotation4");
										$("." + actualFirstLevelMenu).removeClass("te-show");
										animationInProgress = false;			
									}
									//pokial je vysunute nejake ine menu druhej urovne treba ho najprv skryt
									$("." + actualFirstLevelMenu + ".te-front").show();
									$("." + actualFirstLevelMenu + ".te-back").hide();
								}
								$("." + $(this).attr("class") + ".te-front").hide();
								$("." + $(this).attr("class") + ".te-back").show();
								actualFirstLevelMenu = $(this).attr("class");
								$(this).addClass("active");
								$(this).parent().addClass("active");
							}
						}else if($(this).parents("ul").hasClass("secondLevel")){
							
							if(hasIndexBoxesShow){
								
								hideIndexBoxes();
								hasIndexBoxesShow = false;
								actualThirdLevelAlias = $(this).attr("class");
								actualTypeOfContent = "menu";
								animateThirdLevel(actualThirdLevelAlias);
							}else{
								animateThirdLevel($(this).attr("class"));
								//TODO
							}
							$(".secondLevel li").removeClass("active");
							$(this).parent().addClass("active");
						}
					}else{
						if(contentIsLoad){
							hideOldContent("none",null,hasFourCubesHorizontal,null);
						}
						if($(this).parents("ul").hasClass("secondLevel")){
							if(hasIndexBoxesShow){
								hideIndexBoxes();
								hasIndexBoxesShow = false;
								actualThirdLevelAlias = $(this).attr("class");
								actualTypeOfContent = "menu";
								animateThirdLevel($(this).attr("class"));
							}else{
								animateThirdLevel($(this).attr("class"));
							}
							$(".secondLevel li").removeClass("active");
						}
						if($(this).parents("ul").hasClass("firstLevel")){
							if(oldThirdLevelAlias != ""){
								hideThirdLevelMenu(null,oldThirdLevelAlias,null,oldVerticalCubesCountThirdMenu);
							}
							isActiveMenu = $(".firstLevel li a.active").length;
							$(".firstLevel li a,.firstLevel li,.secondLevel li").removeClass("active");
							$(".firstLevel li a").removeClass("active");
							if(!isActiveMenu){
								$("." + $(this).attr("class") + ".te-front").hide();
								$("." + $(this).attr("class") + ".te-transition").addClass("te-show").hide().fadeIn(500);
								actualFirstLevelMenu = $(this).attr("class");
							}else{
								if(actualFirstLevelMenu != $(this).attr("class")){
									$("." + actualFirstLevelMenu + ".te-transition").removeClass("te-show").hide().fadeOut(500);
									$("." + $(this).attr("class") + ".te-front").hide();
									$("." + $(this).attr("class") + ".te-transition").addClass("te-show").hide().fadeIn(500);
									actualFirstLevelMenu = $(this).attr("class");
								}
							}
							$(this).addClass("active");
							$(this).parent().addClass("active");
						}
						animationInProgress = false;
					}
				}else{ // pokial menu nema potomkov tak sa vysunie obsah podstranky zavolanim ajaxu
					rollNewPage(this,'menulink');
				}
			}
		});
		
		slider = $('.submenu-aktuality .novinky').bxSlider({
		      easing: 'linear',
		      speed: 1000,
		      adaptiveHeight: false,
		      pager: false,
		      controls: false,
		      hideControlOnEnd: false,
		      infiniteLoop: false
		  });
		  $("#slider-prev").click(function(event){
			  slider.goToPrevSlide();
			  if(slider.getCurrentSlide() == 0){
				$("#slider-prev").addClass("inactive");
			  }
			  $("#slider-next").removeClass("inactive");
			  
		  });
		  $("#slider-next").click(function(){
			  slider.goToNextSlide();
			  if(slider.getSlideCount() != (slider.getCurrentSlide()-1)){
			  	$("#slider-next").addClass("inactive");  	
			  }
			  $("#slider-prev").removeClass("inactive");
		  });
		
		$(".menuSecondLevel .te-front").on('webkitAnimationEnd MSAnimationEnd oAnimationEnd', function( event ) {
			$(this).parent().removeClass("te-rotation4");
			$(this).parent().removeClass("te-show");
		});

		$(".logo").click(function(){ //ked sa klikne na hlavne logo tak sa vysunu index boxi a skryje obsah
			if(!animationInProgress && !hasIndexBoxesShow){
				window.location.hash = "";
				hasIndexBoxesShow = true;
				if(hasPerspective){
					animationInProgress = true;
				}
				if(contentIsLoad && $(".boxHorizontal").css("visibility") != "hidden"){
					hideOldContent("index-boxes",null,hasFourCubesHorizontal,null);
				}
				if((oldThirdLevelAlias != "" && $("." + oldThirdLevelAlias + " .third-level-menu-box-1").css("visibility") == "visible") || $(".boxHorizontal").css("visibility") == "hidden"){
					if(oldThirdLevelAlias != ""){
						hideThirdLevelMenu(null,oldThirdLevelAlias,null,oldVerticalCubesCountThirdMenu);
					}
					if($("." + oldThirdLevelAlias + " .third-level-menu-box-1").css("visibility") == "visible"){
						hideOldContent("index-boxes",null,hasFourCubesHorizontal,null);
					}else{
						showIndexBoxes();
					}
					
				}
			}
		});
		
		//akcie pri prepnuti jazyku
		$(".language a").click(function(){
			if(!animationInProgress){
				if($(this).parent().attr('class').split(' ')[0] != actualLang){
					slider.goToSlide(0);
					isReloaded = false;
					actualLang = $(this).parent().attr('class').split(' ')[0];
					$(".submenu-aktuality li").fadeOut(500,function(event){
						if($(this).find('a').attr("name_" + actualLang) != ""){
							$(this).find('a').html($(this).find('a').attr("name_" + actualLang)).hide().fadeIn(500,function(){
								if(!isReloaded ){
									slider.reloadSlider();
									isReloaded = true;
								}
							});
							$(this).fadeIn(500);
						}
			        });
					$(".firstLevel li a,.secondLevel li a,.menuThirdLevelBuild li a").fadeOut(500,function(event){
						if($(this).parents('.submenu-aktuality').length){
							if($(this).find('a').attr("name_" + actualLang) != ""){
								$(this).find('a').html($(this).find('a').attr("name_" + actualLang)).hide().fadeIn(500);
								$(this).fadeIn(500);
							}
						}else{
							$(this).html($(this).attr("name_" + actualLang)).hide().fadeIn(500);
						}
			        });
					if(contentId != 0 && $(".containerHorizontal .podstranka").css("visibility") == "visible"){ 
						showNewContent(contentId,false,((actualTypeOfContent == "news") ? true : false )); // prehodenie obsahu na druhy jazyk
					}
					$(".submenu-bezpecnost-is .forFade").fadeOut(500,function(){
		        		$(this).html($(".fakeIndexBoxes .box_one_" + actualLang).html()).hide().fadeIn(500);
			        });
					$(".submenu-it-riesenia .forFade").fadeOut(500,function(){
		        		$(this).html($(".fakeIndexBoxes .box_two_" + actualLang).html()).hide().fadeIn(500);
			        });
					$(".submenu-technicka-bezpecnost .forFade").fadeOut(500,function(){
		        		$(this).html($(".fakeIndexBoxes .box_three_" + actualLang).html()).hide().fadeIn(500);
			        });
				}
			}
		});

		$(".te-transition").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function(event) {  
			//animationInProgress = false;
		});
		$('.sq-1').plaxify({"xRange":20,"yRange":20, "invert":true})
	    $('.sq-2').plaxify({"xRange":20,"yRange":20})
	    $('.sq-3').plaxify({"xRange":20,"yRange":20, "invert":true})
	    $('.sq-4').plaxify({"xRange":20,"yRange":20})
	    $('.sq-5').plaxify({"xRange":20,"yRange":20, "invert":true})
	    $('.sq-6').plaxify({"xRange":20,"yRange":20})
	    $('.background').plaxify({"xRange":3,"yRange":3,"invert":true})
	    $.plax.enable();


		$(".submenu-bezpecnost-is").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function( event ) {
			$(this).css("visibility",(isBezpecnostIs ? "hidden" : "visible"));
			isBezpecnostIs = (isBezpecnostIs ? false : true);
		});
		$(".submenu-it-riesenia").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function( event ) {
			$(this).css("visibility",(submenuItRiesenia ? "hidden" : "visible"));
			submenuItRiesenia = (submenuItRiesenia ? false : true);
		});
		$(".submenu-technicka-bezpecnost").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function( event ) {
			isAktualityVisible = $(".submenu-aktuality").css("visibility") == "visible";
			$(this).css("visibility",(submenuTechnickaBezpecnost ? "hidden" : "visible"));
			submenuTechnickaBezpecnost = (submenuTechnickaBezpecnost ? false : true);
			if(!submenuTechnickaBezpecnost){
				if(actualTypeOfContent == "news" && submenuAktuality){
					hasIndexBoxesShow = false;
					$(".submenu-bezpecnost-is").hide();
					$(".submenu-it-riesenia").hide();
					$(".submenu-technicka-bezpecnost").hide();
					$(".submenu-aktuality").css("left","696px");
					getContent(contentId,hasFourCubesHorizontal,true); // zobrazenie obsahu
				}
			}else{
				hasIndexBoxesShow = true;
				if(submenuAktuality){
					animationInProgress = false;
				}
			}
		});
		$(".submenu-aktuality").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function( event ) {
			if(submenuAktuality){
				canNotShowContent = $(".submenu-bezpecnost-is").css("display") == "none";
				$(".submenu-bezpecnost-is").hide();
				$(".submenu-it-riesenia").hide();
				$(".submenu-technicka-bezpecnost").hide();
				$(this).hide();
				$(this).css("left","0px");
				$(this).css("visibility",(submenuAktuality ? "hidden" : "visible"));
				submenuAktuality = (submenuAktuality ? false : true);
				if(actualTypeOfContent == "content" && !canNotShowContent){
					getContent(contentId,hasFourCubesHorizontal,((actualTypeOfContent == "news") ? true : false)); // zobrazenie obsahu
				}
				else if(actualTypeOfContent == "menu"){
					animateThirdLevel(actualThirdLevelAlias);
				}
			}else{
				$(this).css("visibility","visible");
				submenuAktuality = true;
				animationInProgress = false;
				hasIndexBoxesShow = true;
				$(".main-menu li a,.main-menu li,.menuThirdLevelBuild li a,.menuThirdLevelBuild li").removeClass("active");
			}
		});
		showSubPageByHash();
	});
	function rollNewPage(object,linktype){
		if($(object).attr("content_id") != -1){
			actualTypeOfContent = "content";
			if(contentId == $(object).attr("content_id")){
				animationInProgress = false;
			}
			if(!hasPerspective){
				if($(object).attr("class") == "kontakt"){
					$(".animacia").css("margin-left","464px");
				}else{
					$(".animacia").css("margin-left","696px");
				}
			}
			oldContentAlias = $(object).attr("class");
			if($(object).parents("ul").hasClass("firstLevel") || linktype == "selflink"){
				isActiveMenu = $(".firstLevel li a.active").length;
				if(isActiveMenu){
					if(hasPerspective){
						//pokial je vysunute nejake ine menu druhej urovne treba ho najprv skryt
						if(isFirefox || isIE()){
							$("." + actualFirstLevelMenu).removeClass("te-rotation4");
							$("." + actualFirstLevelMenu).removeClass("te-show");
							animationInProgress = false;			
						}
						$("." + actualFirstLevelMenu + ".te-front").show();
						$("." + actualFirstLevelMenu + ".te-back").hide();
					}else{
						$("." + actualFirstLevelMenu + ".te-transition").removeClass("te-show").hide().fadeOut(500);
					}
					$(".firstLevel li a,.firstLevel li,.secondLevel li").removeClass("active");
					actualFirstLevelMenu = $(object).attr("class");
					$(object).parent().addClass("active");
				}
			}
			if(oldThirdLevelAlias != "" && !$(object).parents("ul").hasClass("thirdLevel")){
				hideThirdLevelMenu(null,oldThirdLevelAlias,null,oldVerticalCubesCountThirdMenu);
			}
			if($(object).parents("ul").hasClass("secondLevel")){
				$(".secondLevel li").removeClass("active");
			}
			if($(object).parents("ul").hasClass("thirdLevel")){
				$(".thirdLevel li").removeClass("active");
			}
			if($(object).attr("class") == "kontakt"){
				hasFourCubesHorizontal = true;
			}else{
				hasFourCubesHorizontal = false;
			}
			if(!hasIndexBoxesShow && (contentId != $(object).attr("content_id") || (hasPerspective ? $(".containerHorizontal .podstranka").css("visibility") != "visible" : $(".containerHorizontal").is(':empty')))){			
				showNewContent($(object).attr("content_id"),hasFourCubesHorizontal,false);//zmiznutie 4 boxov na indexe
			}
			if(hasIndexBoxesShow){
				hideIndexBoxes();//zmiznutie 4 boxov na indexe
				hasIndexBoxesShow = false;
			}
			contentId = $(object).attr("content_id");
			
			if($(object).parents("ul").hasClass("thirdLevel")){
				$(".thirdLevelSubmenu a[content_id='" + contentId + "']").parent().addClass("active");
				$('html,body').animate({scrollTop: $("body").offset().top},'slow');
			}
			$(object).parent().addClass("active");
		}else{
			animationInProgress = false;
		}
	}
	function sendForm(object){
		$(".alert").empty();
		emptyValue = "";
		if($(object).parents("form").find(".nazovFirmy").val() == ""){
			emptyValue += ((actualLang == "sk") ? "Názov firmy" : "Company Name");
		}
		if($(object).parents("form").find(".vyrobneCislo").val() == ""){
			emptyValue += (emptyValue != "" ? ", " : "") + ((actualLang == "sk") ? "Výrobné číslo" : "Product number");
		}
		if($(object).parents("form").find(".nahlasovatel").val() == ""){
			emptyValue += (emptyValue != "" ? ", " : "") + ((actualLang == "sk") ? "Nahlasovateľ" : "Nahlasovateľ");
		}
		if($(object).parents("form").find(".telFax").val() == ""){
			emptyValue += (emptyValue != "" ? ", " : "") + ((actualLang == "sk") ? "Tel, fax" : "Tel, fax");
		}
		if($(object).parents("form").find(".prijemca").val() == "Vyberte si príjemcu"){
			emptyValue += (emptyValue != "" ? ", " : "") + ((actualLang == "sk") ? "Príjemca" : "Reciever");
		}
		if(emptyValue != ""){
			$(".alert").html("Nie sú vzplnené nasledovné povinné polia: " + emptyValue);//vypisat dakam
		}else{
			vpb_submit_captcha();
		}
	}
	function zobrazNovinku(object){
		if(contentId != $(object).attr("news_id") && !((contentId == -1) && ($(object).attr("class") == "bx-archiv"))){
			if(hasPerspective){	
				if($(".firstLevel li a.active").length){
					if(isFirefox || isIE()){
						$("." + actualFirstLevelMenu).removeClass("te-rotation4");
						$("." + actualFirstLevelMenu).removeClass("te-show");
						animationInProgress = false;			
					}
					$("." + actualFirstLevelMenu + ".te-front").show();
					$("." + actualFirstLevelMenu + ".te-back").hide();
				}
			}else{
				if(actualFirstLevelMenu != ""){
					$("." + actualFirstLevelMenu + ".te-transition").removeClass("te-show").hide().fadeOut(500);
				}
			}
			$(".firstLevel li a,.firstLevel li,.secondLevel li").removeClass("active");
			if($(object).attr("class") == "bx-archiv"){
				getLinkToSubPage("newsArchive", null);
				contentId = -1;
			}else{
				getLinkToSubPage("news", $(object).attr("news_id"));
				contentId = $(object).attr("news_id");
			}
			actualTypeOfContent = "news";
			hasFourCubesHorizontal = false;
			if(!hasIndexBoxesShow){
				hideOldContent("content",contentId,hasFourCubesHorizontal,true);
			}else{
				isNews = true;
				hasIndexBoxesShow = false;
				hideIndexBoxes();
			}
		}
	}
	function showIndexBoxes(){
		if(oldThirdLevelAlias != ""){
			hideThirdLevelMenu(null,oldThirdLevelAlias,null,oldVerticalCubesCountThirdMenu);
		}
		$(".submenu-aktuality").css("left","0px");
		if(hasPerspective){
			animationInProgress = true;
		}
		if($(".firstLevel li a.active").length){
			if(isFirefox || isIE()){
				$("." + actualFirstLevelMenu).removeClass("te-rotation4");
				$("." + actualFirstLevelMenu).removeClass("te-show");	
			}
			$("." + actualFirstLevelMenu + ".te-front").show();
			$("." + actualFirstLevelMenu + ".te-back").hide();
		}
		if(hasPerspective){
			$(".submenu-bezpecnost-is").removeClass("disable1");
			$(".submenu-bezpecnost-is").addClass("enable1");
			$(".submenu-bezpecnost-is").css("display","block");
			$(".submenu-it-riesenia").removeClass("disable2");
			$(".submenu-it-riesenia").addClass("enable2");
			$(".submenu-it-riesenia").css("display","block");
			$(".submenu-technicka-bezpecnost").removeClass("disable3");
			$(".submenu-technicka-bezpecnost").addClass("enable3");
			$(".submenu-technicka-bezpecnost").css("display","block");
			if(!submenuAktuality){
				$(".submenu-aktuality").removeClass("disable4");
				$(".submenu-aktuality").addClass("enable4");
				$(".submenu-aktuality").css("display","block");
			}
		}else{
			$(".submenu-bezpecnost-is, .submenu-it-riesenia, .submenu-technicka-bezpecnost,.submenu-aktuality").fadeIn(500);
			hasIndexBoxesShow = true;		
		}
	}
	function showNewContent(content_id,hasFourCubesHorizontal,isNews){
		getContent(content_id,hasFourCubesHorizontal,isNews);
	}
	
	function hideIndexBoxes(){
		if(hasPerspective){
			animationInProgress = true;
			$(".submenu-bezpecnost-is").removeClass("enable1");
			$(".submenu-bezpecnost-is").addClass("disable1");
			$(".submenu-it-riesenia").removeClass("enable2");
			$(".submenu-it-riesenia").addClass("disable2");
			$(".submenu-technicka-bezpecnost").removeClass("enable3");
			$(".submenu-technicka-bezpecnost").addClass("disable3");
			if(actualTypeOfContent != "news"){
				$(".submenu-aktuality").removeClass("enable4");
				$(".submenu-aktuality").addClass("disable4");
			}
		}else{
			$(".submenu-bezpecnost-is, .submenu-it-riesenia, .submenu-technicka-bezpecnost").fadeOut(500, function(){
				if(actualTypeOfContent == "news"){
					$(".submenu-aktuality").css("left","696px");
					getContent(contentId,hasFourCubesHorizontal,((actualTypeOfContent == "news") ? true : false)); // zobrazenie obsahu
				}
			});
			if(actualTypeOfContent != "news"){
				$(".submenu-aktuality").fadeOut(500, function(){
					getContent(contentId,hasFourCubesHorizontal,((actualTypeOfContent == "news") ? true : false)); // zobrazenie obsahu
				});
			}
			hasIndexBoxesShow = false;
		}
	}
	function getContent(content_id,hasFourCubesHorizontal,isNews){
		if(contentIsLoad && $(".boxHorizontal").css("visibility") != "hidden"){
			hideOldContent("content",content_id,hasFourCubesHorizontal,isNews); //parameter true pre zobrazenie index boxov po skryti obsahu
		}else{
			if(!isNews){
				if(content_id == 65){
					getLinkToSubPage("history", null);
				}else{
					getLinkToSubPage("content", content_id);
				}
			}
			if(hasPerspective){
				$( ".animacia .containerHorizontal" ).load( "lib/getContent.php", 
					{ 
						content_id : content_id, 
						type: "horizontal",
						cubesCount : null,
						lang : actualLang,
						get_content : true,
						fourCubesHorizontal : hasFourCubesHorizontal,
						isNews : isNews,
						hasPerspective : hasPerspective  
					}, function( response, status, xhr ) {
						if(status == "success"){
							generateSelflink(this);
							checkIfHorizontalContentIsReady(content_id,hasFourCubesHorizontal,isNews);
							contentIsLoad = true;
						}
					} 
				);
			}else{
				$( ".animacia .containerHorizontal" ).load( "lib/getContent.php", 
					{ 
						content_id : content_id, 
						type: "horizontal",
						cubesCount : null,
						lang : actualLang,
						get_content : true,
						fourCubesHorizontal : hasFourCubesHorizontal,
						isNews : isNews,
						hasPerspective : hasPerspective   
					}, function( response, status, xhr ) {
						if(status == "success"){
							generateSelflink(this);
							heightCeil = Math.ceil($( ".animacia .containerHorizontal .podstranka" ).height()/232);
							$( ".animacia .containerHorizontal .podstranka" ).css("height",heightCeil*232 + "px");
							contentIsLoad = true;
						}
					} 
				);
			}
		}
	}

	function checkIfHorizontalContentIsReady(content_id,hasFourCubesHorizontal,isNews){
		setTimeout(function(){
			if(content_id == -1){ //pri archive noviniek zistenie najvacsieho obsahu zpomedzi rokov a nastavenie sirky podla toho
				contentHeight = 0;
				$( ".archiveYear ul" ).each(function( index ) {
				  if($( this ).height() > contentHeight){
					  contentHeight = $( this ).height();
				  }
				});
				contentHeight += 130;
			}else if(content_id == 65){
				contentHeight = 0;
				$( ".archiveYear .historyYearContent" ).each(function( index ) {
				  if($( this ).height() > contentHeight){
					  contentHeight = $( this ).height();
				  }
				});
				contentHeight += 170;
			}else{
				contentHeight = $(".containerHorizontal .text").height();
			}
			if(contentHeight > 0){
				if(contentHeight > 232){
					loadVerticalContent(contentHeight,content_id,hasFourCubesHorizontal,isNews);
				}else{
					onlyOneRow = true;
					showHorizontalAnimation(hasFourCubesHorizontal,true);
				}	
			}else{
				checkIfHorizontalContentIsReady(content_id,hasFourCubesHorizontal,isNews);
			}
		},50);
	}

	function checkIfVerticalContentIsReady(verticalCubesCount,hasFourCubesHorizontal){
		setTimeout(function(){
			if($(".containerVertical .text").height() > 0){
				showAnimation(verticalCubesCount,hasFourCubesHorizontal);	
			}else{
				checkIfVerticalContentIsReady(verticalCubesCount,hasFourCubesHorizontal);
			}
		},50);
	}

	function loadVerticalContent(contentHeight,content_id,hasFourCubesHorizontal,isNews){
		verticalCubesCount = Math.ceil(contentHeight/232)-1;
		$( ".animacia .containerVertical" ).load( "lib/getContent.php", 
			{ 
				content_id : content_id, 
				type: "vertical",
				cubesCount : verticalCubesCount,
				lang : actualLang,
				get_content : true,
				fourCubesHorizontal : hasFourCubesHorizontal,
				isNews : isNews,
				hasPerspective : hasPerspective  
			}, function( response, status, xhr ) {
				checkIfVerticalContentIsReady(verticalCubesCount,hasFourCubesHorizontal);
			} 
		);
	}
	function hideHorizontalCube(contentType,content_id,hasFourCubesHorizontal,isNews){
		iteration = (actualHasFourCubesHorizontal ? 2 : 1)
		if(!onlyOneRow){
			$('.vertical-box-1-' + (iteration+2)).css("visibility","hidden");
			$('.horizontal-box-' + (iteration+2) + ' .backHorizontal').css("background-image","url(img/front.jpg)");
			$('.horizontal-box-' + (iteration+2) + ' .podstranka').css("visibility","hidden");
		}
		if(actualHasFourCubesHorizontal){
	    	$('.horizontal-box-4')
	        .css({ transformOrigin: '232px 232px' })
	        .transition({
	      		perspective: '1500px',
	      		rotateY: '0deg',
	      		easing: 'easeInOutCirc',
	      		duration: animationSpeedPerCube,
	      		delay: animationSpeedPerCube,
		          complete: function() { 
		        	  $('.horizontal-box-4').css("visibility","hidden");
		        	  $('.vertical-box-1-3').css("visibility","hidden");
		  				$('.horizontal-box-3 .backHorizontal').css("background-image","url(img/front.jpg)");
		  				$('.horizontal-box-3 .podstranka').css("visibility","hidden");
		          }
	    	});
	    }
	    
	    $('.horizontal-box-3')
        .css({ transformOrigin: '232px 232px' })
        .transition({
      		perspective: '1500px',
      		rotateY: '0deg',
      		easing: 'easeInOutCirc',
      		duration: animationSpeedPerCube,
      		delay: iteration*animationSpeedPerCube,
          complete: function() { 
        	  $('.horizontal-box-3').css("visibility","hidden");
        	  $('.vertical-box-1-2').css("visibility","hidden");
  				$('.horizontal-box-2 .backHorizontal').css("background-image","url(img/front.jpg)");
  				$('.horizontal-box-2 .podstranka').css("visibility","hidden");
          }
    	});
	    $('.horizontal-box-2')
        .css({ transformOrigin: '232px 232px' })
        .transition({
      		perspective: '1500px',
      		rotateY: '0deg',
      		easing: 'easeInOutCirc',
      		duration: animationSpeedPerCube,
      		delay: (iteration+1)*animationSpeedPerCube,
          complete: function() { 
        	  $('.horizontal-box-2').css("visibility","hidden");
        	  $('.vertical-box-1-1').css("visibility","hidden");
  				$('.horizontal-box-1 .backHorizontal').css("background-image","url(img/front.jpg)");
  				$('.horizontal-box-1 .podstranka').css("visibility","hidden");
          }
    	});
	    $('.horizontal-box-1')
        .css({ transformOrigin: '232px 232px' })
        .transition({
      		perspective: '1500px',
      		rotateY: '0deg',
      		easing: 'easeInOutCirc',
      		duration: animationSpeedPerCube,
      		delay: (iteration+2)*animationSpeedPerCube,
          complete: function() { 
        	  contentIsLoad = true;
        	  $('.horizontal-box-1').css("visibility","hidden");
        	  if(contentType == "content"){
	        	  if(!isNews){
	      			if(content_id == 65){
	      				getLinkToSubPage("history", null);
	      			}else{
	      				getLinkToSubPage("content", content_id);
	      			}
	        	  }
        		  $( ".animacia .containerHorizontal" ).load( "lib/getContent.php", 
      					{ 
      						content_id : content_id, 
      						type: "horizontal",
      						cubesCount : null,
      						lang : actualLang,
      						get_content : true,
      						fourCubesHorizontal : hasFourCubesHorizontal,
      						isNews : isNews,
    						hasPerspective : hasPerspective   
      					}, function( response, status, xhr ) {
      						if(status == "success"){
      							checkIfHorizontalContentIsReady(content_id,hasFourCubesHorizontal,isNews);
      						}
      					} 
      				);
            	}else if(contentType == "index-boxes"){
                	showIndexBoxes();
                }else{
            		 animationInProgress = false;
                }
          }
    	});
	}
	
	function showHorizontalAnimation(hasFourCubesHorizontal, onlyOneRow){
		if($(".containerHorizontal .podstranka").hasClass("kontakt") || actualTypeOfContent == "news"){
			$(".animacia").removeClass( "w-st-3 offset-w-st-2" ).addClass("w-st-4 offset-w-st-1");
			if($(".containerHorizontal .podstranka").hasClass("kontakt")){
				$(".animacia .containerHorizontal").css( "margin-left","0px" );
				$(".animacia .text").css("width","929px");
				if(isIE()){
					$(".fakeContent").css("width","929px");
					$(".fakeContent").css("padding","0px");
				}
			}else{
				$(".animacia .containerHorizontal").css( "margin-left","-232px" );
				$(".animacia .text").css("width","696px");
			}
		}else{
			if(isIE()){
				$(".fakeContent").css("width","696px");
				$(".fakeContent").css("padding","20px");
			}
			$(".animacia").removeClass( "w-st-4 offset-w-st-1" ).addClass( "w-st-3 offset-w-st-2" );
			$(".animacia .containerHorizontal").css( "margin-left","-232px" );
			$(".animacia .text").css("width","696px");
		}
		if(onlyOneRow || actualTypeOfContent == "news"){
			$(".containerHorizontal .podstranka").css("visibility","visible");
			$(".animacia .text").css("height","232px");
		}
		$('.horizontal-box-1').css("visibility","visible");
	    $('.horizontal-box-1')
	      .css({ transformOrigin: '232px 232px' })
	      .transition({		
	    		perspective: '1500px',
	    		rotateY: '180deg',
	    		easing: 'easeInOutCirc',
	    		duration: animationSpeedPerCube,
	        complete: function() { 
	        	$('.horizontal-box-2').css("visibility","visible") ;
        	}
	    });
	    $('.horizontal-box-2')
	        .css({ transformOrigin: '232px 232px' })
	        .transition({
	      		perspective: '1500px',
	      		rotateY: '180deg',
	      		duration: animationSpeedPerCube,
	      		easing: 'easeInOutCirc',
	      		delay: animationSpeedPerCube,
	          complete: function() { 
		          $('.horizontal-box-3').css("visibility","visible") ;
	          }
	    });
	    $('.horizontal-box-3')
	        .css({ transformOrigin: '232px 232px' })
	        .transition({
	      		perspective: '1500px',
	      		rotateY: '180deg',
	      		easing: 'easeInOutCirc',
	      		duration: animationSpeedPerCube,
	      		delay: 2*animationSpeedPerCube,
	          complete: function() { 
				if(hasFourCubesHorizontal){
					$('.horizontal-box-4').css("visibility","visible"); 
				}else{
					if(!onlyOneRow){
						$('.vertical-box-1-1').css("visibility","visible"); 
			          	$('.vertical-box-1-2').css("visibility","visible");
			          	$('.vertical-box-1-3').css("visibility","visible");
			          	$('.horizontal-box-1 .backHorizontal').css("background","none");
			          	$('.horizontal-box-2 .backHorizontal').css("background","none");
			          	$('.horizontal-box-3 .backHorizontal').css("background","none");
					}else{
						if(!$(".containerHorizontal .podstranka").hasClass("kontakt") || isIE()){
							$(".containerHorizontal").css("display","none");
					 		$(".containerVertical").css("display","none");
							$(".fakeContent").css("height","232px");
							$(".fakeContent").css("background-image","url(img/obsahova-plocha.jpg)");
							$(".fakeContent").css("display","block").html($(".horizontal-box-1 .podstranka").html());
						}
						contentIsLoad = true;
						animationInProgress = false;
						actualHasFourCubesHorizontal = hasFourCubesHorizontal;
					}
				  	$('.containerHorizontal .podstranka').css("visibility","visible");
				}
	          }
	    });
	    if(hasFourCubesHorizontal){
	    	$('.horizontal-box-4')
	        .css({ transformOrigin: '232px 232px' })
	        .transition({
	      		perspective: '1500px',
	      		rotateY: '180deg',
	      		easing: 'easeInOutCirc',
	      		duration: animationSpeedPerCube,
	      		delay: 3*animationSpeedPerCube,
		          complete: function() { 
			          $('.vertical-box-1-1').css("visibility","visible"); 
			          $('.vertical-box-1-2').css("visibility","visible");
			          $('.vertical-box-1-3').css("visibility","visible");
			          $('.vertical-box-1-4').css("visibility","visible");
			          $('.horizontal-box-1 .backHorizontal').css("background","none");
		          		$('.horizontal-box-2 .backHorizontal').css("background","none");
		          		$('.horizontal-box-3 .backHorizontal').css("background","none");
		          		$('.horizontal-box-4 .backHorizontal').css("background","none");
					  $('.containerHorizontal .podstranka').css("visibility","visible");
					  if(!$(".containerHorizontal .podstranka").hasClass("kontakt") || isIE()){
					  	$(".containerHorizontal").css("display","none");
				 		$(".containerVertical").css("display","none");
					  	$(".fakeContent").css("height","232px");
						$(".fakeContent").css("background-image","url(img/obsahova-plocha.jpg)");
						$(".fakeContent").css("display","block").html($(".horizontal-box-1 .podstranka").html());
					  }
					  contentIsLoad = true;
		          }
	    	});
	    }
	}
	function showAnimation(verticalCubesCount,hasFourCubesHorizontal){
		if(hasFourCubesHorizontal){
			verticalCubesCount = 1; // ide o kontakt
		}
		onlyOneRow = false;
		showHorizontalAnimation(hasFourCubesHorizontal,false);
		verticalIteration = 1;
		setTimeout(function(){
			animateVerticalCube(verticalIteration,verticalCubesCount,1);
		},3*animationSpeedPerCube + 0);
		setTimeout(function(){
			animateVerticalCube(verticalIteration,verticalCubesCount,2);
		},3*animationSpeedPerCube + 0 + 70);
		setTimeout(function(){
			animateVerticalCube(verticalIteration,verticalCubesCount,3);
		},3*animationSpeedPerCube + 140);
		if(hasFourCubesHorizontal){
			setTimeout(function(){
				animateVerticalCube(verticalIteration,verticalCubesCount,4);
			},4*animationSpeedPerCube + 210);
		}     
	}
	function hideOldContent(contentType,content_id,hasFourCubesHorizontal,isNews){
		if(hasPerspective){
			$(".fakeContent").css("height","0px");
			$(".fakeContent").css("background-image","");
			$(".fakeContent").css("display","none").html("");
			$(".containerHorizontal").css("display","block");
	 		$(".containerVertical").css("display","block");
			if(onlyOneRow){
				hideHorizontalCube(contentType,content_id,hasFourCubesHorizontal,isNews);
			}else{
				verticalIteration = verticalCubesCount;
				iteration = (actualHasFourCubesHorizontal ? 2 : 1 );
				if(actualHasFourCubesHorizontal){
					setTimeout(function(){
						hideVerticalCube(verticalIteration,verticalCubesCount,4,contentType,content_id,hasFourCubesHorizontal,isNews);
					},1*animationSpeedPerCube + (70));
				}
				setTimeout(function(){
					hideVerticalCube(verticalIteration,verticalCubesCount,3,contentType,content_id,hasFourCubesHorizontal,isNews);
				},(iteration)*animationSpeedPerCube + (iteration*100));
				setTimeout(function(){
					hideVerticalCube(verticalIteration,verticalCubesCount,2,contentType,content_id,hasFourCubesHorizontal,isNews);
				},(iteration+1)*animationSpeedPerCube + ((iteration+1)*70));
				setTimeout(function(){
					hideVerticalCube(verticalIteration,verticalCubesCount,1,contentType,content_id,hasFourCubesHorizontal,isNews);
				},(iteration+2)*animationSpeedPerCube + ((iteration+2)*70));
	
			}
		}else{
			if(contentType == "content"){
				if(($(".submenu-aktuality").css("display") == "block") && !isNews){
					$(".submenu-aktuality").fadeOut(500);
				}
				if(!isNews){
					if(content_id == 65){
						getLinkToSubPage("history", null);
	      			}else{
	      				getLinkToSubPage("content", content_id);
					}
				}
				$( ".animacia .containerHorizontal" ).load( "lib/getContent.php", 
					{ 
						content_id : content_id, 
						type: "horizontal",
						cubesCount : null,
						lang : actualLang,
						get_content : true,
						fourCubesHorizontal : hasFourCubesHorizontal,
						isNews : isNews,
						hasPerspective : hasPerspective   
					}, function( response, status, xhr ) {
						if(status == "success"){
							generateSelflink(this);
							$(".containerHorizontal").html(response);
							heightCeil = Math.ceil($( ".animacia .containerHorizontal .podstranka" ).height()/232);
							$( ".animacia .containerHorizontal .podstranka" ).css("height",heightCeil*232 + "px");
							contentIsLoad = true;
						}
					} 
				);
			}else if(contentType == "index-boxes"){
				if(actualFirstLevelMenu != ""){
					$("." + actualFirstLevelMenu + ".te-transition").removeClass("te-show").hide().fadeOut(500);
				}
				$( ".animacia .containerHorizontal" ).empty();
				$( ".animacia .containerVertical" ).empty();
				showIndexBoxes();
			}else{
				$( ".animacia .containerHorizontal" ).empty();
				$( ".animacia .containerVertical" ).empty();
			}
		}
	}
	function hideVerticalCube(verticalIteration,verticalCubesCount,rowAnimated,contentType,content_id,hasFourCubesHorizontal,isNews){
		$(".containerHorizontal").css({"z-index":"0","position":"relative"});
		$('.vertical-box-' + verticalIteration + '-' + rowAnimated)
        .css({ transformOrigin: '0px 232px' })
        .transition({		
      		perspective: '1500px',
      		rotateX: '0deg',
      		easing: 'easeInOutCirc',
      		duration: animationSpeedPerCube,
          complete: function() {	
        	  if(verticalIteration > 0){
        		  if(verticalIteration > 1){
        			  $('.vertical-box-' + verticalIteration + '-' + rowAnimated).css("visibility","hidden");
              	  }
        		  $('.vertical-box-' + (verticalIteration-1) + '-' + rowAnimated + ' .podstranka').css("visibility","hidden");
        		  $('.vertical-box-' + (verticalIteration-1) + '-' + rowAnimated + ' .podstranka').css("background-image","none");
        	  	  $('.vertical-box-' + (verticalIteration-1) + '-' + rowAnimated + ' .backVertical').css("background-image","url(img/front.jpg)");
        		  hideVerticalCube(verticalIteration-1,verticalCubesCount,rowAnimated,contentType,content_id,hasFourCubesHorizontal,isNews);
        		  if(rowAnimated == 1 && verticalIteration == 1){
					hideHorizontalCube(contentType,content_id,hasFourCubesHorizontal,isNews);
              	  }
            	}
        	
          }
      	});
	}
	function animateVerticalCube(verticalIteration,verticalCubesCount,rowAnimated){
		$(".containerHorizontal").css({"z-index":"200","position":"relative"});
		if(verticalIteration > 1){
			$('.vertical-box-' + verticalIteration + '-' + rowAnimated).css("visibility","visible");
			delay = animationSpeedPerCube;
		}else{
			delay = 3*animationSpeedPerCube;
		}
		if(verticalIteration == verticalCubesCount){
			$('.vertical-box-' + verticalIteration + '-' + rowAnimated + ' .podstranka').css("height",((1+verticalCubesCount) * 232)+"px");
			 $('.vertical-box-' + verticalIteration + '-' + rowAnimated + ' .podstranka').css("visibility","visible");
			 $('.vertical-box-' + verticalIteration + '-' + rowAnimated + ' .backVertical').css("background","none");
			 contentIsLoad = true;
			 actualHasFourCubesHorizontal = hasFourCubesHorizontal;
		}
		$('.vertical-box-' + verticalIteration + '-' + rowAnimated)
        .css({ transformOrigin: '0px 232px' })
        .transition({		
      		perspective: '1500px',
      		rotateX: '-180deg',
      		easing: 'easeInOutCirc',
      		duration: animationSpeedPerCube,
          complete: function() {
              if(verticalCubesCount >= verticalIteration+1){
            	  	$('.vertical-box-' + verticalIteration + '-' + rowAnimated + ' .podstranka').css("visibility","visible");
        	  	  	$('.vertical-box-' + verticalIteration + '-' + rowAnimated + ' .backVertical').css("background","none");
        	  	  $('.vertical-box-' + verticalIteration + '-' + rowAnimated + ' .backVertical').css("background-image","url(img/obsahova-plocha.jpg)");
					animateVerticalCube(verticalIteration+1,verticalCubesCount,rowAnimated);
              }else{
            	  if(rowAnimated == 3){
      			 	if(!$(".containerHorizontal .podstranka").hasClass("kontakt") || isIE()){
      			 		$(".containerHorizontal").css("display","none");
      			 		$(".containerVertical").css("display","none");
      			 		$(".fakeContent").css("height",((verticalCubesCount+1)*232) + "px");
						$(".fakeContent").css("background-image","url(img/obsahova-plocha.jpg)");
      					$(".fakeContent").css("display","block").html($(".horizontal-box-1 .podstranka").html());
      				}
      			 	animationInProgress = false;
      			 }
                  }	
              
          }
      });
	}
	function animateThirdLevel(alias){
		$(".menuThirdLevelBuild " + "." + alias).css("display","block");
		verticalCubesCountThirdMenu = Math.ceil($("." + alias + " .third-level-menu-box-1 .text").height()/232);
		if(alias != oldThirdLevelAlias && oldThirdLevelAlias != ""){
			hideThirdLevelMenu(alias,oldThirdLevelAlias,verticalCubesCountThirdMenu,oldVerticalCubesCountThirdMenu);
		}else{
			showThirdLevel(alias,verticalCubesCountThirdMenu,1);
			oldThirdLevelAlias = alias;
		}
	}
	function showThirdLevel(alias,verticalCubesCountThirdMenu,rowAnimated){
		if(hasPerspective){
			$('.' + alias + ' .third-level-menu-box-' + rowAnimated).css("visibility","visible");
			$('.' + alias + ' .third-level-menu-box-' + rowAnimated)
		      .css({ transformOrigin: '0px 232px' })
		      .transition({		
		    		perspective: '1500px',
		    		rotateX: '-180deg',
		    		easing: 'easeInOutCirc',
		    		duration: animationSpeedPerCube,
		        complete: function() { 
		        	$('.' + alias + ' .third-level-menu-box-' + rowAnimated + ' .text').css("visibility","visible");
			        if(rowAnimated < verticalCubesCountThirdMenu){
			        	showThirdLevel(alias,verticalCubesCountThirdMenu,rowAnimated+1);
			        }else{
			        	animationInProgress = false;
			        	oldThirdLevelAlias = alias;
			            oldVerticalCubesCountThirdMenu = verticalCubesCountThirdMenu;
			            if(isIExplorer){
			    			$("." + alias + " .fakeMenuDiv").css("display","block");
			    		}
			        }
		        }
		    });
		}else{
			for(i=1;i<=verticalCubesCountThirdMenu;i++){
				$('.menuThirdLevelBuild .' + alias).css("margin-top","232px");
				$('.' + alias + '.' + actualLang + ' .third-level-menu-box-' + i).css("visibility","visible");
				$('.' + alias + '.' + actualLang + ' .third-level-menu-box-' + i + ' .text').css("visibility","visible");
				if(verticalCubesCountThirdMenu == i){
					oldThirdLevelAlias = alias;
		            oldVerticalCubesCountThirdMenu = verticalCubesCountThirdMenu;
				}
			}
		}
	}
	function hideThirdLevelMenu(alias,oldThirdLevelAlias,verticalCubesCountThirdMenu,rowAnimated){
		if(hasPerspective){
			if(isIExplorer){
    			$("." + oldThirdLevelAlias + " .fakeMenuDiv").css("display","none");
    		}
			$('.' + oldThirdLevelAlias + ' .third-level-menu-box-' + rowAnimated)
	        .css({ transformOrigin: '0px 232px' })
	        .transition({		
	      		perspective: '1500px',
	      		rotateX: '0deg',
	      		easing: 'easeInOutCirc',
	      		duration: animationSpeedPerCube,
	          complete: function() {
	        	  $('.' + oldThirdLevelAlias + ' .third-level-menu-box-' + rowAnimated).css("visibility","hidden");
	        	  if(rowAnimated-1 > 0){
	        	  	hideThirdLevelMenu(alias,oldThirdLevelAlias,verticalCubesCountThirdMenu,rowAnimated-1);
	          	  }
	          	  if(rowAnimated == 1 && alias != null){
	           		showThirdLevel(alias,verticalCubesCountThirdMenu,1);
	              }
	          }
	      	});
		}else{
			$('.' + oldThirdLevelAlias + ' .menuVertical').css("visibility","hidden");
			$('.' + oldThirdLevelAlias + ' .menuVertical .text').css("visibility","hidden");
			if(alias != null){
           		showThirdLevel(alias,verticalCubesCountThirdMenu,1);
          	}
		}
	}
	function showArchiveYear(object, byHash){
		if(!$(object).hasClass("active")){
			if($(object).attr("name") == "news"){
				getLinkToSubPage("newsYear", $(object).attr("id"));
			}else if($(object).attr("name") == "history"){
				getLinkToSubPage("historyYear", $(object).attr("id"));
			}
			$("." + $(".yearsList li").find(".active").attr("id")).fadeOut(500,function(){
	        	$(".archiveYear " + "." + $(object).attr("id")).fadeIn(500);
	        	$(".yearsList li a").removeClass("active");
	    		$(".yearsList li").find("#" + $(object).attr("id")).addClass("active");
	        });
	        if(byHash == true){
	        	$(".historyYearContent").eq(0).fadeOut(500,function(){
		        	$(".archiveYear " + "." + $(object).attr("id")).fadeIn(500);
		        	$(".yearsList li a").removeClass("active");
		    		$(".yearsList li").find("#" + $(object).attr("id")).addClass("active");
	        	});
        	}
		}
	}
	function isIE() {
		var undef,rv = -1; // Return value assumes failure.
	    var ua = window.navigator.userAgent;
	    var msie = ua.indexOf('MSIE ');
	    var trident = ua.indexOf('Trident/');

	    if (msie > 0) {
	        // IE 10 or older => return version number
	        rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	    } else if (trident > 0) {
	        // IE 11 (or newer) => return version number
	        var rvNum = ua.indexOf('rv:');
	        rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
	    }

	    return ((rv > -1) ? true : false);
	}
	function ieVersion() {
		var undef,rv = -1; // Return value assumes failure.
	    var ua = window.navigator.userAgent;
	    var msie = ua.indexOf('MSIE ');
	    var trident = ua.indexOf('Trident/');

	    if (msie > 0) {
	        // IE 10 or older => return version number
	        rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	    } else if (trident > 0) {
	        // IE 11 (or newer) => return version number
	        var rvNum = ua.indexOf('rv:');
	        rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
	    }

	    return ((rv > -1) ? rv : "undef");
	}
	function generateSelflink(object){
		$(".animacia").ready(function(){
			$( ".animacia .selflink" ).each(function( index ) {
				$(this).attr("has_child",0);
				$(this).attr("content_id",$(this).attr("href"));
				$(this).attr("href","javascript:void(0)");
				$(this).attr("onclick","rollNewPage(this,'selflink')");
			});
		});
	}
	function getLinkToSubPage(type, typeId){
		window.location.hash = type + ((typeId != null) ? "-" + typeId : "");
	}
	function showSubPageByHash(){
		hash = window.location.hash.substring(1);
		hashSplited = hash.split("-");
		if(hashSplited[0] == "content" && hashSplited[1] != undefined){
			showMenuOfSubpage(hashSplited[1]);
			rollNewPage('<a href="javascript:void(0)" content_id="' + hashSplited[1] + '" has_child="0" class="' + ((hashSplited[1] == 61) ? "kontakt" : "unnamed") + '"></a>',"menulink");
		}else if(hashSplited[0] == "history" && hashSplited[1] == undefined){
			showMenuOfSubpage(65);
			rollNewPage('<a href="javascript:void(0)" content_id="65" has_child="0" class="historia"></a>',"menulink");
		}else if(hashSplited[0] == "historyYear" && hashSplited[1] != undefined){
			rollNewPage('<a href="javascript:void(0)" content_id="65" has_child="0" class="historia"></a>',"menulink");
			controlHistoryYearAndChange(hashSplited[1], "history");
		}else if(hashSplited[0] == "newsArchive" && hashSplited[1] == undefined){
			zobrazNovinku('<a class="bx-archiv" href="javascript:void(0)"></a>');
		}else if(hashSplited[0] == "newsYear" && hashSplited[1] != undefined){
			zobrazNovinku('<a class="bx-archiv" href="javascript:void(0)"></a>');
			controlHistoryYearAndChange(hashSplited[1], "news");
		}else if(hashSplited[0] == "news" && hashSplited[1] != undefined){
			zobrazNovinku('<a href="javascript:void(0)" news_id="' + hashSplited[1] + '"></a>');
		}
	}
	function controlHistoryYearAndChange(yearString, type){
		setTimeout(function(){
			if(type == "history"){
				if($(".historyYearContent").eq(0).height() != null || $(".historyYearContent").eq(0).height() != undefined){
					showArchiveYear('<a href="javascript:void(0)" id="' + yearString + '" name="history"></a>');
				}else{
					controlHistoryYearAndChange(yearString, type);
				}
			}else{
				if($(".archiveYear ul").eq(0).hasClass("active")){
					showArchiveYear('<a href="javascript:void(0)" id="' + yearString + '" name="news"></a>');
				}else{
					controlHistoryYearAndChange(yearString, type);
				}
			}
		}, 500);
	}
	function showMenuOfSubpage(contentId){
		firstLevelClass = null;
		secondLevelClass = null;
		thirdLevelClass = null;
		$(".menuSecondLevel .te-transition .te-front ul li").each(function( index ) {
			if($( "a", this ).attr("content_id") == contentId){
				secondLevelClass = $( "a", this ).attr("class");
				classList = $( "a", this ).parents(".te-front").attr("class").split(/\s+/);
				firstLevelClass = classList[0];
			}
		});
		if(firstLevelClass == null){
			$(".menuThirdLevelBuild .menuThirdLevel").each(function( index ) {
				$(".menuVertical:eq(0) .backVertical .thirdLevel li", this).each(function( index ) {
					if($( "a", this ).attr("content_id") == contentId){
						thirdLevelClass = $( "a", this ).attr("class");
						classList = $( "a", this ).parents(".menuThirdLevel").attr("class").split(/\s+/);
						secondLevelClass = classList[1];
						$(".menuSecondLevel .te-transition .te-front ul li").each(function( index ) {
							if($( "a", this ).attr("class") == secondLevelClass){
								classList = $( "a", this ).parents(".te-front").attr("class").split(/\s+/);
								firstLevelClass = classList[0];
							}
						});
					}
				});
			});
		}
		if(firstLevelClass != null){
			$("." + firstLevelClass + ".te-transition").addClass("te-rotation4");
			$("." + firstLevelClass + ".te-transition").addClass("te-show");
			$("." + firstLevelClass + ".te-front").hide();
			$("." + firstLevelClass + ".te-back").show();
			$oldFirstLevelMenu = $("." + firstLevelClass);
			actualFirstLevelMenu = $("." + firstLevelClass).attr("class");
			$("." + firstLevelClass).addClass("active");
			$("." + firstLevelClass).parent().addClass("active");
			$("." + secondLevelClass).parent().addClass("active");
			if(thirdLevelClass != null){
				animateThirdLevel(secondLevelClass);
			}
		}
	}
	</script>
	<?php
}
?>
