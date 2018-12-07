<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("WORDING_CATEGORY_HEADER", "<h4>SELECT CATEGORY</h4>");
define("WORDING_LINKEXCHANGE_PAGE_NAME", "PAGE");
define("WORDING_REGIONAL_FILTERS_LABEL", "<h4>FILTER BY<BR>LOCATION</h4>");
define("WORDING_AJAX_1", "More Subcategories Available After Selection");
define("WORDING_AJAX_2", "<h3>Still More Subcategories To Choose From</h3>");
define("WORDING_AJAX_MENU1", "Select a Sub-Category (optional)");
define("WORDING_AJAX_MENU2", "A Deeper Sub-Category? (optional)");
define("WORDING_AJAX_REGIONAL_FILTER_LABEL", "Smaller Regions Available After Selection");
define("WORDING_AJAX_REGIONAL_MENU1", "Filter By Region (optional)");
define("WORDING_AJAX_REGIONAL_MENU2", "Filter By State (optional)");
define("WORDING_AJAX_REGIONAL_MENU3", "Filter By City (optional)");

define("SUMMARY_AJAX_HEADER", "<h4>The report below will be adjusted to reflect the bidding and competition in the category and/or location you selected. As a general rule, the higher the category or location, the lower your free link will be displayed or the more expensive the bid required to get better placement will be.</h4> ");
define("SUMMARY_AJAX_NUM_LINKS", "<p>Total links in the category: ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT1", "<p>Your free link will begin being displayed on page ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT2", " at the ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT3", "  position. ");
define("SUMMARY_AJAX_MIN_DEMO_BID1", "<p>You will receive free \"Demo Coin\" to bid with in the amount of ");
define("SUMMARY_AJAX_MIN_DEMO_BID2", "<p>The minimum Demo Coin bid (enough to place your link ahead of all free links) is ");
define("SUMMARY_AJAX_MIN_BCH_BID1", " (per month). <p>There are ");
define("SUMMARY_AJAX_MIN_BCH_BID2", " Bitcoin Cash paying advertisers in this category. <p>The lowest BCH price (per month) is ");
define("SUMMARY_AJAX_MIN_BCH_BID3", "");
define("SUMMARY_AJAX_MIN_BCH_BID4", " (per month) <p> The hightest Demo Coin bidder currently is  ");
define("SUMMARY_AJAX_MIN_BCH_BID5", " (per month) <p>Price to acquire the top Demo Coin display position ");
define("SUMMARY_AJAX_MIN_BCH_BID6", " (per month).<p> The highest Bitcoin Cash bidder currently is  ");
define("SUMMARY_AJAX_MIN_BCH_BID7", " (per month) <p>Price to acquire the top Bitcoin Cash(i.e. overall # 1) display position: ");
define("SUMMARY_AJAX_MIN_BCH_BID8", " (BCH per month)");

define("MORE_INFO_PAGE", '<div  style="width: 500px;  margin-left: auto ;
  margin-right: auto ;">For <b>More Info</b> about the bidding system ');

define("MORE_INFO_PAGEEND", 'Click Here</a></div>');


define("WORDING_AJAX_FREE_POSITION0", "<ul><li><u><b>Free sites</b></u> are listed and ordered according to their seniority (i.e. the date/time they registered).
</li><li><u><b>\"Demo coins\"</b></u>  are given to each new listing in the ad network (you will receive ");



define("WORDING_AJAX_FREE_POSITION01", " demo coin) which can be used to <u>purchase better position</u>.</li><li><u><b>The site you registered at </b></u> will \"earn\" a 50% commission of the demo coin you spend. </li><li><u><b>The demo system</b></u> demonstrates not only how to bid for better position but also how websites with our API earn income from the subscribers they registered. They can, thus, maintain their own bidding positions just from the commissions of new recruits.
</li><li><u><b> Ads paid with Bitcoin Cash</b></u>  are even better. They are displayed ahead of both Demo paying ads and free ads.And like with the demo coin, the website where the advertiser registered at earn commission but this time in real money (i.e. cryptocurrency) that has value. They can still spend it to buy better positions or they can withdraw them as \"profit\" from their website! </li>");
define("WORDING_AJAX_FREE_POSITION1", "<li><u><b>Your free listing</b></u> will initially be positioned at the ");
define("WORDING_AJAX_FREE_POSITION2", " position which will be on page ");
define("WORDING_AJAX_FREE_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION1", " of the category. If you use the free \"Demo Coin\" (which you will receive immediately after registration) to bid for better position, then the minimum bid (");
define("WORDING_AJAX_DEMO_POSITION1B", " demo coin) would move your listing ahead of all free links and up to position ");


define("WORDING_AJAX_DEMO_POSITION2", ", which will be on page ");
define("WORDING_AJAX_DEMO_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION4", ", </li><li> There are already ");
define("WORDING_AJAX_DEMO_POSITION5", ", <u>advertisers</u> that have bid using their demo coin AND ");
define("WORDING_AJAX_DEMO_POSITION6", ", advertisers that have bid using Bitcoin Cash (for a total of ");
define("WORDING_AJAX_DEMO_POSITION7", " <b>advertisers that would still listed ahead of yours</b> if you bid the <u>minimum</u> with your free demo coin).</li><li><u><b> You can bid more </b></u>than the minimum with your Demo Coin and achieve higher positions among the Demo Coin group but your allotment won't last as long. </li><li><u><b>To maintain your Demo Coin balance</b></u> you can install our web directory app on your website and earn them from subscribers that register there (they each also receive demo coins when they register). You can also outbid them with even the minimum bid amount of Bitcoin Cash.</li><li><u><b> If you aren't familar with crypto currency</b></u> you can take our course at <a style='text-decoration:underline;color:blue;' target='_blank' href='http://bitcoin101.today'>Bitcoin101.today</a> for just $1.01.</li> ");
define("WORDING_AJAX_DEMO_POSITION8", "<li><u><b>The highest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_DEMO_POSITION9", " for their top position among the Demo Coin group. It will cost you one-and-a-half times that to claim #1 of the Demo Coin bidders ");

define("WORDING_AJAX_BCH_POSITION1", "</li><li><u><b>The highest \"Bitcoin Cash\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION2", " for their top position of all. It will cost you one-and-a-half times that to claim #1 of the BCH bidders  ");
define("WORDING_AJAX_BCH_POSITION3", "</li><li><u><b>The lowest \"Bitcoin Cash\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION4", " for their bottom position (lowest to be ahead of all demo coin and free ads).</li></ul> ");
define("WORDING_AJAX_BCH_POSITION5", "<li><u><b>The lowest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION6", " for their bottom position (lowest to be ahead of all free ads).</li>");

define("WORDING_AJAX_EXPANDED_REPORT_HEADER","<h4>Your Present Ad Position Would BE (expanded)...</h4>"); 

define("WORDING_AJAX_SUMMARY_REPORT_HEADER","<h4>Your Present Ad Position Would BE (summary) ...</h4>"); 

?>
