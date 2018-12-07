<?php

/*
	Plugin Name: MannaNetwork
	Plugin URI: http://www.mannanetwork.cash/
	Description: MannaNetwork is both a new way to monetize the traffic of your website and to draw traffic to it. It adds a completely managed website directory to your Wordpress where visitors can add the links and descriptions to their own websites across the whole MannaNetwork ad network. They, too, also have the posibility to add new website directories. Each new installation adds to the amount of web traffic that the listings are exposed to. As the network grows, advertising in it will become more valuable, users can bid for better placement, and each installation also gets to sell the network web traffic for sizable and long term commissions. Every 24 hours the plugin runs a formula to calculate the earnings of every website and makes it available for that site to purchase advertising with their earnings (if they wish). 
	Version: 0.12
	Author: Robert Lefebure
	Author URI: http://www.mannanetwork.cash
	License: GPL2
*/


// Don't allow loading the page directly from plugin directory
//$page_name_end = end(explode("/",$_SERVER['SCRIPT_FILENAME']));

/**
 * Register a custom menu page.
 */
update_option( 'mannanetwork_version', '.12' );
function mannanetwork_check_for_new_version() {
    $last_check = get_option('mannanetwork_lastcheck');
 if ( $last_check + 86400 > time() ) { return; }
    // If we're still here, check your site for a new version.
    $current_version = get_option('mannanetwork_version');
    $latest_version = file_get_contents('http://manna-network.cash/plugins/mannanetwork_plugin_version_latest_num.php');

    if ( $current_version != $latest_version ) {
        ?>
        <div style="background: #FFDDDD; color: red; width: 600px; 
                    margin: 20px auto; padding: 10px; text-align: center;
                    border: 2px red solid;"><p style="float: left; padding-left: 20px">
                <img src="http://mannanet-work.cash/plugins/B2Boval75.png" />
            </p>

            There's a new version of Manna Network available! 
You are running version <?echo $current_version; echo "<br>Version ", $latest_version; echo " is available.<br>"; ?>
<h4>You should upgrade now.</h4>
<h5><a href="http://manna-network.cash/plugins/mannanetwork_plugin_version.zip">DOWNLOAD THE LATEST VERSION</a></h5>
        </div>
        <?php
    }
    // Log that we've checked for an update now.
    update_option('mannanetwork_lastcheck', time());
}

add_action('admin_notices', 'mannanetwork_check_for_new_version');
function mannanetwork_create_menu() {

	//create new top-level menu
	add_menu_page('MannaNetwork', 'MannaNetwork', 'administrator', __FILE__, 'mannanetwork_settings_page', get_stylesheet_directory_uri('stylesheet_directory')."/images/media-button-other.gif");

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}
add_action( 'admin_menu', 'mannanetwork_create_menu' );

function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'mn_affiliate_num' );
	register_setting( 'my-cool-plugin-settings-group', 'save_registrants_locally' );
	register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
}

function mannanetwork_settings_page() {
if(get_option('mn_affiliate_num') AND get_option('mn_affiliate_num')!= "changeme"){
$mn_affiliate_num = get_option('mn_affiliate_num');
}
else
{
$mn_affiliate_num = "change_me";
}
?>
<div class="wrap">
<h2>MannaNetwork Configuration</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Affiliate Number</th>
        <td><p>In order for the plugin to function you must 1) Register as a user at <a target="_blank" href="http://Manna-Network.cash/members">MannaNetwork.cash/members</a> 2) Then add THIS* website as a listing/link to the distributed web directory (free and this will advertise your website across the entire network) 3) Watch for the window reporting the Link ID/Affiliate number or refresh or return to your MannaNetwork User Control Panel and retrieve the Link ID from the top of the left column next to this link listing's info. "Link ID" and "Affiliate Number" are synonomous - Enter that Link ID number here -> <input type="text" name="mn_affiliate_num" value="<?php echo $mn_affiliate_num; ?>" /></td>
        </tr>
         
  <!--      <tr valign="top">
        <th scope="row">Save_Registrants_Locally</th>
        <td><p>If you want to receive the names, emails, and the user IDs of all the persons that join the ad network by registering here then check this box. The purpose is to enable you to contact them (with their permission) and help them grow their own user base and downline. You must agree to the terms of use and this permission may be revoked by the users that register. 

<input type="checkbox" name="save_registrants_locally" value="on" <?if(get_option('save_registrants_locally')=="on") echo "checked";?>/></td>

        </tr> 
        
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr> -->
    </table>
    
    <?php submit_button(); ?>
