<?php
   /*
   Plugin Name: Manna Network
   Plugin URI: https://Manna-Network.com
   description: >-
 A plugin to enable websites to earn Bitcoin and gain web traffic
   Version: .1
   Author: robert lefebvre
   Author URI: http://Manna-Network.com
   License: GPL2
   */
   
   function mannanetwork_create_menu() {

	//create new top-level menu
	add_menu_page('MannaNetwork', 'MannaNetwork', 'administrator', __FILE__, 'mannanetwork_settings_page', get_stylesheet_directory_uri('stylesheet_directory')."/images/media-button-other.gif");

	//call register settings function
	add_action( 'admin_init', 'register_manna_member' );
}
add_action( 'admin_menu', 'mannanetwork_create_menu' );

function register_manna_member() {
	//register our settings
	register_setting( 'manna_member-group', 'mn_local_lnk_num' );
	register_setting( 'manna_member-group', 'mn_agent_ID' );
	register_setting( 'manna_member-group', 'mn_agent_url' );
	register_setting( 'manna_member-group', 'mn_agent_folder' );
}

function mannanetwork_settings_page() {
if(get_option('mn_local_lnk_num') AND get_option('mn_local_lnk_num')!="changeme"){
$mn_local_lnk_num = get_option('mn_local_lnk_num');
}
else
{
$mn_local_lnk_num = "change_me";
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
function myplugin_register_settings() {
   add_option( 'myplugin_option_name', 'This is my option value.');
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );
}
add_action( 'admin_init', 'myplugin_register_settings' );

function myplugin_register_options_page() {
  add_options_page('Page Title', 'Plugin Menu', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_option_page()
{
  //content on page goes here
}


?>
<div class="wrap">
<h2>Manna Network Member Configuration</h2>

<form method="post" action="options.php">
    <?php 


settings_fields( 'manna_member-group' ); ?>
    <?php do_settings_sections( 'manna_member-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row" rowspan="3"> &nbsp;</th>
        <td><p>In order for to get proper credit and commissions from the Manna Network you must:<ol><li>Register as a user at one of the agents of the Manna Network (find an agent here <a target="_blank" href="https://Manna-Network.com/agent_sites.php">Manna-Network.com/agent-sites.php</a>)</li><li>Add your website as a listing/link to the distributed web directory (free and this will advertise your website across the entire network)</li><li>Watch for the window reporting the Link ID/Affiliate number or refresh or return to your Manna Network User Control Panel and retrieve the Link ID from the top of the left column next to this link listing's info. "Link ID" and "Affiliate Number" are synonomous</li>
        <li>After/when you register, you not only will receive an affiliate number/link ID but it will also provide you the agent ID of the site you registered at and also the url that your script will connect to there to retrieve data. Please insert those here:</p></li></ol><br>
        Enter that Link ID number here -> <input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_local_lnk_num" value="<?php echo $mn_local_lnk_num; ?>" />
        
        <br>agent_ID -> <input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_ID" value="<?php echo $mn_agent_ID; ?>" />
            <br>agent data recovery url -> <input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_url" value="<?php echo $mn_agent_url; ?>" />
           <br>agent data recovery folder -> <input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_folder" value="<?php echo $mn_agent_folder; ?>" />
        </td>
        </tr>
        <tr><td><p>

    
    <?php submit_button(); ?>
    <tr><td><p>
* It is recommended that you create a landing page for all of your advertising in the network. Then, as a best practice recommendation, do not link to that page from any other page on your website nor use that landing page in any other advertising. Doing so will enable verification of the amount of web traffic your website has gotten from the network. One way to make a custom landing page is to copy your index or home page and save it with a different name (then use that name when you add it to the ad network).
        </td></tr>
         

    </table>
</form>
</div>
<?php }
 function mannanetwork_func( $atts ){
//include(dirname( __FILE__, 1 ).'/mannanetwork-main.php');
include('mannanetwork-main.php');
	return "";
}

define("MN_DIR_ROOT",dirname(__FILE__)."/");
list($url) = explode("/",plugin_basename(__FILE__));
define("MN_DIR_URL","/wp-content/plugins/".$url."/");
define("MN_DIR_MOREINFO","http://www.Manna-Network.com/");
add_shortcode( 'mannanetwork', 'mannanetwork_func' );

