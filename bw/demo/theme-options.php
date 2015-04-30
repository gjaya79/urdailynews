<?php
/**
 * Initialize the custom theme options.
 */
custom_theme_options();

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'header',
        'title'       => 'Header'
      ),
      array(
        'id'          => 'style',
        'title'       => 'Style'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social'
      ),
      array(
        'id'          => 'fonts',
        'title'       => 'Fonts'
      ),
      array(
        'id'          => 'articles',
        'title'       => 'Articles'
      ),
      array(
        'id'          => 'page',
        'title'       => 'Page'
      ),
      array(
        'id'          => 'other',
        'title'       => 'Other'
      ),
      array(
        'id'          => 'updates',
        'title'       => 'Updates'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'demo_import',
        'label'       => 'Demo content import',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-import-data',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_mobile',
        'label'       => 'Logo mobile version',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'fav_icon',
        'label'       => 'Fav icon',
        'desc'        => 'Icon must be: 16px X 16px or 32px X 32px',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_copy',
        'label'       => 'Footer copy',
        'desc'        => 'Short text for the copyright area in the footer',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'boxed_layout',
        'label'       => 'Boxed header &amp; footer',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_type',
        'label'       => 'Header type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Default',
            'src'         => 'OT_THEME_URL/bw/assets/img/admin/layout_header/1.png'
          ),
          array(
            'value'       => '2',
            'label'       => 'Type 2',
            'src'         => 'OT_THEME_URL/bw/assets/img/admin/layout_header/2.png'
          ),
          array(
            'value'       => '3',
            'label'       => 'Type 3',
            'src'         => 'OT_THEME_URL/bw/assets/img/admin/layout_header/3.png'
          )
        )
      ),
      array(
        'id'          => 'header_html',
        'label'       => 'Header html content',
        'desc'        => 'Please add content for the right part of the header version 2. You can add Images, simple text, html code, ads ..',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sticky_header',
        'label'       => 'Sticky header on scroll',
        'desc'        => 'Check this to make header stick to top on scroll',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'hide_wp_bar',
        'label'       => 'Hide Wordpress top bar when logged in',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'add_navigation_home_icon',
        'label'       => 'Add main navigation home icon',
        'desc'        => 'Check this options if you want to add the home icon to the main navigation on top of the page',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'mobile_nav_search',
        'label'       => 'Mobile navigation search',
        'desc'        => 'Enable this options if you want to add search input into the mobile navigation sidebar.',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_color',
        'label'       => 'Main color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_white',
        'label'       => 'Invert header color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_color',
        'label'       => 'Header color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'invert_header_nav_color',
        'label'       => 'Invert navigation color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_nav_color',
        'label'       => 'Header navigation color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'background_color',
        'label'       => 'Background color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'background_image',
        'label'       => 'Background image',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'container_shadow',
        'label'       => 'Add container shadow',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => 'None',
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => 'Light',
            'src'         => ''
          ),
          array(
            'value'       => 'medium',
            'label'       => 'Medium',
            'src'         => ''
          ),
          array(
            'value'       => 'dark',
            'label'       => 'Dark',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_image_effect',
        'label'       => 'Enable image hover effect',
        'desc'        => 'Turn off this option if you want to disable the effect when hover over the images',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_smooth_scroll',
        'label'       => 'Enable Smooth Scroll',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_lazy_image',
        'label'       => 'Enable image lazy load',
        'desc'        => 'Load specified images after the page load itself and speed up your loading time through this. Images outside of the visible area will only get loaded when the user scrolls to them. This will not only increase the page loading speed, it will even decrease your traffic.',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Add custom styles to theme. Example: body {color:red;}',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_js',
        'label'       => 'Custom Javascript',
        'desc'        => 'Add custom Javascript. Example: alert(1);',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'share_buttons_description',
        'label'       => 'Share services',
        'desc'        => 'Add here the share services you want to use, single comma delimited (no spaces). You can find the full list of services <a href="http://www.addthis.com/services/list" target="_blank">here</a> Also you can use the more tag to show the plus sign and the counter tag to show a global share counter.

<strong>Important</strong>: If you want to allow AddThis to show your visitors personalized lists of share buttons you can use the preferred tag. More about this <a href="http://bit.ly/1fLP69i" target="_blank">here</a>',
        'std'         => '',
        'type'        => 'bw-text-content',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'share_buttons_settings',
        'label'       => 'Add share services',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'social_icons',
        'label'       => 'Social icons',
        'desc'        => 'Click the "Add New" button, choose the social media and add the url, example: http://www.facebook.com/envato',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'social_media',
            'label'       => 'Social media',
            'desc'        => '',
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => array( 
              array(
                'value'       => 'aboutme',
                'label'       => 'Aboutme',
                'src'         => ''
              ),
              array(
                'value'       => 'aol',
                'label'       => 'Aol',
                'src'         => ''
              ),
              array(
                'value'       => 'amazon',
                'label'       => 'Amazon',
                'src'         => ''
              ),
              array(
                'value'       => 'apple',
                'label'       => 'Apple',
                'src'         => ''
              ),
              array(
                'value'       => 'appstore',
                'label'       => 'Appstore',
                'src'         => ''
              ),
              array(
                'value'       => 'bebo',
                'label'       => 'Bebo',
                'src'         => ''
              ),
              array(
                'value'       => 'behance',
                'label'       => 'Behance',
                'src'         => ''
              ),
              array(
                'value'       => 'bing',
                'label'       => 'Bing',
                'src'         => ''
              ),
              array(
                'value'       => 'blogger',
                'label'       => 'Blogger',
                'src'         => ''
              ),
              array(
                'value'       => 'dribble',
                'label'       => 'Dribble',
                'src'         => ''
              ),
              array(
                'value'       => 'delicious',
                'label'       => 'Delicious',
                'src'         => ''
              ),
              array(
                'value'       => 'diggalt',
                'label'       => 'Diggalt',
                'src'         => ''
              ),
              array(
                'value'       => 'ebay',
                'label'       => 'Ebay',
                'src'         => ''
              ),
              array(
                'value'       => 'email',
                'label'       => 'Email',
                'src'         => ''
              ),
              array(
                'value'       => 'facebook',
                'label'       => 'Facebook',
                'src'         => ''
              ),
              array(
                'value'       => 'googleplus',
                'label'       => 'Google plus',
                'src'         => ''
              ),
              array(
                'value'       => 'pinterest',
                'label'       => 'Pinterest',
                'src'         => ''
              ),
              array(
                'value'       => 'instagram',
                'label'       => 'Instagram',
                'src'         => ''
              ),
              array(
                'value'       => 'linkedin',
                'label'       => 'Linkedin',
                'src'         => ''
              ),
              array(
                'value'       => 'skype',
                'label'       => 'Skype',
                'src'         => ''
              ),
              array(
                'value'       => 'tumblr',
                'label'       => 'Tumblr',
                'src'         => ''
              ),
              array(
                'value'       => 'githubalt',
                'label'       => 'Github',
                'src'         => ''
              ),
              array(
                'value'       => 'flickr',
                'label'       => 'Flickr',
                'src'         => ''
              ),
              array(
                'value'       => 'foodspotting',
                'label'       => 'Foodspotting',
                'src'         => ''
              ),
              array(
                'value'       => 'googlebuzz',
                'label'       => 'Googlebuzz',
                'src'         => ''
              ),
              array(
                'value'       => 'gowallapin',
                'label'       => 'Gowallapin',
                'src'         => ''
              ),
              array(
                'value'       => 'grooveshark',
                'label'       => 'Grooveshark',
                'src'         => ''
              ),
              array(
                'value'       => 'heart',
                'label'       => 'Heart',
                'src'         => ''
              ),
              array(
                'value'       => 'icq',
                'label'       => 'Icq',
                'src'         => ''
              ),
              array(
                'value'       => 'imessage',
                'label'       => 'Imessage',
                'src'         => ''
              ),
              array(
                'value'       => 'itunes',
                'label'       => 'Itunes',
                'src'         => ''
              ),
              array(
                'value'       => 'lastfm',
                'label'       => 'Lastfm',
                'src'         => ''
              ),
              array(
                'value'       => 'mobileme',
                'label'       => 'Mobileme',
                'src'         => ''
              ),
              array(
                'value'       => 'myspace',
                'label'       => 'Myspace',
                'src'         => ''
              ),
              array(
                'value'       => 'picasa',
                'label'       => 'Picasa',
                'src'         => ''
              ),
              array(
                'value'       => 'soundcloud',
                'label'       => 'Soundcloud',
                'src'         => ''
              ),
              array(
                'value'       => 'star',
                'label'       => 'Star',
                'src'         => ''
              ),
              array(
                'value'       => 'twitter',
                'label'       => 'Twitter',
                'src'         => ''
              ),
              array(
                'value'       => 'vimeo',
                'label'       => 'Vimeo',
                'src'         => ''
              ),
              array(
                'value'       => 'wordpress',
                'label'       => 'Wordpress',
                'src'         => ''
              ),
              array(
                'value'       => 'yahoo',
                'label'       => 'Yahoo',
                'src'         => ''
              ),
              array(
                'value'       => 'youtube',
                'label'       => 'Youtube',
                'src'         => ''
              ),
              array(
                'value'       => 'fivehundredpx',
                'label'       => '500px',
                'src'         => ''
              )
            )
          ),
          array(
            'id'          => 'social_url',
            'label'       => 'Url',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'custom_fonts_desc',
        'label'       => 'Custom fonts',
        'desc'        => 'In this page you can set the typefaces to be used throughout the theme. For each elements listed below you can choose any front from the Google Web Font library. Once you have chosen a font from the list, you will see a preview of this font immediately beneath the list box. The icons on the bottom of the font preview, indicate what weights are available for that typeface.

R -- Regular,
B -- Bold,
I -- Italics,
BI -- Bold Italics

When deciding what font to use, ensure that the chosen font contains the font weight required by the element. For example, main headings are bold, so you need to select a new font for these elements which supports a bold font weight. If you select a font which does not have a bold icon, the font will not be applied.

Browse the online Google Font Library

Custom fonts (Advanced Users):
Other then those available from Google fonts, custom fonts may also be applied to the elements listed below. To do this an additional field is provided below the google fonts list. Here you may enter the details of a font family, size, line-height etc. for a custom font. This information is entered in the form of the shorthand \'font:\' CSS declaration, for example:

bold italic small-caps 1em/1.5em arial,sans-serif

If a font is specified in this field then the font listed in the Google font drop menu above will not be applied to the element in question. If you wish to use the Google font specified in the drop down list and just specify a new font size or line height, you can do so in this field also, however the name of the Google font MUST also be entered into this field. You may need to visit the Google fonts web page to find the exact CSS name for the font you have chosen.',
        'std'         => '',
        'type'        => 'bw-text-content',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_font',
        'label'       => 'Body font',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-select-font',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_font_declaration',
        'label'       => 'Body font declaration',
        'desc'        => 'Here you can add a custom font declaration, useful when you want to change size or  use a common (not google) font.Example: <b>15px arial,sans-serif</b>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font',
        'label'       => 'Heading font',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-select-font',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_declaration',
        'label'       => 'Heading font declaration',
        'desc'        => 'Here you can add a custom font declaration, useful when you want to change size or  use a common (not google) font.Example: <b>15px arial,sans-serif</b>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_layout',
        'label'       => 'Blog layout',
        'desc'        => 'Choose the layout for blog areas ( e.g. blog archive page, categories, search results )',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'grid',
            'label'       => 'Grid',
            'src'         => 'OT_THEME_URL/bw/assets/img/admin/layout_blog/grid.png'
          ),
          array(
            'value'       => 'list',
            'label'       => 'List',
            'src'         => 'OT_THEME_URL/bw/assets/img/admin/layout_blog/list.png'
          )
        )
      ),
      array(
        'id'          => 'comment_type_blog',
        'label'       => 'Comment type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => 'Default wordpress comments',
            'src'         => ''
          ),
          array(
            'value'       => 'facebook',
            'label'       => 'Facebook comment box',
            'src'         => ''
          ),
          array(
            'value'       => 'none',
            'label'       => 'None',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'display_blog_author',
        'label'       => 'Display blog author',
        'desc'        => 'Check this options in order to hide the author in the blog posts.',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_also_like',
        'label'       => 'Display "Related articles" section in blog posts',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_blog_categories',
        'label'       => 'Display categories',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_blog_tags',
        'label'       => 'Display tags',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'share_links_post',
        'label'       => 'Show share links',
        'desc'        => 'Do you want to show the share links bellow the blog posts?',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_slider_categories',
        'label'       => 'Show slider on category pages?',
        'desc'        => 'Check this if you want to display at the top of your category archives a slider with the posts marked as making part of the category slider.',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'category_slider_effect',
        'label'       => 'Category slider effect',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'slide',
            'label'       => 'Slide',
            'src'         => ''
          ),
          array(
            'value'       => 'fade',
            'label'       => 'Fade',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'category_slider_autoplay',
        'label'       => 'Category slider autoplay',
        'desc'        => '',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'articles',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'comment_type_page',
        'label'       => 'Comment type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => 'None',
            'src'         => ''
          ),
          array(
            'value'       => 'wp_comments',
            'label'       => 'Wordpress comments',
            'src'         => ''
          ),
          array(
            'value'       => 'facebook',
            'label'       => 'Facebook comment box',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'share_links_page',
        'label'       => 'Show share links',
        'desc'        => 'Do you want to show the share links in the custom pages?',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'analytics_id',
        'label'       => 'Google Analytics Id',
        'desc'        => 'Please insert only the Google Analytic ID. The tracking ID is a string like UA-000000-01',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'other',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'updates_description',
        'label'       => 'Theme one-click update',
        'desc'        => 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click using the Envato WordPress Toolkit. Forget about manual updates!
<strong>IMPORTANT</strong>: Please make sure that you have installed and activated the Envato Wordpress Toolkit plugin, included in the required plugins of the theme.',
        'std'         => '',
        'type'        => 'bw-text-content',
        'section'     => 'updates',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_updates',
        'label'       => 'Enable update notifications',
        'desc'        => 'Check this options if you want to check if there is an update available for the current theme.',
        'std'         => '',
        'type'        => 'bw-on-off',
        'section'     => 'updates',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}