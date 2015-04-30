<div id="mobile-menu">
	
	<?php if( Bw::get_option( 'mobile_nav_search' ) ): ?>
	<div class="field">
		<?php get_search_form(); ?>
	</div>
	<?php endif; ?>
	
	<div class="field">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</div>
	
	<div class="field">
		<?php wp_nav_menu( array( 'theme_location' => 'top_left' ) ); ?>
	</div>
	
	<div class="field">
		<?php wp_nav_menu( array( 'theme_location' => 'top_right' ) ); ?>
	</div>
	
</div>