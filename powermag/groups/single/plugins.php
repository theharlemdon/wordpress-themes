<?php get_header( 'buddypress' ); ?>

	<div class="row">
		<div id="primary" class="content-area span8">
			<div id="content" class="site-content" role="main">

					<div class="padder">
						<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>
			
						<?php do_action( 'bp_before_group_plugin_template' ); ?>
			
						<div id="item-header">
							<?php locate_template( array( 'groups/single/group-header.php' ), true ); ?>
						</div><!-- #item-header -->
			
						<div id="item-nav">
							<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
								<ul>
									<?php bp_get_options_nav(); ?>
			
									<?php do_action( 'bp_group_plugin_options_nav' ); ?>
								</ul>
							</div>
						</div><!-- #item-nav -->
			
						<div id="item-body">
			
							<?php do_action( 'bp_before_group_body' ); ?>
			
							<?php do_action( 'bp_template_content' ); ?>
			
							<?php do_action( 'bp_after_group_body' ); ?>
						</div><!-- #item-body -->
			
						<?php do_action( 'bp_after_group_plugin_template' ); ?>
			
						<?php endwhile; endif; ?>
			
					</div><!-- .padder -->
				
				
			</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
	
	<div class="span4">
		<?php if ( of_get_option('pm_bp_sidebar') == 'buddypress_sidebar' ) {			
				
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('BuddyPress')): endif;
				
		 		} else { get_sidebar( 'buddypress' );
		}; ?>
	</div>
	
</div><!-- .row (buddypress)-->
<?php get_footer( 'buddypress' ); ?>