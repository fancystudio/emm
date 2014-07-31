<?php
function smarty_function_menu_first_level($params, &$template)
{
	$db = cmsms()->GetDb();
	$menuFirstLevel = $db->GetArray("select content_id, content_name, content_alias, menu_text from cms_content where parent_id = -1 and active = 1 order by item_order"); 
	?>
	<ul class="main-menu firstLevel nav nav-pills nav-stacked pull-left w-st-1">     
	<?php 
	foreach($menuFirstLevel as $firstLevel){
		$hasSecondLevel = $db->GetArray("select 88 from cms_content where parent_id = ".$firstLevel["content_id"]);
		?>
		<li>
			<a href="javascript:void(0)" content_id="<?php echo $firstLevel["content_id"]?>" level="1" has_child="<?php echo ((count($hasSecondLevel) > 0) ? 1 : 0) ?>" name_sk="<?php echo $firstLevel["content_name"]?>" name_en="<?php echo $firstLevel["menu_text"]?>" class="<?php echo str_replace("-","_",$firstLevel["content_alias"])?>"><?php echo $firstLevel["content_name"]?></a>
		</li>
		<?php
	}
	?>
	</ul>
	<span class="square sq-2"></span>
	<span class="square sq-3"></span>
	<span class="square sq-5"></span>
	<?php 
}
?>

