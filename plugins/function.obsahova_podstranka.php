<?php
function smarty_function_obsahova_podstranka($params, &$template){
	?>
	<style>
	.containerHorizontal{
    -webkit-perspective: 1000px 1000px;
        -moz-perspective: 1000px 1000px;
         -o-perspective: 1000px 1000px;
         -ms-perspective: 1000px 1000px;
         perspective: 1000px 1000px;
   -webkit-perspective-origin: 10% 10%; 
   -moz-perspective-origin: 10% 10%; 
   -o-perspective-origin: 10% 10%; 
   -ms-perspective-origin: 10% 10%; 
   perspective-origin: 10% 10%; 
    margin-left:-232px;
    
}

.containerVertical-1 {
    -webkit-perspective: 1000px 1000px;
        -moz-perspective: 1000px 1000px;
         -o-perspective: 1000px 1000px;
         -ms-perspective: 1000px 1000px;
         perspective: 1000px 1000px;
   -webkit-perspective-origin: 10% 10%; 
   -moz-perspective-origin: 10% 10%; 
   -o-perspective-origin: 10% 10%; 
   -ms-perspective-origin: 10% 10%; 
   perspective-origin: 10% 10%; 
    height:232px;
    overflow: visible;
}

.containerVertical-2 {
    float:left;
    -webkit-perspective: 1000px 1000px;
        -moz-perspective: 1000px 1000px;
        -o-perspective: 1000px 1000px;
         -ms-perspective: 1000px 1000px;
         perspective: 1000px 1000px;
   -webkit-perspective-origin: 10% 10%; 
   -moz-perspective-origin: 10% 10%; 
   -o-perspective-origin: 10% 10%; 
   -ms-perspective-origin: 10% 10%; 
   perspective-origin: 10% 10%; 
    margin-left: 232px;
    margin-top: -232px;
    height:232px;
    overflow: visible;
}

.containerVertical-3 {
    float:left;
    -webkit-perspective: 1000px 1000px;
        -moz-perspective: 1000px 1000px;
        -o-perspective: 1000px 1000px;
         -ms-perspective: 1000px 1000px;
         perspective: 1000px 1000px;
   	-webkit-perspective-origin: 10% 10%; 
    -moz-perspective-origin: 10% 10%; 
   -o-perspective-origin: 10% 10%; 
   -ms-perspective-origin: 10% 10%; 
   perspective-origin: 10% 10%; 
    margin-left: 464px;
    margin-top: -232px;
    height:232px;
    overflow: visible;
}

.containerVertical-4 {
    float:left;
    -webkit-perspective: 1000px 1000px;
        -moz-perspective: 1000px 1000px;
        -o-perspective: 1000px 1000px;
         -ms-perspective: 1000px 1000px;
         perspective: 1000px 1000px;
   	-webkit-perspective-origin: 10% 10%; 
    -moz-perspective-origin: 10% 10%; 
   -o-perspective-origin: 10% 10%; 
   -ms-perspective-origin: 10% 10%; 
   perspective-origin: 10% 10%; 
    margin-left: 696px;
    margin-top: -232px;
    height:232px;
    overflow: visible;
}
.menuThirdLevelBuild{
	-webkit-perspective: 1000px 1000px;
        -moz-perspective: 1000px 1000px;
        -o-perspective: 1000px 1000px;
         -ms-perspective: 1000px 1000px;
         perspective: 1000px 1000px;
   -webkit-perspective-origin: 10% 10%; 
   -moz-perspective-origin: 10% 10%; 
   -o-perspective-origin: 10% 10%; 
   -ms-perspective-origin: 10% 10%; 
   perspective-origin: 10% 10%; 
} 
.animacia .text{
  margin-top:0px;
  width: 696px;
  height:auto;
  position:absolute;
}
.menuThirdLevel{
	display:none;
}
.menuThirdLevelBuild .text{
  margin-top:0px;
  width: 220px;
  height:auto;
  position:absolute;
}

.clipHorizontal1{
  clip: rect(0px,232px,232px,0px);
}
.clipHorizontal2{
  left:-232px;
  clip: rect(0px,464px,232px,232px);
}
.clipHorizontal3{
  left:-464px;
  clip: rect(0px,696px,232px,464px);
}
.clipHorizontal4{
  left:-696px;
  clip: rect(0px,929px,232px,696px);
}

.third-level-menu-box-2{
	top: 232px !important;
}
.third-level-menu-box-3{
	top: 464px !important;
}
.third-level-menu-box-4{
	top: 696px !important;
}
.third-level-menu-box-5{
	top: 928px !important;
}
.third-level-menu-box-6{
	top: 1160px !important;
}
.third-level-menu-box-1 .text{
 	clip: rect(0px,232px,232px,0px);
 	visibility:hidden;
}
.third-level-menu-box-2 .text{
 	clip: rect(232px,232px,464px,0px);
	top: -232px;
	visibility:hidden;
}
.third-level-menu-box-3 .text{
	clip: rect(464px,232px,696px,0px);
	top: -464px;
}
.third-level-menu-box-4 .text{
	clip: rect(696px,232px,928px,0px);
	top: -696px;
}
.third-level-menu-box-5 .text{
	clip: rect(928px,232px,1160px,0px);
	top: -928px;
}
.third-level-menu-box-6 .text{
	clip: rect(1160px,232px,1392px,0px);
	top: -1160px;
}
.face {
position: absolute;
-webkit-backface-visibility: hidden;
-ms-backface-visibility: hidden;
backface-visibility: hidden;
-moz-backface-visibility: hidden;
-o-backface-visibility: hidden;
top: 0;
left: 0;
width: 232px;
height: 232px;
}
.front{
background: url(img/front.jpg) no-repeat
}

.ie10 .front, .ie11 .front{
background: url(img/obsahova-plocha.jpg) no-repeat 
}

.containerHorizontal .podstranka{
	visibility:hidden;
	background-image: url(img/obsahova-plocha.jpg);

}


.containerVertical .podstranka{
	visibility:hidden;
	background-image: url(img/obsahova-plocha.jpg);
}
.backHorizontal {
-webkit-transform: rotateY(180deg);
-moz-transform: rotateY(180deg);
-ms-transform: rotateY(180deg);
-o-transform: rotateY(180deg);
transform: rotateY(180deg);
background: url(img/front.jpg) repeat-x;
}

.ie10 .backHorizontal, .ie11 .backHorizontal {
background: url(img/obsahova-plocha.jpg) repeat-x ;
}

.backVertical {
-webkit-transform: rotateX(180deg);
-moz-transform: rotateX(180deg);
-ms-transform: rotateX(180deg);
-o-transform: rotateX(180deg);
transform: rotateX(180deg);
overflow: hidden;
background: url(img/front.jpg) repeat-x
}

.ie10 .backVertical, .ie11 .backVertical {
background: url(img/obsahova-plocha.jpg) repeat-x ;
}

.menuThirdLevelBuild .backVertical{
	background: url(img/menu-sub-3.png) repeat-y;
}
.menuThirdLevelBuild .front{
	background: url(img/menu-sub-3.png) repeat-y;
}
.boxHorizontal{
	float: left;
	width: 232px;
	height: 232px;
  	position: relative;
	-webkit-transform-style: preserve-3d;
	-moz-transform-style: preserve-3d;
	-o-transform-style: preserve-3d;
	-ms-transform-style: preserve-3d;
	transform-style: preserve-3d;

}  

.boxVertical{
		width: 232px;
	height: 232px;
  position: relative;
	-webkit-transform-style: preserve-3d;
	-moz-transform-style: preserve-3d;
	-o-transform-style: preserve-3d;
	-ms-transform-style: preserve-3d;
	transform-style: preserve-3d;
  display:none;
  visibility:hidden;
}

.menuVertical{
	left: 233px;
	position: relative;
	-webkit-transform-style: preserve-3d;
	-moz-transform-style: preserve-3d;
	-o-transform-style: preserve-3d;
	-ms-transform-style: preserve-3d;
	transform-style: preserve-3d;
}

.menuTemplate{
	width:232px;
	height:auto;
}
.podstranka.kontakt {
	margin-left: 0px;
	background:none;
}
.nav-level-3{
	top: 228px;
}


@-webkit-keyframes enable1{
0% { -webkit-transform: rotate3d(0,1,0,-180deg); opacity: 0;visibility:visible}
30% { -webkit-transform: rotate3d(0,1,0,-90deg);visibility:visible}
100% { -webkit-transform: rotate3d(0,1,0,0deg); opacity: 1; visibility:visible}
}
@-moz-keyframes enable1{
0% { -moz-transform: rotate3d(0,1,0,-180deg); opacity: 0;visibility:visible}
30% { -moz-transform: rotate3d(0,1,0,-90deg);visibility:visible}
100% { -moz-transform: rotate3d(0,1,0,0deg); opacity: 1; visibility:visible}
}
@-o-keyframes enable1{
0% { -o-transform: rotate3d(0,1,0,-180deg); opacity: 0;visibility:visible}
30% { -o-transform: rotate3d(0,1,0,-90deg);visibility:visible}
100% { -o-transform: rotate3d(0,1,0,0deg); opacity: 1; visibility:visible}
}
@-ms-keyframes enable1{
0% { -ms-transform: rotate3d(0,1,0,-180deg); opacity: 0;visibility:visible}
30% { -ms-transform: rotate3d(0,1,0,-90deg);visibility:visible}
100% { -ms-transform: rotate3d(0,1,0,0deg); opacity: 1; visibility:visible}
}
@keyframes enable1{
0% { transform: rotate3d(0,1,0,-180deg); opacity: 0;visibility:visible}
30% { transform: rotate3d(0,1,0,-90deg);visibility:visible}
100% { transform: rotate3d(0,1,0,0deg); opacity: 1; visibility:visible}
}

@-webkit-keyframes enable2{
0% { -webkit-transform: rotate3d(0,1,0,-180deg); opacity: 0; -webkit-animation-timing-function: ease-in; visibility:visible}
30% { -webkit-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -webkit-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}
@-moz-keyframes enable2{
0% { -moz-transform: rotate3d(0,1,0,-180deg); opacity: 0; -moz-animation-timing-function: ease-in; visibility:visible}
30% { -moz-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -moz-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}
@-o-keyframes enable2{
0% { -o-transform: rotate3d(0,1,0,-180deg); opacity: 0; -o-animation-timing-function: ease-in; visibility:visible}
30% { -o-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -o-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}
@-ms-keyframes enable2{
0% { -ms-transform: rotate3d(0,1,0,-180deg); opacity: 0; -ms-animation-timing-function: ease-in; visibility:visible}
30% { -ms-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -ms-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}
@keyframes enable2{
0% { transform: rotate3d(0,1,0,-180deg); opacity: 0; animation-timing-function: ease-in; visibility:visible}
30% { transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}

@-webkit-keyframes enable3{
0% { -webkit-transform: rotate3d(1,0,0,180deg); opacity: 0; -webkit-animation-timing-function: ease-in;  visibility:visible}
30% { -webkit-transform: rotate3d(1,0,0,90deg); visibility:visible}
100% { -webkit-transform: rotate3d(1,0,0,0deg); opacity: 1;  visibility:visible}
}
@-moz-keyframes enable3{
0% { -moz-transform: rotate3d(1,0,0,180deg); opacity: 0; -moz-animation-timing-function: ease-in;  visibility:visible}
30% { -moz-transform: rotate3d(1,0,0,90deg); visibility:visible}
100% { -moz-transform: rotate3d(1,0,0,0deg); opacity: 1;  visibility:visible}
}
@-o-keyframes enable3{
0% { -o-transform: rotate3d(1,0,0,180deg); opacity: 0; -o-animation-timing-function: ease-in;  visibility:visible}
30% { -o-transform: rotate3d(1,0,0,90deg); visibility:visible}
100% { -o-transform: rotate3d(1,0,0,0deg); opacity: 1;  visibility:visible}
}
@-ms-keyframes enable3{
0% { -ms-transform: rotate3d(1,0,0,180deg); opacity: 0; -ms-animation-timing-function: ease-in;  visibility:visible}
30% { -ms-transform: rotate3d(1,0,0,90deg); visibility:visible}
100% { -ms-transform: rotate3d(1,0,0,0deg); opacity: 1;  visibility:visible}
}
@keyframes enable3{
0% { transform: rotate3d(1,0,0,180deg); opacity: 0; animation-timing-function: ease-in;  visibility:visible}
30% { transform: rotate3d(1,0,0,90deg); visibility:visible}
100% { transform: rotate3d(1,0,0,0deg); opacity: 1;  visibility:visible}
}

@-webkit-keyframes enable4{
0% { -webkit-transform: rotate3d(0,1,0,-180deg); opacity: 0; -webkit-animation-timing-function: ease-in;  visibility:visible}
30% { -webkit-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -webkit-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}	
@-moz-keyframes enable4{
0% { -moz-transform: rotate3d(0,1,0,-180deg); opacity: 0; -moz-animation-timing-function: ease-in;  visibility:visible}
30% { -moz-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -moz-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}	
@-o-keyframes enable4{
0% { -o-transform: rotate3d(0,1,0,-180deg); opacity: 0; -o-animation-timing-function: ease-in;  visibility:visible}
30% { -o-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -o-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}	
@-ms-keyframes enable4{
0% { -ms-transform: rotate3d(0,1,0,-180deg); opacity: 0; -ms-animation-timing-function: ease-in;  visibility:visible}
30% { -ms-transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { -ms-transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}	
@keyframes enable4{
0% { transform: rotate3d(0,1,0,-180deg); opacity: 0; animation-timing-function: ease-in;  visibility:visible}
30% { transform: rotate3d(0,1,0,-90deg); visibility:visible}
100% { transform: rotate3d(0,1,0,0deg); opacity: 1;  visibility:visible}
}	

.enable1{
-webkit-transform-origin: 0% 50%;
-moz-transform-origin: 0% 50%;
-o-transform-origin: 0% 50%;
-ms-transform-origin: 0% 50%;
transform-origin: 0% 50%;
-webkit-animation: enable1 0.8s linear;
-moz-animation: enable1 0.8s linear;
-o-animation: enable1 0.8s linear;
-ms-animation: enable1 0.8s linear;
animation: enable1 0.8s linear;
}

.enable2{
-webkit-transform-origin: 50% 0%;
-moz-transform-origin: 50% 0%;
-o-transform-origin: 50% 0%;
-ms-transform-origin: 50% 0%;
transform-origin: 50% 0%;
-webkit-animation: enable2 0.8s 0.3s linear;
-moz-animation: enable2 0.8s 0.3s linear;
-o-animation: enable2 0.8s 0.3s linear;
-ms-animation: enable2 0.8s 0.3s linear;
animation: enable2 0.8s 0.3s linear;
}

.enable3{
-webkit-transform-origin: 0% 0%;
-moz-transform-origin: 0% 0%;
-o-transform-origin: 0% 0%;
-ms-transform-origin: 0% 0%;
transform-origin: 0% 0%;
-webkit-animation: enable3 0.8s 0.5s linear;
-moz-animation: enable3 0.8s 0.5s linear;
-o-animation: enable3 0.8s 0.5s linear;
-ms-animation: enable3 0.8s 0.5s linear;
animation: enable3 0.8s 0.5s linear;
}

.enable4{
-webkit-transform-origin: 0 -50% ;
-moz-transform-origin: 0% -50%;
-o-transform-origin: 0% -50%;
-ms-transform-origin: 0% -50%;
transform-origin: 0% -50%;
-webkit-animation: enable4 0.8s 0.8s linear;
-moz-animation: enable4 0.8s 0.8s linear;
-o-animation: enable4 0.8s 0.8s linear;
-ms-animation: enable4 0.8s 0.8s linear;
animation: enable4 0.8s 0.8s linear;
}
.fakeMenuDiv{
	position: relative;
	left: 232px;
	top: 232px;
	display:none;
}
</style>
	<div class="animacia w-st-3 offset-w-st-2">
		<div class="containerHorizontal">
		</div>
		<div class="containerVertical">
		</div>
		<div class="fakeContent podstranka" style="
		top:-109px;
    z-index: 999999999999;
    position: absolute;width:696px;
">



	</div>
	</div> 
	<?php
}	
?>
