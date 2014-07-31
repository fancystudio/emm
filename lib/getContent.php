<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);
	if($_POST["get_content"]){
		require_once('../config.php');
		require_once('HelperClass.php');
		$help = new Helper;
		$dsn = "mysql:host=".$config['db_hostname'].";port=".$config['db_port'].";unix_socket=/tmp/mariadb55.sock;dbname=".$config['db_name'];
		//$dsn = "mysql:host=".$config['db_hostname'].";dbname=".$config['db_name'];
		try{
		  $db = new PDO($dsn, $config['db_username'], $config['db_password']);
		  $db->exec("SET CHARACTER SET utf8");
		} catch (Exception $e) {
			echo "Failed: " . $e->getMessage();
		    $db->rollBack();
		}
		$specialPage = false;
		if($_POST["isNews"] == "true"){ //pokial je zvolena novinka alebo archiv noviniek
			if($_POST["content_id"] == -1){ //pokial je archiv novinike vysklada sa potrebne html
				$specialPage = true;
				$newsArchive = $help->getNewsPage($db,$_POST["lang"]);
			}else{ //pokial je zvolena novinka
				$sqlQuery = "select ".(($_POST["lang"] == "sk") ? "news_data" : "summary")." as content, news_id as content_alias from cms_module_news
						where news_id = ".$_POST["content_id"];
			}
		}else if($_POST["content_id"] == 65){ //podstranka historie
			$specialPage = true;
			$newsArchive = $help->getHistoryPage($db,$_POST["lang"]);
		}else{ //klasicka podstranka
			$sqlQuery = "select cp.content, c.content_alias from cms_content c
						left join cms_content_props cp on c.content_id = cp.content_id
						where c.content_id = ".$_POST["content_id"]."
						and cp.prop_name = '".(($_POST["lang"] == "sk") ? "content_en" : "obsah_en")."'";	
		}
		if(!$specialPage){
			$res = $db->prepare($sqlQuery);
			$files = array();
			$res->execute();
		}
		$horizontalCubesCount = (($_POST["fourCubesHorizontal"] == "true") ? 4 : 3);
		if($_POST["type"] == "horizontal"){
			while ($row = ((!$specialPage) ? $res->fetch(PDO::FETCH_OBJ) : true)){
				if($_POST["hasPerspective"] == "true"){
					for($i=1;$i<=$horizontalCubesCount;$i++){
					?>
					<div class="horizontal-box-<?php echo $i; ?> boxHorizontal" style="visibility:hidden;<?php echo (($_POST["fourCubesHorizontal"] == "true") ? "left:-232px" : "")?>">
						<div class="face front">  
		  				</div>	
		  				<div class="face backHorizontal">
		       				<div class="text clipHorizontal<?php echo $i; ?> podstranka <?php echo ((!$specialPage) ? $row->content_alias : "newsArchive") ?>">
		       				<?php echo ((!$specialPage) ? $row->content : $newsArchive); ?>
		       				</div>
		    			</div>	 
					</div>
					<?php 
					} 
				}else{
					?>
					<div class="text clipHorizontal<?php echo $i; ?> podstranka <?php echo ((!$specialPage) ? $row->content_alias : "newsArchive") ?>" style="visibility:visible">
						<?php
						echo ((!$specialPage) ? $row->content : $newsArchive);
						?>
					</div>
					<?php 
				}
				break;
			}
		}
		if($_POST["type"] == "vertical" && $_POST["hasPerspective"] == "true"){
		while ($row = ((!$specialPage) ? $res->fetch(PDO::FETCH_OBJ) : true)){
			for($i=1;$i<=$horizontalCubesCount;$i++){
				?>
				<div class="containerVertical-<?php echo $i?>">
				<?php 
				for($j=1;$j<=$_POST["cubesCount"];$j++){
					if($i == 1){
						$style = "top: ".($j * 232 * -1)."px; "." rect(".($j * 232)."px, 232px, ".((1+$j) * 232)."px, 0px)";
					}else if($i == 2){
						$style = "top: ".($j * 232 * -1)."px; left : -232px; rect(".($j * 232)."px, 464px, ".((1+$j) * 232)."px, 232px)";
					}else{
						$style = "top: ".($j * 232 * -1)."px; left : -".(($i-1) * 232)."px; rect(".($j * 232)."px, 696px, ".((1+$j) * 232)."px, 464px)";
					}
					?>
					<div class="boxVertical vertical-box-<?php echo $j?>-<?php echo $i?>" style="display: block;">
						<div class="face front">
					    </div>
					    <div class="face backVertical">
					      <div class="text podstranka <?php echo ((!$specialPage) ? $row->content_alias : "newsArchive") ?>" style="<?php echo $style?>">
					      	<?php echo ((!$specialPage) ? $row->content : $newsArchive); ?>
					      </div> 
					    </div>
					</div>
					<?php
				}	
				?>
				</div>
				<?php 
			}
			break;
		}
	}
	}
?>