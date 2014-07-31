<?php
include_once(DOCROOT.'/include/basic.class.php');

class cart extends basic {
	function cart(){
	}
	
	function addCart($cartItemId=null, $cartItemNums=1, $cartItemName=null, $cartItemPrice=null){
		if($cartItemId==null)
			return false;
			
		$itemCount = $_SESSION['cart']['itemCount'];
		if (!isset($itemCount) OR $itemCount=='') {
			$itemCount = 0;
		}
			
		$_SESSION['cart']['items'][$itemCount]['id'] = intval($cartItemId);
		$_SESSION['cart']['items'][$itemCount]['num'] = intval($cartItemNums);
		$_SESSION['cart']['items'][$itemCount]['name'] = $cartItemName;
		$_SESSION['cart']['items'][$itemCount]['price'] = floatval($cartItemPrice);

		$itemCount++;
		$_SESSION['cart']['itemCount'] = $itemCount;
	}
	
	function clearCart(){
		unset($_SESSION['cart']);
	}
	
	function getItemsCount(){
		return $_SESSION['cart']['itemCount'];
	}
	
	function getItem($itemIndex=null){
		if($itemIndex===null OR $itemIndex>=$this->getItemsCount())
			return false;
		
		$item = array();
		
		$item['id'] 	= $_SESSION['cart']['items'][$itemIndex]['id'];
		$item['num'] 	= $_SESSION['cart']['items'][$itemIndex]['num'];
		$item['name'] 	= $_SESSION['cart']['items'][$itemIndex]['name'];
		$item['price'] 	= $_SESSION['cart']['items'][$itemIndex]['price'];
		
		return $item;
	}

	function delItem($cartItemNo=null){
		if($cartItemNo==null)
			return false;
			
		$tmpSess = $_SESSION['cart'];
		unset($_SESSION['cart']);
		
		for($i=0, $new_i=0; $i<$tmpSess['itemCount']; $i++){
			if($i!=$cartItemNo){
				// prekopirujem vsetky polozky, okrem tej ktoru mam vymazat
				$_SESSION['cart']['items'][$new_i]['id'] = intval($tmpSess['items'][$i]['id']);
				$_SESSION['cart']['items'][$new_i]['num'] = intval($tmpSess['items'][$i]['num']);
				$_SESSION['cart']['items'][$new_i]['name'] = $tmpSess['items'][$i]['name'];
				$_SESSION['cart']['items'][$new_i]['price'] = floatval($tmpSess['items'][$i]['price']);

				$new_i++;
				$_SESSION['cart']['itemCount'] = $new_i;
			}
		}
	}
}
?>