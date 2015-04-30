<?php
/*
Template Name: Custom Page Builder
*/

get_header(); ?>
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
		<?php while(has_sub_field("blocks")):
			
			switch( true ) {
				
				# Billboard slider
				case(get_row_layout() == "billboard_slider"):
					get_template_part('templates/acf-layouts/billboard-slider'); break;
				
				# Billboard posts
				case(get_row_layout() == "billboard_posts"):
					get_template_part('templates/acf-layouts/billboard-posts'); break;
				
				# Posts grid
				case(get_row_layout() == "posts_grid"):
					get_template_part('templates/acf-layouts/posts-grid'); break;
				
				# Heading title
				case(get_row_layout() == "heading_title"):
					get_template_part('templates/acf-layouts/heading-title'); break;
				
				# Html block
				case(get_row_layout() == "html_editor"):
					get_template_part('templates/acf-layouts/html-editor'); break;
				
				# Papa grid
				case(get_row_layout() == "papa_grid"):
					get_template_part('templates/acf-layouts/papa-grid'); break;
				
				# Latest articles
				case(get_row_layout() == "latest_articles"):
					get_template_part('templates/acf-layouts/latest-articles'); break;
				
			}
			
		endwhile; ?>
		
	</div> <!-- #content -->

<?php get_footer(); ?>