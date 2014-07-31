<?php
function smarty_function_manazment($params, &$template)
{
	$db = cmsms()->GetDb();
	$manazment = $db->GetArray("select htmlblob_name, html, description from cms_htmlblobs where htmlblob_name != 'footer' and htmlblob_name != 'header'");
	?>
	<div class="manazmentHide" style="display:none">
		<?php
		foreach($manazment as $manag){
			?>
			<div class="manazmentPage" name="<?php echo $manag["htmlblob_name"]?>" show="<?php echo $manag["description"]?>">
				<?php
					echo $manag["html"];
				?>
			</div>
			<?php
		}
		?>
	</div>	
	<?php 
}
?>