* It is recommended that you create a landing page for advertising in the network. Do not link to that page from any other page on your website nor submit that landing page to any other online advertising. Such a landing page will enable verification of the amount of web traffic your website has gotten from the network. One way to make a custom landing page is to copy your index or home page and save it with a different name (then use that name when you add it to the ad network).
</form>
</div>
<?php }
 function mannanetwork_func( $atts ){
global $options;
include('agent_config.php');

include('translations/en.php');

include("js/registration.js");
include("translations/en.js"); 
include('agent_config.php');
//wp_enqueue_script( 'registration', 'js/registration.js' );
//wp_enqueue_script( 'translationsen', 'translations/en.js' );
$affiliate_num = get_option( 'mn_affiliate_num' );
echo plugins_url();
echo '<br>', plugin_dir_url('mannanetwork-include.php');
echo '<br>',plugin_dir_path('mannanetwork-include.php');
echo '<br>',plugin_basename('mannanetwork-include.php');
echo '<br>';

//temp for development
$affiliate_num = 104;

if ($affiliate_num == "change_me" OR $affiliate_num==""){
$url = $_SERVER['SERVER_NAME'];
echo '<br> url to send = ', $url;
$args = array(
'http_host' =>   $_SERVER['HTTP_HOST']
);

$file="http://".$agent_url."/".$agent_link_folder.'/wp_errors/no_link_id.php';
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

$url_cat = '';
$cat_page_num = '';
$link_page_num = '';
$pagem_url_cat = '';
$link_page_id = '';
$link_page_total = '';
$link_record_num = '';
$locus_array = '' ;

$plugins_url = plugins_url();
$user_ID = get_current_blog_id();

//These following links open the endorsement folder's pages in the endorsements directory. You can edit their wording as you wish.
echo '<a href="'.$_SERVER['PHP_SELF'].' ">Top Level</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?add_url=true&affiliate_num='.$affiliate_num.'">Add URL</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?earn_income=true&affiliate_num='.$affiliate_num.'">Earn Income</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?about_bitcoin=true&affiliate_num='.$affiliate_num.'">About Bitcoin</a>';

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

$args = array('regional_num' => $regional_num, 'link_record_num' => $link_record_num, 'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat, 'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'category_id' => $category_id, 'lnk_num' => $lnk_num, 'http_host' =>   $_SERVER['HTTP_HOST']
);
$handle = curl_init();
$url1 = "http://".$agent_url."/mannanetwork-dir/get_category_json.php";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url1);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsoncatList = curl_exec($handle);
 curl_close($handle);
           echo '<div class="table-responsive">
            <table class="table table-striped table-sm">
             <tbody><tr rowspan="2"> <td><h2>Select Category</h2>';
$categoryList = json_decode($jsoncatList, true);
$menu_str = '<form action=""><select name="category_id" onchange="updatecategoryButton(this.value,\'0:0:0\'), showSubCat1(this.value)"><option value="">'.WORDING_AJAX_MENU1.'</option> ';
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
</form></div><!--</td></tr><tr>
<td width style=" vertical-align: text-top;">
	<div style="width: 500px;">
		<table width = "100%">
		<tr><td  id="summary_header" class="summary_header" name="summary_header">
		<div class="summary" id="summary" name="summary"></div>
<div class="accordian" id="accordian" name="accordian"></div>
		</td></tr><!--	</table></div>-->';
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
/*
$args2 = array('regional_num' => $regional_num,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id,
'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'category_id' => $category_id, 'lnk_num' => $lnk_num,'http_host' =>   $_SERVER['HTTP_HOST']
);
$handle = curl_init();
$url1 = "http://".$agent_url."/mannanetwork-dir/get_regions_json.php";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url1);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args2); //use same args as other queries
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonregionList = curl_exec($handle);
 curl_close($handle);

//echo '<h2>Select Regional Filters?</h2>';
echo '<BR><BR>'.WORDING_REGIONAL_FILTERS_LABEL;
$regionList = json_decode($jsonregionList, true); */
$menu_str = '<form action=""><select name="regional_num" onchange="updateregionalButton(this.value), showSubLoc1(this.value)"><option value="">'.WORDING_AJAX_REGIONAL_MENU1.'</option> ';
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
</form></td><td>';
echo $menu_str;

	if( array_key_exists('regional_num', $_GET) AND ISSET($_GET['regional_num'])){
	//NOTE category id comes in from main menu
	$regional_num = $_GET['regional_num'];
	unset($_GET['regional_num']);
	unset($_POST['regional_num']);
	}
// NOW USE THE ABOVE TWO CRITERIA CHECK, RETRIEVE AND DISPLAY LINKS
$args2 = array('regional_num' => $regional_num,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total,'link_page_id' => $link_page_id,'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'category_id' => $category_id, 'lnk_num' => $lnk_num,'http_host' =>   $_SERVER['HTTP_HOST']);

$handle = curl_init();
$url2 = "http://".$agent_url."/mannanetwork-dir/get_links_json.php";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url2);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args2);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);
$linksList2 = json_decode($jsonlinkList, true);
//echo '<br>$linkList = ', $linkList;
//print_r($linkList);



//$data = array( 'key1' => 'value1', 'key2' => 'value2' );
//print_r( $linksList2);
//print_r( $linksList2['response']);
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
echo '   </tbody></table></div>';
}
else
{
 
$display_main = '<form name="main_category_form" method="post" action=""> <input type="hidden" name="category_id" />
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
	return "";
}

//define("mn_DIR_PROCESSING",dirname(__FILE__)."/processing.php");
define("mn_DIR_ROOT",dirname(__FILE__)."/");
list($url) = explode("/",plugin_basename(__FILE__));
define("mn_DIR_URL","/wp-content/plugins/".$url."/");
define("mn_DIR_MOREINFO","http://manna-network.cash/");
add_shortcode( 'mannanetwork', 'mannanetwork_func' );




