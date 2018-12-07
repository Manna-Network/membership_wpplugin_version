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
    $latest_version = file_get_contents('https://manna-network.cash/plugins/mannanetwork_plugin_version_latest_num.php');

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
<h5><a href="https://manna-network.cash/plugins/mannanetwork_plugin_version.zip">DOWNLOAD THE LATEST VERSION</a></h5>
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
        <td><p>In order for the plugin to function you must 1) Register as a user at <a target="_blank" href="https://Manna-Network.cash/members">MannaNetwork.cash/members</a> 2) Then add THIS* website as a listing/link to the distributed web directory (free and this will advertise your website across the entire network) 3) Watch for the window reporting the Link ID/Affiliate number or refresh or return to your MannaNetwork User Control Panel and retrieve the Link ID from the top of the left column next to this link listing's info. "Link ID" and "Affiliate Number" are synonomous - Enter that Link ID number here -> <input type="text" name="mn_affiliate_num" value="<?php echo $mn_affiliate_num; ?>" /></td>
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
include('mannanetwork-include.php');
	return "";
}

//define("mn_DIR_PROCESSING",dirname(__FILE__)."/processing.php");
define("mn_DIR_ROOT",dirname(__FILE__)."/");
list($url) = explode("/",plugin_basename(__FILE__));
define("mn_DIR_URL","/wp-content/plugins/".$url."/");
define("mn_DIR_MOREINFO","https://manna-network.cash/");
add_shortcode( 'mannanetwork', 'mannanetwork_func' );




