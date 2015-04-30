<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Bad Weather
 */
?>

		</div> <!-- #container -->
	</div> <!-- .main-container -->
	
	<footer id="footer" class="<?php if ( !is_active_sidebar( 'footer_1' ) and !is_active_sidebar( 'footer_2' ) and !is_active_sidebar( 'footer_3' ) ) { echo 'empty'; } ?>">
		<div class="row">
			
			<div class="column column-1">
				<?php dynamic_sidebar( 'footer_1' );  ?>
			</div>
			
			<div class="column column-2">
				<?php dynamic_sidebar( 'footer_2' );  ?>
			</div>
			
			<div class="column column-3">
				<?php dynamic_sidebar( 'footer_3' );  ?>
			</div>
			
		</div>
		
		<div class="bottom">
			<div class="row">
				
				<!-- footer copyright -->
				<p><?php Bw::the_option( 'footer_copy' ); ?></p>
				
				<!-- footer navigation -->
				<nav id="bottom-menu" class="bw-menu"><?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?></nav>
				
			</div>
		</div>
		
	</footer>
	
	<span class="clear"></span>
	
</div> <!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
