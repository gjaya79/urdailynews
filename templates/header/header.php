<?php $ht = Bw::get_option( 'header_type' ); $header_type = $ht ? $ht : 1; ?>

<header id="header" class="versions version-<?php echo $header_type; echo Bw::get_option( 'header_white' ) ? ' nav-invert' : ''; ?>">
	
	<?php if ( has_nav_menu( 'top_left' ) or has_nav_menu( 'top_right' ) ) : ?>
	<div class="header-top">
		<div class="row">
			<nav id="top-nav-left" class="bw-menu"><?php wp_nav_menu( array( 'theme_location' => 'top_left' ) ); ?></nav>
			<nav id="top-nav-right" class="bw-menu"><?php wp_nav_menu( array( 'theme_location' => 'top_right' ) ); ?></nav>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="row for-header">
		<div class="header-container">
			
			<?php Bw::logo(); ?>
			
			<?php if( $header_type == 2 ): ?>
			<div class="right-content">
				<?php echo Bw::get_option( 'header_html' ); ?>
			</div>
			<?php endif; ?>
			
			<?php if( $header_type == 3 ): ?>
			<div class="right-content <?php if( ! Bw::get_option('header_white') ) { echo 'black'; } ?>">
				<?php get_search_form(); ?>
			</div>
			<?php endif; ?>
			
		</div>
	</div>
	
	<div class="row-holder <?php echo Bw::get_option( 'sticky_header' ) ? 'enable-sticky' : ''; ?> <?php echo ( Bw::get_option( 'invert_header_nav_color' ) ) ? 'invert' : ''; ?>">
		<div class="row for-sub-header">
			<nav id="navigation">
				<?php Bw_megamenu::main_nav(); ?>
			</nav>
			
			<!-- social icons -->
			<?php Bw::go_social(); ?>
		</div>
	</div>
	
	<span id="mobile-toggle"><i></i></span>
	
</header>