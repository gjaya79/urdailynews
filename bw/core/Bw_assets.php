<?php

class Bw_assets {

    static $assets;

    static function init() {

        if( is_admin() ) {
            add_action( 'admin_enqueue_scripts', array( 'Bw_assets', 'register_assets' ) );
        }else {
            add_action( 'wp_enqueue_scripts', array( 'Bw_assets', 'register_assets' ) );
        }
    }

    static function addAsset( $type, $name, $src, $deps, $ver, $in_footer_or_media ) {

        self::$assets[] = array(
            'type' => $type,
            'name' => $name,
            'src' => $src,
            'deps' => $deps,
            'in_footer_or_media' => $in_footer_or_media,
            'ver' => $ver
        );
    }

    static function addStyle( $name, $src = '', $deps = array(), $ver = BW_VERSION, $media = 'all' ) {
        self::addAsset( 'style', $name, $src, $deps, $ver, $media );
    }

    static function addScript( $name, $src = '', $deps = array(), $ver = BW_VERSION, $in_footer = true ) {
        self::addAsset( 'script', $name, $src, $deps, $ver, $in_footer );
    }
    
    // version 3.0
    static function register_assets() {
        
        if( is_array( self::$assets ) ) {
            
            $child = is_child_theme();
            $child_src = false;

            foreach( self::$assets as $asset ) {

                if( !empty( $asset['src'] ) ) {

                    $parse_url = parse_url( $asset['src'] );
                    
                    if( $child and $asset['name'] == 'style' ) {
                        $child_src = get_stylesheet_directory_uri() . '/' . $asset['src'];
                        continue;
                    }
                    
                    $src = ( isset( $parse_url['host'] ) or substr($asset['src'], 0, 2) == '//' ) ? $asset['src'] : get_template_directory_uri() . '/' . $asset['src'];
                    
                    $assets_function_name = "wp_enqueue_{$asset['type']}";

                    $assets_function_name( $asset['name'], $src, $asset['deps'], $asset['ver'], $asset['in_footer_or_media'] );
                }
            }
            
            if( $child_src ) {
                wp_enqueue_style( 'style', $child_src );
            }
        }
    }

}
