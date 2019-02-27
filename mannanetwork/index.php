<?php 
include('includes/bootstrap_header.php');
include('translations/en.php');
include("js/registration.js");
include("translations/en.js"); 

//verify that the lnk (i.e link) number above is yours to insure your lnk credit and payments
//change the above text "change_me" to your lnk_number. You should have gotten an email containing it. If you lost it you can retrieve it by logging in at BungeeBones.com/members 
include('member_config.php');
//now we will put in a new check to make sure they changed their link_num
if ($lnk_num == "change_me" OR $lnk_num == ""){
$url = $_SERVER['SERVER_NAME'];
$args = array(
'http_host' =>   $_SERVER['HTTP_HOST']
);
$file="http://".$agent_url."/".$agent_folder.'/wp_errors/no_link_id.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);
exit();
}



$category_id = '';
$cat_page_num = '';
$link_page_num = '';
$pagem_url_cat = '';
$link_page_id = '';
$link_page_total = '';
$link_record_num = '';
$regional_num = '' ;
//These following links open the endorsement folder's pages in the endorsements directory. You can edit their wording as you wish.
echo '<a href="'.$_SERVER['PHP_SELF'].' ">Top Level</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?add_url=true&lnk_num='.$lnk_num.'">Add URL</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?earn_income=true&lnk_num='.$lnk_num.'">Earn Income</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?about_bitcoin=true&lnk_num='.$lnk_num.'">About Bitcoin</a>';

if(ISSET($_GET['add_url'])){
include('endorsements/add_url.php');
exit();
}
elseif(ISSET($_GET['earn_income'])){
include('endorsements/earn_income.php');
exit();
}
elseif(ISSET($_GET['about_bitcoin'])){
include('endorsements/about_bitcoin.php');
exit();
}
//those first three called from main web directory page and the menu above
elseif(ISSET($_GET['get_hosting'])){
include('endorsements/get_hosting.php');
exit();
}
elseif(ISSET($_GET['get_plugin'])){
include('endorsements/get_plugin.php');
exit();
}
elseif(ISSET($_GET['get_php_code'])){
include('endorsements/get_php_code.php');
exit();
}
//print_r($_POST);

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$category_id = 1;
}

elseif( array_key_exists('q', $_GET) AND ISSET($_GET['q'])){
//NOTE category id comes in from main menu
$category_id = $_GET['q'];
}
elseif( array_key_exists('category_id', $_GET) AND ISSET($_GET['category_id'])){
//NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU
$category_id = $_GET['category_id'];
}
elseif(array_key_exists('category_id', $_POST) && ISSET($_POST['category_id'])){

//NOTE q comes in from dropdown 
$category_id = $_POST['category_id'];
}
//both determiine what links are shown via category id var

if(ISSET($category_id) && $category_id !="") {
if(array_key_exists('cat_page_num', $_POST) AND ISSET($_POST['cat_page_num'])){
$cat_page_num = $_POST['cat_page_num'];}
if(array_key_exists('link_page_num', $_POST) AND ISSET($_POST['link_page_num'])){
$link_page_num = $_POST['link_page_num'];}
if(array_key_exists('pagem_url_cat', $_POST) AND ISSET($_POST['pagem_url_cat'])){
$pagem_url_cat = $_POST['pagem_url_cat'];}
if(array_key_exists('link_page_id', $_POST) AND ISSET($_POST['link_page_id'])){
$link_page_id = $_POST['link_page_id'];}
if(array_key_exists('link_page_total', $_POST) AND ISSET($_POST['link_page_total'])){
$link_page_total = $_POST['link_page_total'];}
if(array_key_exists('link_record_num', $_POST) AND ISSET($_POST['link_record_num'])){
$link_record_num = $_POST['link_record_num'];}
if(array_key_exists('regional_num', $_POST) AND ISSET($_POST['regional_num'])){
$regional_num = $_POST['regional_num'] ;
}

$args = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);


$handle = curl_init();
$url1 = "http://".$agent_url."/".$agent_folder."/get_category_json.php";

// Set the url
curl_setopt($handle, CURLOPT_URL, $url1);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsoncatList = curl_exec($handle);
 curl_close($handle);

echo ' 
          <div class="table-responsive">
            <table class="table table-striped table-sm">
             <tbody>
<tr rowspan="2">
                  <td>
<h2>Select Category</h2>';

$categoryList = json_decode($jsoncatList, true);


