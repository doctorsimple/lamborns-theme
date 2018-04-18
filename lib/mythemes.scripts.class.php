<?php
if( !class_exists( 'mythemes_scripts' ) ){

class mythemes_scripts
{
    static function frontend()
    {
        $ver = mythemes_core::theme( 'version' );

        /* GOOGLE FONT */
        wp_register_style( 'mythemes-google-fonts-roboto',      '//fonts.googleapis.com/css?family=Roboto:300,400,500,600,700' );
        wp_register_style( 'mythemes-google-fonts-open-sans',   '//fonts.googleapis.com/css?family=Open+Sans:300,400,700' );

        /* COMMON */
        wp_register_style( 'mythemes-icons',                    get_template_directory_uri() . '/media/css/icons.css' );
        wp_register_style( 'mythemes-effects',                  get_template_directory_uri() . '/media/css/effects.css', null, $ver );
        wp_register_style( 'mythemes-header',                   get_template_directory_uri() . '/media/css/header.css', null, $ver );

        /* FRONTEND */
        wp_register_style( 'mythemes-bootstrap',                get_template_directory_uri() . '/media/_frontend/css/bootstrap.min.css' );
        wp_register_style( 'mythemes-typography',               get_template_directory_uri() . '/media/_frontend/css/typography.css', null, $ver );
        wp_register_style( 'mythemes-navigation',               get_template_directory_uri() . '/media/_frontend/css/navigation.css', null, $ver );
        wp_register_style( 'mythemes-nav',                      get_template_directory_uri() . '/media/_frontend/css/nav.css', null, $ver );
        wp_register_style( 'mythemes-blog',                     get_template_directory_uri() . '/media/_frontend/css/blog.css', null, $ver );
        wp_register_style( 'mythemes-forms',                    get_template_directory_uri() . '/media/_frontend/css/forms.css', null, $ver );
        wp_register_style( 'mythemes-elements',                 get_template_directory_uri() . '/media/_frontend/css/elements.css', null, $ver );
        wp_register_style( 'mythemes-widgets',                  get_template_directory_uri() . '/media/_frontend/css/widgets.css', null, $ver );
        wp_register_style( 'mythemes-comments',                 get_template_directory_uri() . '/media/_frontend/css/comments.css', null, $ver );
        wp_register_style( 'mythemes-comments-typography',      get_template_directory_uri() . '/media/_frontend/css/comments-typography.css', null, $ver );
        wp_register_style( 'mythemes-footer',                   get_template_directory_uri() . '/media/_frontend/css/footer.css', null, $ver );
        wp_register_style( 'mythemes-pretty-photo',             get_template_directory_uri() . '/media/_frontend/css/prettyPhoto.css' );
        wp_register_style( 'mythemes-plugins',                  get_template_directory_uri() . '/media/_frontend/css/plugins.css', null, $ver );

        wp_register_script( 'mythemes-bootstrap',               get_template_directory_uri() . '/media/_frontend/js/bootstrap.min.js', array( 'jquery' ), null, true );
        wp_register_script( 'mythemes-functions',               get_template_directory_uri() . '/media/_frontend/js/functions.js', array( 'masonry' ) , $ver, true );		        wp_register_script( 'mythemes-spritezoom',               get_template_directory_uri() . '/media/_frontend/js/jquery.spritezoom.js', array( 'jquery' ), null, false );
        
        wp_register_script( 'mythemes-pretty-photo',            get_template_directory_uri() . '/media/_frontend/js/jquery.prettyPhoto.js', null, null, true );
        wp_register_script( 'mythemes-pretty-photo-settings',   get_template_directory_uri() . '/media/_frontend/js/jquery.prettyPhoto.settings.js', null, null, true );

        $dependency = array( 
            'mythemes-google-fonts-roboto',
            'mythemes-google-fonts-open-sans',
            'mythemes-icons', 
            'mythemes-effects', 
            'mythemes-header',
            'mythemes-bootstrap',
            'mythemes-typography',
            'mythemes-navigation',
            'mythemes-nav',
            'mythemes-blog',
            'mythemes-forms',
            'mythemes-elements',
            'mythemes-widgets',
            'mythemes-comments',
            'mythemes-comments-typography',
            'mythemes-footer',
            'mythemes-pretty-photo',
            'mythemes-plugins',
        );

        /* MAIN STYLE */
        wp_enqueue_style( 'mythemes-style', get_stylesheet_directory_uri() . '/style.css', $dependency, $ver );

        wp_enqueue_script( 'mythemes-bootstrap' );
        wp_enqueue_script( 'mythemes-functions' );
        wp_enqueue_script( 'mythemes-pretty-photo' );
        wp_enqueue_script( 'mythemes-pretty-photo-settings' );
		wp_enqueue_script( 'mythemes-spritezoom' );

        /* INCLUDE FOR REPLY COMMENTS */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );
    }

    static function backend()
    {
        $ver = mythemes_core::theme( 'version' );
        
        if( isset( $_GET[ 'page' ] ) )
            wp_enqueue_media();

        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_style( 'farbtastic' );
        wp_enqueue_style( 'ui-lightness' );
        wp_enqueue_style( 'thickbox' );

        wp_register_script( 'mythemes-_backend-ahtml',                  get_template_directory_uri() . '/media/_backend/js/ahtml.js' , array( 'jquery' , 'wp-color-picker' ), $ver );
        wp_enqueue_script( 'mythemes-_backend-ahtml' );

        wp_register_style( 'mythemes-_backend-customizer',              get_template_directory_uri() . '/media/_backend/css/customizer.css', null, $ver );
        wp_register_style( 'mythemes-_backend-options',                 get_template_directory_uri() . '/media/_backend/css/options.css', null, $ver );
        wp_register_style( 'mythemes-_backend-boxes',                   get_template_directory_uri() . '/media/_backend/css/boxes.css', null, $ver );
        wp_register_style( 'mythemes-_backend-ahtml',                   get_template_directory_uri() . '/media/_backend/css/ahtml.css', null, $ver );
        wp_register_style( 'mythemes-_backend-adds',                    get_template_directory_uri() . '/media/_backend/css/adds.css', null, $ver );

        wp_register_style( 'mythemes-icons',                            get_template_directory_uri() . '/media/css/icons.css' );

        wp_enqueue_style( 'mythemes-_backend-customizer' );
        wp_enqueue_style( 'mythemes-_backend-options' );
        wp_enqueue_style( 'mythemes-_backend-boxes' );
        wp_enqueue_style( 'mythemes-_backend-ahtml' );
        wp_enqueue_style( 'mythemes-_backend-adds' );
        wp_enqueue_style( 'mythemes-icons' );
    }
}

}   /* END IF CLASS EXISTS */
?>