<?php
class Helper
{
	public function getHistoryPage($db, $lang){
		$historyArchive = "";
		$sqlQueryYears = "SELECT DISTINCT YEAR(news_date) as year FROM cms_module_news where news_category_id = 2";
		$resYears = $db->prepare($sqlQueryYears);
		$resYears->execute();
		$allYears = array();
		while ($row = $resYears->fetch(PDO::FETCH_OBJ)){
			$allYears[] = $row->year;
		}
		rsort($allYears);
		$historyArchive .= "<div class='historyArchive'>";
		$historyArchive .= "<h2>".(($lang == "sk") ? "História" : "History")."</h2>";
		$firstYear = true;
		$historyArchive .= "<ul class='yearsList nav nav-pills'>";
		foreach($allYears as $year){
			$historyArchive .= "<li><a href='javascript:void(0)' id='year".$year."' class='".($firstYear ? "active" : "")."' onclick='showArchiveYear(this)'>".$year."</a></li>";
			$firstYear = false;
		}
		$historyArchive .= "</ul>";
		$historyArchive .= "<div class='archiveYear'>";
		$firstYear = true;
		foreach($allYears as $year){
			$sqlQueryHistoryList = "select news_data, summary from cms_module_news
						where status = 'published' and news_category_id = 2 and YEAR(news_date) = ".$year;
			$resHistoryList = $db->prepare($sqlQueryHistoryList);
			$resHistoryList->execute();
			$historyArchive .= "<div class='year".$year." historyYearContent'  style='".($firstYear ? "display:block; height:110px" : "display:none")."'>";
			$historyArchive .= "<h2 class='yearTitle'>".$year."</h2>";
			while ($row = $resHistoryList->fetch(PDO::FETCH_OBJ)){
				$historyArchive .= (($lang == "sk") ? $row->news_data : $row->summary)."</br>";
			}
			$historyArchive .= "</div>";
			$firstYear = false;
		}
		$historyArchive .= "</div>";
		$historyArchive .= "</div>";
		return $historyArchive;
	}
	public function getNewsPage($db,$lang){
		$newsArchive = "";
		$sqlQueryYears = "SELECT DISTINCT YEAR(news_date) as year FROM cms_module_news where news_category_id = 1";
		$resYears = $db->prepare($sqlQueryYears);
		$resYears->execute();
		$newsArchive .= "<div class='newsArchive'>";
		$newsArchive .= "<h2>".(($lang == "sk") ? "Archív noviniek" : "News archive")."</h2>";
		$allYears = array();
		while ($row = $resYears->fetch(PDO::FETCH_OBJ)){
			$allYears[] = $row->year;
		}
		rsort($allYears);
		$newsArchive .= "<ul class='yearsList nav nav-pills'>";
		$firstYear = true;
		foreach($allYears as $year){
			if($year < date("Y")){
				$newsArchive .= "<li><a href='javascript:void(0)' id='year".$year."'  class='".($firstYear ? "active" : "")."' onclick='showArchiveYear(this)'>".$year."</a></li>";
				$firstYear = false;
			}
		}
		$newsArchive .= "</ul>";
		$newsArchive .= "<div class='archiveYear'>";
		$firstYear = true;
		foreach($allYears as $year){
			if($year < date("Y")){
				$sqlQueryNewsList = "select news_title as title_sk, mn.news_id, mnf.value as title_en from cms_module_news mn
							left join cms_module_news_fieldvals mnf on mn.news_id = mnf.news_id
							where mn.status = 'published' and news_category_id = 1 and YEAR(mn.news_date) = ".$year;
				$resNewsList = $db->prepare($sqlQueryNewsList);
				$resNewsList->execute();
				$newsArchive .= "<ul class='year".$year." ".($firstYear ? "active" : "")."' style='".($firstYear ? "display:block" : "display:none")."'>";
				$newsArchive .= "<h2 class='yearTitle'>".$year."</h2>";
				while ($row = $resNewsList->fetch(PDO::FETCH_OBJ)){
					$newsArchive .= "<li>";
					$newsArchive .= "<a href='javascript:void(0)' news_id='".$row->news_id."' name_sk='".$row->title_sk."' name_en='".$row->title_en."' onclick='zobrazNovinku(this)'>";
					$newsArchive .= (($lang == "sk") ? $row->title_sk : $row->title_en);
					$newsArchive .= "</a>";
					$newsArchive .= "</li>";
				}
				$newsArchive .= "</ul>";
				$firstYear = false;
			}
		}
		$newsArchive .= "</div>";
		$newsArchive .= "</div>";
		return $newsArchive;
	}
}