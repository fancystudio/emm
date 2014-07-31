<?php
function smarty_function_menu_third_level($params, &$template)
{
	?>
	<div class="menuThirdLevelBuild nav-level-3">
		<?php 
		$db = cmsms()->GetDb();
		$menuFirstLevel = $db->GetArray("select content_id, content_alias from cms_content where parent_id = -1 and active = 1 order by item_order");
		foreach($menuFirstLevel as $firstLevel){
			$menuSecondLevel = $db->GetArray("select content_id, content_name, content_alias, menu_text from cms_content where active = 1 and parent_id = ".$firstLevel["content_id"]." order by item_order"); 
			if(count($menuSecondLevel) > 0){
				foreach($menuSecondLevel as $secondLevel){
					$contentAlias = "";
					$menuSk = "";
					$menuThirdLevel = $db->GetArray("select cp.content, c.content_id, c.content_name, c.content_alias, c.menu_text from cms_content c 
													left join cms_content_props cp on c.content_id = cp.content_id
													where c.parent_id = ".$secondLevel["content_id"]." and cp.prop_name = 'content_en' and c.active = 1
													order by c.item_order");		
					if(count($menuThirdLevel) > 0){
						$menuSk = "<ul class='thirdLevel'>";
						foreach($menuThirdLevel as $thirdLevel){	
							$menuThirdLevelSubmenu = $db->GetArray("select cp.content, c.content_id, c.content_name, c.content_alias, c.menu_text from cms_content c 
													left join cms_content_props cp on c.content_id = cp.content_id
													where c.parent_id = ".$thirdLevel["content_id"]." and cp.prop_name = 'content_en' and c.active = 1
													order by c.item_order");						
							$contentAliasThird = $secondLevel["content_alias"];
							$hasContent = false;
							if($thirdLevel["content"] != "" && $thirdLevel["content"] != "<!-- Add code here that should appear in the content block of all new pages -->" && !(strpos($thirdLevel["content"], '@@@') !== FALSE)){
								$hasContent = true;
							}
							$menuSk .= "<li>
											<a href='javascript:void(0)' level='3' ".($hasContent ? "" : "style='cursor:text'")." content_id='".($hasContent ? $thirdLevel["content_id"] : "-1")."' has_child='0' name_sk='".$thirdLevel["content_name"]."' name_en='".$thirdLevel["menu_text"]."' class='".str_replace("-","_",$contentAliasThird)."'>
												".$thirdLevel["content_name"]."
											</a>";
							if(count($menuThirdLevelSubmenu) > 0){
								$contentAliasFourth = $thirdLevel["content_alias"];
								$menuSk .= "<ul class='thirdLevelSubmenu'>";
								foreach($menuThirdLevelSubmenu as $thirdLevelSubmenu){
									$hasContentSubmenu = false;
									if($thirdLevelSubmenu["content"] != "" && $thirdLevelSubmenu["content"] != "<!-- Add code here that should appear in the content block of all new pages -->" && !(strpos($thirdLevelSubmenu["content"], '@@@') !== FALSE)){
										$hasContentSubmenu = true;
									}
									$menuSk .= "<li>
													<a href='javascript:void(0)' level='4' ".($hasContentSubmenu ? "" : "style='cursor:text'")." content_id='".($hasContentSubmenu ? $thirdLevelSubmenu["content_id"] : "-1")."' has_child='0' name_sk='".$thirdLevelSubmenu["content_name"]."' name_en='".$thirdLevelSubmenu["menu_text"]."' class='".str_replace("-","_",$contentAliasFourth)."'>
														".$thirdLevelSubmenu["content_name"]."
													</a>
												</li>";
								}	
								$menuSk .= "</ul>";
							}
							$menuSk .= "</li>";
						}
						$menuSk .= "</ul>";
						?>
						<div class="menuThirdLevel <?php echo str_replace("-","_",$contentAliasThird);?> sk">
							<div class="third-level-menu-box-1 menuVertical" style="visibility:hidden">
								<div class="face front"></div>	
						  		<div class="face backVertical">
						       		<div class="text">
						       			<?php echo $menuSk;?>
						            </div>
						    	</div>	 
							</div>
							<div class="third-level-menu-box-2 menuVertical" style="visibility:hidden">
								<div class="face front"></div>	
						  		<div class="face backVertical">
						       		<div class="text">
						       			<?php echo $menuSk;?>
						            </div>
						    	</div>	 
							</div>
							<div class="third-level-menu-box-3 menuVertical" style="visibility:hidden">
								<div class="face front"></div>	
						  		<div class="face backVertical">
						       		<div class="text">
						       			<?php echo $menuSk;?>
						            </div>
						    	</div>	 
							</div>
							<div class="third-level-menu-box-4 menuVertical" style="visibility:hidden">
								<div class="face front"></div>	
						  		<div class="face backVertical">
						       		<div class="text">
						       			<?php echo $menuSk;?>
						            </div>
						    	</div>	 
							</div>
							<div class="third-level-menu-box-5 menuVertical" style="visibility:hidden">
								<div class="face front"></div>	
						  		<div class="face backVertical">
						       		<div class="text">
						       			<?php echo $menuSk;?>
						            </div>
						    	</div>	 
							</div>
							<div class="third-level-menu-box-6 menuVertical" style="visibility:hidden">
								<div class="face front"></div>	
						  		<div class="face backVertical">
						       		<div class="text">
						       			<?php echo $menuSk;?>
						            </div>
						    	</div>	 
							</div>
							<div class="fakeMenuDiv">
								<div class="text">
					       			<?php echo $menuSk;?>
					            </div>
							</div>
						</div>
						<?php 
					}
				}
			}
		}
		?>		
	</div>
  <?php 
}
?>
