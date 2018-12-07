<?php

$regional_num = "";
$link_record_num = "";
$link_page_total = ""; 
$link_page_id = ""; 
$pagem_url_cat = "";
$link_page_num = ""; 
$cat_page_num = ""; 
$category_id = ""; 
$lnk_num = "";

include('agent_config.php');
$args = array();
if(isset($_GET['regional_num'])){$args['regional_num']=  $_GET['regional_num'];}
if(isset($link_record_num)){$args['link_record_num']=  $link_record_num;}
if(isset($link_page_total)){$args['link_page_total']=  $link_page_total;} 
if(isset($link_page_id)){$args['link_page_id']=  $link_page_id; }
if(isset($pagem_url_cat)){$args['pagem_url_cat']=  $pagem_url_cat;}
if(isset($link_page_num)){$args['link_page_num']=  $link_page_num;} 
if(isset($cat_page_num)){$args['cat_page_num']=  $cat_page_num;} 
if(isset($_GET['q'])){$args['category_id']=  $_GET['q']; }
if(isset($lnk_num)){$args['lnk_num']=  $lnk_num;}
$args['http_host']=   $_SERVER['HTTP_HOST'];

$handle = curl_init();
$url = "http://".$agent_url."/mannanetwork-dir/get_regions_json.php";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonregionList = curl_exec($handle);
 curl_close($handle);



require_once('translations/en.php');


$regionList = json_decode($jsonregionList, true);

$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'">
<select name="subLoc3" onchange="updateregionalButton(this.value), showSubLoc4(this.value)">
<option value="">'.WORDING_AJAX_REGIONAL_MENU3.'</option> ';
foreach($regionList as $key=>$value){
 if($regionList[$key]['lft']+1 < $regionList[$key]['rgt']){
	$menu_str .= "<option value='y:" . $regionList[$key]['id'] .":".$regionList[$key]['name'] ."'>".$regionList[$key]['name']."</option>";
	}
	else
	{
	$menu_str .= "<option value='n:" . $regionList[$key]['id']  .":".$regionList[$key]['name'] . "'>".$regionList[$key]['name']."</option>";
	}
}

$menu_str .= '</select><br>

</form>';
echo $menu_str;

?>