$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"><select name="category_id" onchange="updatecategoryButton(this.value,\'0:0:0\'), showSubCat1(this.value)"><option value="">'.WORDING_AJAX_MENU1.'</option> ';

foreach($categoryList as $key=>$value){
 if($categoryList[$key]['lft']+1 < $categoryList[$key]['rgt']){
	$menu_str .= "<option value='y:" . $categoryList[$key]['id'] .":".$categoryList[$key]['name'] ."'>".$categoryList[$key]['name']."</option>";
	}
	else
	{
	$menu_str .= "<option value='n:" . $categoryList[$key]['id']  .":".$categoryList[$key]['name'] . "'>".$categoryList[$key]['name']."</option>";
	}
}
$menu_str .= '</select><br>
      <div id="txtHint1" name="txtHint1"><b>More Subcategories Available After Selection.</b></div>
		          <div id="txtHint2" name="txtHint2"><b></b></div>
		           <div id="txtHint3" name="txtHint3"><b></b></div>
		            <div id="txtHint4" name="txtHint4"><b></b></div>
<p id="goLink" name="goLink"><b></b></p>
<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="category_name"  class="category_name" name="category_named" value="">
<input type="hidden" id="category_id" name="category_id" class ="category_id" value="" readonly>

</form>
</div>
<!--
</td>
</tr>
<tr>
<td width style=" vertical-align: text-top;">
	<div style="width: 500px;">
		<table width = "100%">
		<tr><td  id="summary_header" class="summary_header" name="summary_header">
		<div class="summary" id="summary" name="summary"></div>
<div class="accordian" id="accordian" name="accordian"></div>
		</td></tr>
	<!--	</table>
	</div>-->';
echo $menu_str;

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$category_id = $_GET['gocat'];
unset($_GET['gocat']);
unset($_POST['q']);
}

// NOW CHECK AND BUILD REGIONAL FILTER MENU
////????????????????????????????????????????????????????????????????????????????????????????????????????????????????????///////////////////////////
//note let's try to merge this args with the one above but this one we are trying using a single regional num instead of locus array?

$args2 = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);
$handle = curl_init();
$url1 = "http://".$agent_url."/".$agent_folder."/get_regions_json.php";

// Set the url
curl_setopt($handle, CURLOPT_URL, $url1);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args2); //use same args as other queries
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonregionList = curl_exec($handle);
 curl_close($handle);

//echo '<h2>Select Regional Filters?</h2>';
echo '<BR><BR>'.WORDING_REGIONAL_FILTERS_LABEL;
$regionList = json_decode($jsonregionList, true);


$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"><select name="regional_num" onchange="updateregionalButton(this.value), showSubLoc1(this.value)"><option value="">'.WORDING_AJAX_REGIONAL_MENU1.'</option> ';

//foreach($regionList as $key=>$value){
// if($regionList[$key]['lft']+1 < $regionList[$key]['rgt']){
	$menu_str .= "
<option value='y:2566:Africa'>Africa</option>
<option value='y:2567:America - Central'>America - Central</option>
<option value='y:2568:America - North'>America - North</option>
<option value='y:2569:America - South'>America - South</option>
<option value='y:2572:Asia'>Asia</option>
<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
<option value='y:2756:Caribbean'>Caribbean</option>
<option value='y:2575:Europe'>Europe</option>
<option value='y:2740:Middle East'>Middle East</option>";
//	}
//	else
//	{
//	$menu_str .= "<option value='n:" . $regionList[$key]['id']  .":".$regionList[$key]['name'] . "'>".$regionList[$key]['name']."</option>";
//	}
//}
$menu_str .= '</select><br>
      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
		          <div id="locHint2" name="locHint2"><b></b></div>
		           <div id="locHint3" name="locHint3"><b></b></div>
		            <div id="locHint4" name="locHint4"><b></b></div>
<div id="locHint5" name="locHint5"><b></b></div>
<div id="locHint6" name="locHint6"><b></b></div>
<p id="filterLink" name="filterLink"><b></b></p>
<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="regional_name"  class="regional_name" name="regional_named" value="">
<input type="hidden" id="regional_num" name="regional_num" class ="regional_num" value="" readonly>

</form>

</td><td>
';
echo $menu_str;

if( array_key_exists('regional_num', $_GET) AND ISSET($_GET['regional_num'])){
//NOTE category id comes in from main menu
$regional_num = $_GET['regional_num'];
unset($_GET['regional_num']);
unset($_POST['regional_num']);
}


//



// NOW USE THE ABOVE TWO CRITERIA CHECK, RETRIEVE AND DISPLAY LINKS



$args2 = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);


$handle = curl_init();
$url2 = "http://".$agent_url."/".$agent_folder."/get_links_json.php";

// Set the url
curl_setopt($handle, CURLOPT_URL, $url2);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args2);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinksList = curl_exec($handle);
//echo $jsonlinksList;

$linksList2 = json_decode($jsonlinksList, true);
 curl_close($handle);

