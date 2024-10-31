<?php
/*
Plugin Name: RevealDiscountCode
Plugin URI: 
Description: A plugin that requires a click of a link (opens in new window) to reveal the code in the button. Great for affiliate links and discounts.
Version: 1.2.1
Author: Gordon McNevin
Author URI: 
License: GPL2
*/

// **************************************
// DISCOUNT BOX
// **************************************

function rdc_discount_box_output($output_array, $options_array = array())
{
	
	//figure out expiry date string
	$link = $output_array['offer_link'];

	//create the main button
	$offeroutput_code .= "<span id=\"offer_wrap_" . $output_array['offer_id'] . "\" ><a href=\"" . $link . "\" target=\"_blank\" rel=\"nofollow\" id=\"rev_" . $output_array['offer_id'] . "\" data-id=\"" . $output_array['offer_id'] . "\" data-code=\"" . $output_array['offer_code'] . "\" class=\"rdc_box_button\">" . $output_array['offer_title'] . "</a></span>";

	$offeroutput .= "<div class=\"rdc_box_offer bottom_margin\">";
	$offeroutput .= "{$offeroutput_code}";
	//$offeroutput .= "<div class=\"clearfix\"></div>";
	$offeroutput .= "</div>";

	return $offeroutput;	
}

function rdc_discount_box($args)
{
	global $wp_query;
	
	$output = "";
	extract(shortcode_atts(array(
		'title' => '',
		'link' => '',
		'code' => '',
	), $args));

	$item_array = array();
	$item_array['offer_title'] = $title;
	$item_array['offer_link'] = $link;
	//$item_array['offer_terms'] = $item->terms;
	//$item_array['offer_instructions'] = $item->instructions;
	$item_array['offer_code'] = $code;
	$item_array['offer_id'] = mt_rand();
	
	$output .= rdc_discount_box_output($item_array, $options_array);
	return $output;
	
}
add_shortcode('rdc_discount_box', 'rdc_discount_box');

function rdc_discount_box_styles()  
{ 
  wp_register_style( 'rdc-discount-box-style', 
    plugins_url( '/css/discount-box.css',__FILE__), 
    array(), 
    '20120208', 
    'all' );
  wp_enqueue_style( 'rdc-discount-box-style' );
 
}
add_action('wp_enqueue_scripts', 'rdc_discount_box_styles');

function rdc_discount_box_script() {
	wp_enqueue_script(
		'rdc-discount-box-script',
		plugins_url( '/jss/showcode.js',__FILE__) ,
		array( 'jquery' )
	);
}
add_action( 'wp_enqueue_scripts', 'rdc_discount_box_script' );


function rdc_add_to_post($content)
{
	if(strpos($content, "[rdc_discount_box") === false)
	{
		return $content;	
	}
	else
	{
		$msg = "<p>This page uses the <a href=\"https://wordpress.org/plugins/reveal-discount-code/\">Reveal Discount Code plugin</a>.</p>";
		return $content . stripslashes( $msg );
	}

}
add_filter('the_content', 'rdc_add_to_post');

?>