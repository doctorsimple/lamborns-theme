<?php
if( !class_exists( 'mythemes_header' ) ){

class mythemes_header
{
	static function setup()
	{
		$args = array(
            'default-image'          => get_template_directory_uri() . '/media/img/bkg.jpg',
            'random-default'         => false,
            'width'                  => 2600,
            'height'                 => absint( mythemes_mod( 'header-height' , 350 ) ),
            'flex-height'            => true,
            'flex-width'             => true,
            'default-text-color'     => 'ffffff',
            'header-text'            => true,
            'uploads'                => true
        );

        add_theme_support( 'custom-header', $args );
	}

	static function head()
	{
        get_template_part( 'templates/head' );
		get_template_part( 'templates/style' );
	}
}

}	/* END IF CLASS EXISTS */
?>