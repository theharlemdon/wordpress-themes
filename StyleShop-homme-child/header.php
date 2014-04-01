<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php elegant_titles(); ?></title>
	<?php elegant_description(); ?>
	<?php elegant_keywords(); ?>
	<?php elegant_canonical(); ?>

	<?php do_action( 'et_head_meta' ); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen, projection" />

	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( $template_directory_uri . '/js/html5.js"' ); ?>" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page-wrap">
		<?php do_action( 'et_header_top' ); ?>

		<div id="main-page-wrapper">
			<div id="container">

				<div class="banner-ad">
					<?php dynamic_sidebar( 'Banner Ad' ); ?>
				</div>

				<header id="main-header" class="clearfix">
					<?php $logo = ( $user_logo = et_get_option( 'styleshop_logo' ) ) && '' != $user_logo ? $user_logo : $template_directory_uri . '/images/logo.png'; ?>
					<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo"/></a>

					<div id="top-navigation">
						<nav>
						<?php
							$menuClass = 'nav';
							if ( 'on' == et_get_option( 'styleshop_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
							$primaryNav = '';
							if ( function_exists( 'wp_nav_menu' ) ) {
								$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false ) );
							}
							if ( '' == $primaryNav ) { ?>
							<ul class="<?php echo esc_attr( $menuClass ); ?>">
								<?php if ( 'on' == et_get_option( 'styleshop_home_link' ) ) { ?>
									<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home','StyleShop' ); ?></a></li>
								<?php }; ?>

								<?php show_page_menu( $menuClass, false, false ); ?>
								<?php show_categories_menu( $menuClass, false ); ?>
							</ul>
							<?php }
							else echo( $primaryNav );
						?>
						</nav>

						<?php do_action( 'et_top_navigation' ); ?>
					</div> <!-- #top-navigation -->
				</header> <!-- #main-header -->
				<div id="content">
				<?php
					$menuID = 'top-categories';
					$menuClass = 'nav clearfix';
					if ( 'on' == et_get_option( 'styleshop_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
					$primaryNav = '';
					if ( function_exists( 'wp_nav_menu' ) ) {
						$primaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'menu_id' => $menuID, 'menu_class' => $menuClass, 'echo' => false ) );
					}
					if ( '' == $primaryNav ) { ?>
					<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
						<?php if ( 'on' == et_get_option( 'styleshop_home_link' ) ) { ?>
							<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home','StyleShop' ); ?></a></li>
						<?php }; ?>

						<?php show_page_menu( $menuClass, false, false ); ?>
						<?php show_categories_menu( $menuClass, false ); ?>
					</ul>
					<?php }
					else {
						echo( $primaryNav );
						?>
						<div class='custom-widget'>
							<?php dynamic_sidebar( 'Widget Homme Area Navigation' ); ?>
						</div>
						<?php
					}
				?>

			<?php if ( ! is_home() ) get_template_part('includes/breadcrumbs', 'index'); ?>