if(sizeof($linksList2) > 20){
		//we need to run the paginator
	$number_of_pages =ceil(sizeof($linksList2)/20);

	echo '<div>';


$menu = "";
foreach (range(1, $number_of_pages) as $number) {	
	if($number == 1 ){
	$lower_limit = 1;
	$upper_limit = 19;
	}
	elseif($number > 1 AND $number != $number_of_pages)//do some math to fetch the limits)
	{
	$lower_limit = 20* ($number - 1);
	$upper_limit = (20* $number) -1;
	}
	else
	{
	$lower_limit = 20* ($number - 1);
	$number_of_links_on_last_page = sizeof($linksList2)% 20;
	$upper_limit = $lower_limit + $number_of_links_on_last_page ;
	}

	
$newtable[$number] = $number."|";

	foreach (range($lower_limit, $upper_limit) as $key) {
if($key < sizeof($linksList2) ){
$newtable[$number] .=  '<tr><td><a target="_blank" href="http://';
$newtable[$number] .=  $linksList2[$key]['url'];
$newtable[$number] .=  '">';
$newtable[$number] .=  $linksList2[$key]['name'];
$newtable[$number] .=  '</a><br>';
$newtable[$number] .=  $linksList2[$key]['description']; 

	if(isset( $linksList2[$key]['website_street'])){
	$newtable[$number] .=  '<br>'. $linksList2[$key]['website_street']; 
	$newtable[$number] .=  '<br>'. $linksList2[$key]['website_district']; 
	}
		$newtable[$number] .=  '</td> </tr>';
	}
}
$menu .= "<a href=\"\" onclick=\"updatelinks('";
$encodednewtable = htmlentities($newtable[$number]);
$menu .= $encodednewtable;
//$menu .= "|";
//$menu .= $number;
$menu .= "'); return false;\">";
$menu .= WORDING_LINKEXCHANGE_PAGE_NAME;
$menu .= ' #' ;
$menu .=  $number;
$menu .=  "</a>&nbsp;|&nbsp;";
}

echo '<h4>', $menu;
echo '</h4>';

$newTable = '<div id="manna_link_container" name="manna_link_container"><table><tbody>';
if(array_key_exists('page_number', $_GET) AND ISSET($_GET['page_number'])){
	$current_page_number = $_GET['page_number'];
$newTable .= $newtable[$current_page_number];
	}
	else
	{
	$current_page_number = 1;
$pieces=explode("|", $newtable[$current_page_number]);
$newTable .= $pieces[1];
	}





$newTable .= "</tbody></table></div>";

echo $newTable;

}
else
{
	echo '<div id="manna_link_container"><table> <tbody>';
	foreach($linksList2 as $key=>$value){

	echo '<tr><td><a target="_blank" href="http://'. $linksList2[$key]['url'].'">'.$linksList2[$key]['name'].'</a> 
	<br>'. $linksList2[$key]['description']; 
		if(isset( $linksList2[$key]['website_street'])){
		echo '<br>'. $linksList2[$key]['website_street']; 
		echo '<br>', $linksList2[$key]['website_district']; 
		}
	echo '</td> </tr>';
	}
}
echo '   </tbody>
    </table>
  </div>';

}
else
{

 
$display_main = '<form name="main_category_form" method="post" action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"> <input type="hidden" name="category_id" />
<input type="hidden" name="B1" />';
$display_main .= "<table>";
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'60\')">Accessories</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1307\')">Games</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'65\')">Art/Photo/Music</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1330\')">Health</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'69\')">Automotive</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1375\')">Home</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'10023\')">Bitcoin</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1401\')">Kids &amp; Teens</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'102\')">Books/Media</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1415\')">News</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'111\')">Business</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'2822\')">Professional</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'125\')">Careers</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'3\')">Real Estate</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'126\')">Clothes/Apparel</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1275\')">Recreation</a></td></tr>';

$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'134\')">Commerce</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'1438\')">Reference</td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'9\')">Computers/Internet</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'8\')">Religion</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'148\')">Education</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'10010\')">Sales_Reps</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'147\')">Electronics</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'2799\')">Services</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'2198\')">Environment</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'2027\')">Shopping</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'2702\')">Finance</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'2068\')">Society</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'10000\')">Food/Restaurants</a></td><td class="main_menu" ><a href="javascript:select_main_category(\'2098\')">Sports</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'&nbsp;\')"></a></td><td class="main_menu" ><a href="javascript:select_main_category(\'124\')">Travel</a></td></tr>';
$display_main .= "</table></form>";

echo $display_main;


}
include('includes/bootstrap_footer.php');
//echo '</body></html>';
?>


