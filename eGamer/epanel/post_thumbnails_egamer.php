<?php
	add_theme_support( 'post-thumbnails' );

	global $et_theme_image_sizes;

	$et_thumb_size_format = '%dx%d';
	$et_post_thumb = sprintf( $et_thumb_size_format,
		intval( get_option( 'egamer_thumbnail_width_posts', 250 ) ),
		intval( get_option( 'egamer_thumbnail_height_posts', 250 ) )
	);
	$et_page_thumb = sprintf( $et_thumb_size_format,
		intval( get_option( 'egamer_thumbnail_width_pages', 250 ) ),
		intval( get_option( 'egamer_thumbnail_height_pages', 250 ) )
	);
	$et_usual_thumb = sprintf( $et_thumb_size_format,
		intval( get_option( 'egamer_thumbnail_width_index', 120 ) ),
		intval( get_option( 'egamer_thumbnail_height_index', 120 ) )
	);

	$et_theme_image_sizes = array(
		$et_post_thumb	=> 'et-posts-thumb',
		$et_page_thumb	=> 'et-pages-thumb',
		$et_usual_thumb	=> 'et-usual-thumb',
		'619x253' 	=> 'et-blogstylehome-thumb',
		'90x90' 	=> 'et-default-thumb',
		'43x43' 	=> 'et-rating-thumb',
	);

	$et_page_templates_image_sizes = array(
		'184x184' 	=> 'et-blog-page-thumb',
		'207x136' 	=> 'et-gallery-page-thumb',
		'260x170' 	=> 'et-portfolio-medium-page-thumb',
		'260x315' 	=> 'et-portfolio-medium-portrait-page-thumb',
		'140x94' 	=> 'et-portfolio-small-page-thumb',
		'140x170' 	=> 'et-portfolio-small-portrait-page-thumb',
		'430x283' 	=> 'et-portfolio-large-page-thumb',
		'430x860' 	=> 'et-portfolio-large-portrait-page-thumb',
	);

	$et_theme_image_sizes = array_merge( $et_theme_image_sizes, $et_page_templates_image_sizes );

	$et_theme_image_sizes = apply_filters( 'et_theme_image_sizes', $et_theme_image_sizes );
	$crop = apply_filters( 'et_post_thumbnails_crop', true );

	if ( is_array( $et_theme_image_sizes ) ){
		foreach ( $et_theme_image_sizes as $image_size_dimensions => $image_size_name ){
			$dimensions = explode( 'x', $image_size_dimensions );
			add_image_size( $image_size_name, $dimensions[0], $dimensions[1], $crop );
		}
	}
?>