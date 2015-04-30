<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Bad Weather
 */

get_header(); ?>
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
		<div class="page">
			
			<div class="page-404">
				
				<h2 class="bb"><?php echo __('Oops! The page was not found.', BW_THEME); ?></h2>
				
				<p>
					<?php printf("%s <a href='" . home_url( '/' ) . "'>%s</a> %s",
						__('This may be because of a mistyped URL, faulty referral or out-of-date search engine listing. You should try the ', BW_THEME),
						__('homepage', BW_THEME),
						__('instead or maybe do a search?', BW_THEME)
					); ?>
				</p>
			
				<?php get_search_form(); ?>
				
			</div>
			
		</div>
		
	</div> <!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>