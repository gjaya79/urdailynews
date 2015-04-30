<?php

require_once( ABSPATH . WPINC . '/nav-menu-template.php' );

if ( !class_exists( "Bw_walker_nav_menu" ) && class_exists( 'Walker_Nav_Menu' ) && Bw_megamenu::$enable ):

class Bw_walker_nav_menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<ul class=\"sub-menu\">";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {  
        $output .= "</ul>";
    }

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		
        $id_field = $this->db_fields['id'];
        
        // check whether there are children for the given ID
        $element->hasChildren = isset($children_elements[$element->$id_field]) && !empty($children_elements[$element->$id_field]);
        
        if ( ! empty($children_elements[$element->$id_field])) {
            $element->classes[] = 'menu-item-parent';
        }
		
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;

        if (!is_array($args)) {
            $args = (array)$args;
        }

        // depth dependent classes
        $depth_classes = array('depth-'.$depth);

        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array)$item->classes;
		
		#d($classes);
        $class_names = esc_attr(implode(' ', apply_filters( 'nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= '<li id="nav-item-'.$item->ID. '" class="nav-item '.$depth_class_names.' '.$class_names.' hidden">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		
        $item_output = sprintf
            (
                '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
                $args['before'],
                $attributes,
                $args['link_before'],
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args['link_after'],
				( ( $depth == 0 ) ? '<i class="fa fa-circle"></i>' : '' ),
                $args['after']
            );
        
        //the megamenu wrapper
        if ($depth == 0) {
            $item_output .= '<div class="bw-megamenu hidden bw-over"><div class="megamenu-grid">';
        }
       
        if ($depth == 0 && ($item->object == 'category' || $item->object == 'post_format')) {
            
            //lets get the meta associated with the menu item to see what layout to use
			$menu_layout = esc_attr( get_post_meta( $item->ID, 'bw_megamenu_layout', TRUE ) );
            
            //$menu_layout = 'latest_posts';
            $numberposts = 4; //we start of with 5 posts and decrease from here
            
            //if the menu has children then pull fewer posts
            if ($item->hasChildren) {
                $numberposts--;
            }
            
            if (!empty($menu_layout)) {
				$post_args = array( 
					'posts_per_page' => 6,
					'offset'=> 0,
					'post_type'     => 'post',
					'post_status'   => 'publish',
				);
				
				if ($item->object == 'category') {
					
					$post_args['cat'] = $item->object_id;

				} elseif ($item->object == 'product_cat') {
					
					$post_args['taxonomy'] = 'product_cat';
					$post_args['post_type'] = 'product';
					
				} elseif ($item->object == 'post_format') {

					//first get the post format information
					$menu_item_post_format = get_term( $item->object_id, 'post_format' );

					$post_args['tax_query'] = array(
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array($menu_item_post_format->slug),
						)
					);
				}
				
                //decrease the number of post by 2 if we have a slider
                if ($menu_layout == 'slider_latest_posts') {
                    $numberposts -= 2;
                }
                
                global $post;
                
                //hold the post slides ids so we exclude them from the rest of the posts
                $slideposts_ids = array();
                
                //create the markup for the category posts slider
                if ($menu_layout == 'slider_latest_posts') {
                    
                    //lets grab the posts that are marked as being part of the category slider
					$post_args['meta_query'] = array(
						array(
							'key' => 'bw_category_slider',
							'value' => '1'
						)
					);

                    $slideposts = new WP_Query( $post_args );

                    $item_output .= '<div class="item one-half">';
					
                    if ($slideposts->have_posts()):
                    
                    $item_output .= '<div class="megamenu-slider bw-slider bw-over">';

                        while ( $slideposts->have_posts() )  : $slideposts->the_post();

                            //add the id to the array
                            $slideposts_ids[] = $post->ID;
                            
                            $post_title = get_the_title();
                            $post_link = get_permalink();
							
                            $image = Bw::get_image_src( 'bw_475x293' );
							
							if( !empty( $image ) ) {
								
								if ( $image ) {
									$menu_post_image  = '<img src="' . $image . '" alt="' . $post_title . '">';
								} else {
									$menu_post_image = '';
								}

								$item_output .=
								'<article class="item">' .
									'<a class="item-url" href="' . $post_link . '">' .
										'<div class="article-thumb">' .
											'<div class="image-hide">' .
												'<div class="image-wrap">' .
													$menu_post_image .
												'</div>' .
											'</div>' .
										'</div>' .
										'<div class="title shadow">' .
											'<h3>' . $post_title . '</h3>' .
										'</div>' .
									'</a>' .
								'</article>';
							
							}
							
                        endwhile;
                    
                    $item_output .= '</div>';

                    else:

                        $item_output .= '<div class="no-slides-message">';
                        $item_output .= __('No posts added to the category slider in this category' , BW_THEME);
                        $item_output .= '</div>';

                    endif;

                    $item_output .= '</div>';
                    wp_reset_postdata();
                    
                    //a bit of clean up
                    unset($post_args['meta_query']);
                }
                
                if ($menu_layout == 'latest_posts' || $menu_layout == 'slider_latest_posts') {
                
                    $post_args['posts_per_page'] = $numberposts;
                    $post_args['post__not_in'] = $slideposts_ids;
					// only posts with thumbnails
                    //$post_args['meta_query'] = array( array( 'key' => '_thumbnail_id' ) );

                    $menuposts = new WP_Query( $post_args );

					while ( $menuposts->have_posts()) : $menuposts->the_post();

                        $post_title = get_the_title();
                        $post_link = get_permalink();
                        
						if( has_post_thumbnail() ) {
							$image = Bw::get_image_src( 'bw_350x300' );
						}else{
							$image = BW_URI_ASSETS . 'img/empty/350x300.png';
						}
						
                        if ( $image ) {
                            $menu_post_image  = '<div class="article-thumb">';
                            $menu_post_image .= '<div class="image-hide"><div class="image-wrap"><img src="' . $image . '" alt="' . $post_title . '"></div></div><span class="over"></span>';
							$menu_post_image .= '</div>';
                        } else {
                            $menu_post_image = '';
                        }

                        $item_output .= 
                            '<div class="item one-fourth">' .
								'<article class="article">' .
									'<a href="' . $post_link . '">' .
										$menu_post_image .
										'<div class="article-content">
											<h2 class="article-title">' .
												'<span>' . $post_title . '</span>' .
											'</h2>
											<span class="small-link">'.__('Read More', BW_THEME).'<em>+</em></span>
										</div>
									</a>'.
								'</article>'.
                            '</div>';

                    endwhile;
                    wp_reset_postdata();
                
                }
            }
        }

        if ($depth == 0) {
            $item_output .= '</div>';
        }

        
        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth=0, $args=array()) {

        if ($depth == 0) {
            $output .= '</div>';
        }
        
        $output .= "</li>";
        
        // parse the HTML and find the megamenu posts and switch them with the submenus so those are first
        if ($depth == 0) {

            //load up the library
			if(!function_exists('bw_str_get_dom')) { require_once BW_FRAME_LIB . 'ganon/ganon.php'; }
            
            // Create DOM from string
			$_doc = bw_str_get_dom($output);

			$sub_mega_menu = $_doc->select('.bw-megamenu',-1);
            $zagrid = $sub_mega_menu->select('.megamenu-grid',0);

			$zagrid_content = '';
			if (!empty($zagrid)) {
				$zagrid_content = $zagrid->getInnerText();
			}

            if (!empty($zagrid) && !empty($zagrid_content)) {
                $submenu = $sub_mega_menu->select('.sub-menu', 0);
				$submenu_content = '';
				if (!empty($submenu)) {
					$submenu_content =  $submenu->getInnerText();
				}

				if (!empty($submenu) && !empty($submenu_content)) {
                    //cleanup
                    $submenu->removeClass('sub-menu');
                    $submenu->removeClass('one-fourth');
                    //add classes
                    $submenu->addClass('nav sub-menu');

                    //prepend it
					$temp = '<div class="item one-fourth">'.$submenu->html().'</div>'.$zagrid->getInnerText();
					//empty it
					$submenu->delete();
					$zagrid->clear();

					$zagrid->setInnerText($temp);
                }

            } else { // the megamenu wrapper doesn't have any fancy posts or sliders
                $submenu = $sub_mega_menu->select('.sub-menu', 0);

				$submenu_content = '';
				if (!empty($submenu)) {
					$submenu_content =  $submenu->getInnerText();

				}

				if (!empty($submenu) && !empty($submenu_content)) {
					//we do have regular submenu links and we need to move them up so they are just regular <ul> and <li>s

                    $_nav__item = $sub_mega_menu->parent;

                    //cleanup
                    $submenu->removeClass('sub-menu');
                    $submenu->removeClass('one-fourth');
                    //add classes
                    $submenu->addClass('nav sub-menu');
                    //insert it
					$sub_mega_menu->setOuterText($submenu->html());
                    //empty it
					$submenu->delete();
                } else {
					//there is no submenu
                    //just delete it
					$sub_mega_menu->delete();
                }
            }
            
            // swap the $output
            $output = $_doc->getInnerText();
            
            //cleanup
            //$_doc->__destruct();
            unset($_doc);
            
            restore_error_handler();
        }
    }

} # class

endif;