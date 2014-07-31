<?php
function smarty_function_menu_second_level($params, &$template)
{
	?>
	<div id="te-wrapper" class="te-wrapper menuSecondLevel offset-w-st-1">
	<?php
	$db = cmsms()->GetDb();
	$menuFirstLevel = $db->GetArray("select content_id, content_alias from cms_content where parent_id = -1 and active = 1 order by item_order");  
	?>
	<?php 
	foreach($menuFirstLevel as $firstLevel){
		$menuSecondLevel = $db->GetArray("select content_id, content_name, content_alias, menu_text from cms_content where active = 1 and parent_id = ".$firstLevel["content_id"]." order by item_order"); 
		if(count($menuSecondLevel) > 0){
			?>
			<div class="<?php echo str_replace("-","_",$firstLevel["content_alias"])?> te-transition" style="-webkit-perspective: 1000;-moz-perspective: 1000;-o-perspective: 1000;-ms-perspective: 1000;perspective: 1000;">
				<div class="<?php echo str_replace("-","_",$firstLevel["content_alias"])?> te-front">
					<ul class="secondLevel sub-o-nas main-menu nav nav-pills nav-stacked pull-left w-st-1">
						<?php 
						foreach($menuSecondLevel as $secondLevel){
							?>
							<li>
								<a href="javascript:void(0)" level="2" content_id="<?php echo $secondLevel["content_id"]?>" has_child="<?php echo ((count($hasThirdLevel) > 0) ? 1 : 0) ?>" name_sk="<?php echo $secondLevel["content_name"]?>" name_en="<?php echo $secondLevel["menu_text"]?>" class="<?php echo str_replace("-","_",$secondLevel["content_alias"])?>">
									<?php echo $secondLevel["content_name"]?>
								</a>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
				<div class="<?php echo str_replace("-","_",$firstLevel["content_alias"])?> te-back">
					<ul class="secondLevel sub-o-nas main-menu nav nav-pills nav-stacked pull-left w-st-1">
						<?php 
						foreach($menuSecondLevel as $secondLevel){
							$hasThirdLevel = $db->GetArray("select 88 from cms_content where active = 1 and parent_id = ".$secondLevel["content_id"]);
							?>
							<li>
								<a href="javascript:void(0)" level="2" content_id="<?php echo $secondLevel["content_id"]?>" has_child="<?php echo ((count($hasThirdLevel) > 0) ? 1 : 0) ?>" name_sk="<?php echo $secondLevel["content_name"]?>" name_en="<?php echo $secondLevel["menu_text"]?>" class="<?php echo str_replace("-","_",$secondLevel["content_alias"])?>">
									<?php echo $secondLevel["content_name"]?>
								</a>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
			<?php
		}
	}
	?>
	</div><!--te-wrapper-->
  <?php 
}
?>
