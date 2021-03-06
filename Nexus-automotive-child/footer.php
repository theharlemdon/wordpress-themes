		<?php include('other-site-feeds.php'); ?>

		<?php get_sidebar( 'footer' ); ?>

		<div id="footer-bottom">
		<?php
			$menu_class = 'bottom-nav';
			$footerNav = '';

			$footerNav = wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menu_class, 'echo' => false, 'depth' => '1' ) );

			if ( '' === $footerNav )
				show_page_menu( $menu_class );
			else
				echo( $footerNav );
		?>
		</div> <!-- #footer-bottom -->
	</div> <!-- .page-wrap -->

	<div id="footer-info" class="container">
		<div class="contact-us">
			Contact Us: <a href="mailto:info@carsboatsandbikes.com">info@carsboatsandbikes.com</a> | Cars Boats and Bikes is part of the <a href="http://broadbentmedia.com" target="_blank">Broadbent Media</a> Group.
		</div>

	</div>

	<?php wp_footer(); ?>
</body>
</html>