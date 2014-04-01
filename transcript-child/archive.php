<?php 
/* Check if this is a photo/video custom post type archive
 * or a category page defined on theme options page
 * to display media layout; If true load archive-media.php.
 *
 * If this is a category archive, which is defined on theme
 * option page to display in 2 column format, load archive-2col.php
 *
 * If both conditions above are false, get archive-default.php
 */ 
get_header(); 

	if( is_tax('gallery-cat') or is_post_type_archive( 'gab_gallery' ) or (of_get_option('of_tr_mediatmp') <> "" && is_category(explode(',',of_get_option('of_tr_mediatmp')))))
	
	{	
		include (get_stylesheet_directory() . '/archive-media.php'); 	
	} 
	
	elseif(of_get_option('of_tr_2col') <> "" && is_category(explode(',',of_get_option('of_tr_2col'))))
	{
		include (get_stylesheet_directory() . '/archive-2col.php'); 
	}
	
	elseif(of_get_option('of_tr_mag') <> "" && is_category(explode(',',of_get_option('of_tr_mag')))) 
	{
		// include (TEMPLATEPATH . '/archive-magazine.php'); 
		include (get_stylesheet_directory() . '/archive-magazine.php'); 
	}
	
	else 
	
	{
		include (get_stylesheet_directory() . '/archive-default.php'); 
	}
	
get_footer();
?>