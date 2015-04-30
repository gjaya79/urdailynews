<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Bad Weather
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if( ! Bw::get_meta('hide_title') ): ?>
	<div class="heading">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</div>
	<?php endif; ?>
	
	<?php the_content(); ?>
	
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', BW_THEME ),
			'after'  => '</div>',
		) );
	?>
	
	<?php get_template_part( 'templates/share' ); ?>
	
</article> <!-- #post -->
