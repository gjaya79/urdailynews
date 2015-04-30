<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bad Weather
 */

get_header(); ?>
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
		<?php if( Bw::get_option('show_slider_categories') && is_category() ): ?>
		<?php get_template_part( 'templates/category-slider' ); ?>
		<?php endif; ?>
		
		<div class="heading">
			<h1 class="page-title">
				<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						printf( __( 'Author: %s', BW_THEME ), '<span class="vcard">' . get_the_author() . '</span>' );

					elseif ( is_day() ) :
						printf( __( 'Day: %s', BW_THEME ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', BW_THEME ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', BW_THEME ) ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', BW_THEME ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', BW_THEME ) ) . '</span>' );

					elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
						_e( 'Asides', BW_THEME );

					elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
						_e( 'Galleries', BW_THEME);

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', BW_THEME);

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', BW_THEME );

					elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
						_e( 'Quotes', BW_THEME );

					elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
						_e( 'Links', BW_THEME );

					elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
						_e( 'Statuses', BW_THEME );

					elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
						_e( 'Audios', BW_THEME );

					elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
						_e( 'Chats', BW_THEME );

					else :
						_e( 'Archives', BW_THEME );

					endif;
				?>
			</h1>
		</div>
		
		<?php if( have_posts() ): ?>
				
		<?php $layout = Bw::get_option( 'blog_layout' ) ? Bw::get_option( 'blog_layout' ) : 'grid' ; ?>
		
		<?php // overwrite the blog layout from category layout options
			if( is_object( get_queried_object() ) and ! empty( get_queried_object()->term_id ) ) {
				$term = get_term( get_queried_object()->term_id, 'category' );
				$cat_layout = get_field('category_layout', $term);
				if( $cat_layout == 'grid' or $cat_layout == 'list' ) { $layout = $cat_layout; }
			}
		?>

		<div class="posts-<?php echo $layout; ?>-holder">
			<div class="posts-<?php echo $layout; ?> bw-over">
				
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part("templates/post-templates/content-{$layout}"); ?>

				<?php endwhile; ?>
				
			</div>
		</div>
		
		<?php Bw::paging_nav(); ?>
		
		<?php endif; ?>
		
	</div> <!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
