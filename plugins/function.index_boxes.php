<?php
function smarty_function_index_boxes($params, &$template)
{
	$db = cmsms()->GetDb();
	$contentBoxesSelect = $db->GetArray("select prop_name, content from cms_content_props where content_id = 74");
	?>
	<div style="display:none" class="fakeIndexBoxes">
		<?php 
		foreach($contentBoxesSelect as $contentBox){
			?>
			<li>
				<a href="javascript:void(0)" content_id="<?php echo $firstLevel["content_id"]?>" level="1" has_child="<?php echo ((count($hasSecondLevel) > 0) ? 1 : 0) ?>" name_sk="<?php echo $firstLevel["content_name"]?>" name_en="<?php echo $firstLevel["menu_text"]?>" class="<?php echo str_replace("-","_",$firstLevel["content_alias"])?>"><?php echo $firstLevel["content_name"]?></a>
			</li>
			<?php 
			if($contentBox["prop_name"] == "content_en"){ ?> <div class="box_one_sk"><?php echo $contentBox["content"]; ?></div> <?php }
			if($contentBox["prop_name"] == "box_one_en"){ ?> <div class="box_one_en"><?php echo $contentBox["content"]; ?></div> <?php }
			if($contentBox["prop_name"] == "box_two_sk"){ ?> <div class="box_two_sk"><?php echo $contentBox["content"]; ?></div> <?php }
			if($contentBox["prop_name"] == "box_two_en"){ ?> <div class="box_two_en"><?php echo $contentBox["content"]; ?></div> <?php }
			if($contentBox["prop_name"] == "box_three_sk"){ ?> <div class="box_three_sk"><?php echo $contentBox["content"]; ?></div> <?php }
			if($contentBox["prop_name"] == "box_three_en"){ ?> <div class="box_three_en"><?php echo $contentBox["content"]; ?></div> <?php }
		}
		?>
	</div>
	<?php

	$novinkySelect = $db->GetArray("select news_title as title_sk, mn.news_id, mnf.value as title_en from cms_module_news mn
								left join cms_module_news_fieldvals mnf on mn.news_id = mnf.news_id
								where mn.status = 'published' and 
								((mn.start_time is not null and mn.end_time is not null and mn.start_time <= DATE(NOW()) and mn.end_time >= DATE(NOW())) 
								or (mn.start_time is null and mn.end_time is not null and mn.end_time >= DATE(NOW()))
								or (mn.start_time is not null and mn.end_time is null and mn.start_time <= DATE(NOW()))
								or (mn.start_time is null and mn.end_time is null))
								and mn.news_category_id = 1
								order by mn.news_date desc LIMIT 0, 14");  
	?>
  	<div class="index-content-boxes">
  			<?php 
  			foreach($contentBoxesSelect as $contentBox){
	  			if($contentBox["prop_name"] == "content_en"){
	  				?>
		        	<div class="submenu-bezpecnost-is pull-left index-boxes w-st-1 h-st-1 not-news">
		        		<div class="forFade"><!-- tento div tu je kvoli tomu aby fungoval fade pri zmene jazyka -->
			        	<h3>Informačná bezpečnosť</h3>
			        	<ul>
				        	<li>Technologická bezpečnosť</li>
							<li>Procedurálna bezpečnosť</li>
							<li>Architektúra</li>
						</ul>
		        	 	<div class="top-strip"></div><div class="right-strip"></div><div class="bottom-strip"></div><div class="left-strip"></div>
			        	<div class="top-square"></div><div class="right-square"></div><div class="bottom-square"></div><div class="left-square"></div> 
						</div>
					</div>
					<?php 
  				}
				if($contentBox["prop_name"] == "box_two_sk"){
	  				?>
		        	<div class="submenu-it-riesenia pull-left index-boxes w-st-1 h-st-1 not-news">
		        		<div class="forFade"><!-- tento div tu je kvoli tomu aby fungoval fade pri zmene jazyka -->
			        	<h3>Informačno-komunikačné technológie</h3>
			        	<ul>
				        	<li>Návrh architektúry, Dátové úložisko</li>
							<li>Dodávka HW a SW na kľúč</li>
							<li>Outsourcing, Virtualizácia</li>
						</ul>
						</div>
					</div>
					<?php 
  				}
				if($contentBox["prop_name"] == "box_three_sk"){
	  				?>
		        	<div class="submenu-technicka-bezpecnost pull-left index-boxes w-st-1 h-st-1 not-news">
		        		<div class="forFade"><!-- tento div tu je kvoli tomu aby fungoval fade pri zmene jazyka -->
			        	<h3>Technická a objektová bezpečnosť</h3>
			        	<ul>
				        	<li>Systémy technickej a objektovej bezpečnosti</li>
							<li>Servisný monitorovací dispečing</li>
							<li>Dátové centrá</li>
						</ul>
						</div>
					</div>
					<?php 
  				}
  			}
  			?>
			<div class="submenu-aktuality pull-left index-boxes w-st-1 h-st-2">
				<h3>Aktuálne</h3>
				<div class="novinky">
			        	<?php 
			        	$newsIteration = 1;
			        	foreach($novinkySelect as $novinka){
			        		$newsIteration++;
			        	}
			        	$newsIteration = 1;
			        	foreach($novinkySelect as $novinka){
			        		if(($newsIteration % 10) == 1){
		        				?>
		        				<ul class="dvojicaNoviniek">
		        				<?php 
			        		}
		        			?>	
			        		<li>
			        			<a href="javascript:void(0)" news_id='<?php echo $novinka["news_id"]?>' name_sk="<?php echo $novinka["title_sk"]?>" name_en="<?php echo $novinka["title_en"]?>"><?php echo $novinka["title_sk"]?></a>
			        		</li>
			        		<?php
			        		if((($newsIteration % 10) == 0) || (count($novinkySelect) == $newsIteration)){
		        				?>
		        				</ul>
		        				<?php 
			        		}
			        		$newsIteration++;
			        	} ?>
				</div>  
				<div class="outside">
					<span id="slider-prev" class="inactive">← novšie</span>
					<a class="bx-archiv" href="javascript:void(0)">Archív</a>
					<span id="slider-next">staršie →</span>
				</div>    	
			</div>
	</div><!--index-content-boxes-->
	<?php 
}
?>
