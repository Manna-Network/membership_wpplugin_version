<?php
if(get_option('mn_member_num') AND get_option('mn_member_num')!="changeme"){
$mn_member_num = get_option('mn_member_num');
}
else
{
$mn_member_num = "change_me";
}
if(get_option('mn_agent_ID') AND get_option('mn_agent_ID')!="changeme"){
$mn_agent_ID = get_option('mn_agent_ID');
}
else
{
$mn_agent_ID = "change_me";
}
if(get_option('mn_agent_url') AND get_option('mn_agent_url')!="changeme"){
$mn_agent_url = get_option('mn_agent_url');
}
else
{
$mn_agent_url = "change_me";
}
if(get_option('mn_agent_folder') AND get_option('mn_agent_folder')!="changeme"){
$mn_agent_folder = get_option('mn_agent_folder');
}
else
{
$mn_agent_folder = "change_me";
}

$locus_array = "";
$link_record_num = "";
$link_page_total = ""; 
$link_page_id = ""; 
$pagem_url_cat = "";
$link_page_num = ""; 
$cat_page_num = ""; 
$category_id = ""; 
$lnk_num = "";

//include('member_config.php');
$args = array();
if(isset($locus_array)){$args['locus_array']=  $locus_array;}
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
$url = "http://".$mn_agent_url."/".$mn_agent_folder."/get_category_json.php";
print_r($args);
echo $url;
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);



require_once('translations/en.php');
$q = $_GET['q'];
$args = array(
'locus_array' => $locus_array,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $q, 
'lnk_num' => $lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);


$comboList = json_decode($jsonlinkList, true);
$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"><select name="subCat2" onchange="updatecategoryButton(this.value),showSubCat3(this.value)">
<option value="">'.WORDING_AJAX_MENU1.'</option> ';

foreach($comboList as $key=>$value){

 if($comboList[$key]['lft']+1 < $comboList[$key]['rgt']){
	$menu_str .= "<option value='y:" . $comboList[$key]['id'] .":".$comboList[$key]['name'] ."'>".$comboList[$key]['name']."</option>";
	}
	else
	{
	$menu_str .= "<option value='n:" . $comboList[$key]['id']  .":".$comboList[$key]['name'] . "'>".$comboList[$key]['name']."</option>";
	}
}

$menu_str .= '</select><br>
</form>';
echo $menu_str;

?>

