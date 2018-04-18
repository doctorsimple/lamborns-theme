<?php
    get_template_part( 'lib/main' );

    add_action( 'after_setup_theme', 	array( 'mythemes_setup', 	'support' ) );
    add_action( 'after_setup_theme',    array( 'mythemes_header',   'setup' ) );

	add_action( 'admin_init', 			array( 'mythemes_boxes', 	'add' ) );
	add_action( 'admin_init', 			array( 'mythemes_gallery', 	'admin_init' ), 20 );
	add_action( 'admin_init', 			array( 'mythemes_scripts', 	'backend' ) );
    
	add_action( 'admin_menu', 			array( 'mythemes_admin', 	'pageMenu' ) );

	add_action( 'widgets_init', 		array( 'mythemes_setup', 	'sidebars' ) );
	add_action( 'init', 				array( 'mythemes_setup', 	'menus' ) );

	
	add_action( 'wp_enqueue_scripts', 	array( 'mythemes_scripts', 	'frontend' ), 0 );
	add_action( 'wp_head', 				array( 'mythemes_header', 	'head' ) );
	
    add_filter( 'the_excerpt_rss', 		array( 'mythemes_tools', 	'rss_with_thumbnail' ) );
    add_filter( 'the_content_feed', 	array( 'mythemes_tools', 	'rss_with_thumbnail' ) );
    add_filter( 'post_gallery', 		array( 'mythemes_gallery', 	'shortcode'), null, 2 );

    /* BLOG TITLE */
    function mythemes_title_setup() {
        add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'mythemes_title_setup' );

    /* CUSTOMIZER */
    function mythemes_customize_register( $wp_customize )
	{
        {   //- SITE IDENTITY -//

            $wp_customize -> add_section( 'title_tagline', array(
                'title'             => __( 'Site Identity', 'treeson' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 0
            ));

            $wp_customize -> add_setting( 'mythemes-logo', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( new WP_Customize_Upload_Control(
                $wp_customize,
                'mythemes-logo',
                array(
                    'label'         => __( 'Preview Logo', 'treeson' ),
                    'section'       => 'title_tagline',
                    'settings'      => 'mythemes-logo',
                )
            ));

            $wp_customize -> add_setting( 'display_header_text' );
            $wp_customize -> add_control( 'display_header_text', array( 'theme_supports' => false ) );
        }


		{   //- COLORS -//

        	$wp_customize -> add_section( 'colors', array(
                'title'             => __( 'Colors' , 'treeson' ),
                'priority'          => 1,
                'capability'        => 'edit_theme_options'
        	));

            $wp_customize -> add_setting( 'mythemes-first-color', array(
                'default'           => '#343b43',
                'transport'         => 'postMessage',
                'priority'          => 0,
                'sanitize_callback' => 'sanitize_hex_color',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( new WP_Customize_Color_Control(
                $wp_customize,
                'mythemes-first-color',
                array(
                    'label'         => __( 'First Color', 'treeson' ),
                    'section'       => 'colors',
                    'settings'      => 'mythemes-first-color',
                )
            ));

            $wp_customize -> add_setting( 'mythemes-second-color', array(
                'default'           => '#5f992f',
                'transport'         => 'postMessage',
                'priority'          => 0,
                'sanitize_callback' => 'sanitize_hex_color',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( new WP_Customize_Color_Control(
                $wp_customize,
                'mythemes-second-color',
                array(
                    'label'         => __( 'Second Color', 'treeson' ),
                    'section'       => 'colors',
                    'settings'      => 'mythemes-second-color',
                )
            ));

            $wp_customize -> add_setting( 'mythemes-third-color', array(
                'default'           => '#416a9d',
                'transport'         => 'postMessage',
                'priority'          => 0,
                'sanitize_callback' => 'sanitize_hex_color',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( new WP_Customize_Color_Control(
                $wp_customize,
                'mythemes-third-color',
                array(
                    'label'         => __( 'Third Color', 'treeson' ),
                    'section'       => 'colors',
                    'settings'      => 'mythemes-third-color',
                )
            ));

            /* DISABLE UNSUPPORTED */
            $wp_customize -> add_setting( 'header_textcolor' );
            $wp_customize -> add_control( 'header_textcolor', array( 'theme_supports' => false ) );
        }


        {   /* BACKGROUND IMAGE */

            $wp_customize -> add_section( 'background_image', array(
                'title'             => __( 'Background Image', 'treeson' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 2
            ));
        }


        {   /* HEADER IMAGE */

            $wp_customize -> add_section( 'header_image', array(
                'title'             => __( 'Header Image', 'treeson' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 3
            ));
        }

    	{   //- HEADER ELEMENTS -//

            $wp_customize -> add_panel( 'mythemes-header-panel', array(
                'title'             => __( 'Header Elements', 'treeson' ),
                'description'       => sprintf( __( 'Discover the differences between the Treeson free WordPress theme and the Treeson Premium version. %s' , 'treeson' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-treeson-faqs' ) ) . '">' . __( 'See the Differences' , 'treeson' ) . ' &rarr;</a>' ),
                'priority'          => 4,
                'capability'        => 'edit_theme_options'
            ));


            {   /* GENERAL */

            	$wp_customize -> add_section( 'mythemes-header', array(
                    'title'             => __( 'General' , 'treeson' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
            	));

                /* FRONT PAGE */
                $wp_customize -> add_setting( 'mythemes-header-front-page', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-front-page', array(
                    'label'             => __( 'Display Header on Front Page', 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-front-page',
                    'type'              => 'checkbox',
                ));

                /* FRONT PAGE */
                $wp_customize -> add_setting( 'mythemes-header-blog-page', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-blog-page', array(
                    'label'             => __( 'Display Header on Blog Page', 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-blog-page',
                    'type'              => 'checkbox',
                ));

                /* TEMPLATES */
                $wp_customize -> add_setting( 'mythemes-header-templates', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-templates', array(
                    'label'             => __( 'Display Header on Templates', 'treeson' ),
                    'description'       => __( 'enabale / disable header on: Archives, Categories, Tags, Author, 404 and Search Results.' , 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-templates',
                    'type'              => 'checkbox',
                ));

                /* SINGLE POSTS */
                $wp_customize -> add_setting( 'mythemes-header-single-posts', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-single-posts', array(
                    'label'             => __( 'Display Header on Single Posts', 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-single-posts',
                    'type'              => 'checkbox',
                ));

                /* SINGLE PAGES */
                $wp_customize -> add_setting( 'mythemes-header-single-pages', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-single-pages', array(
                    'label'             => __( 'Display Header on Single Pages', 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-single-pages',
                    'type'              => 'checkbox',
                ));

                /* HEIGHT */
                $wp_customize -> add_setting( 'mythemes-header-height', array(
                    'default'           => 450,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-height', array(
                    'label'             => __( 'Header height ( in pixels )', 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-height',
                    'type'              => 'number',
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 600,
                        'step'  => 1
                    ),
                ));

                /* IMAGE */
                $wp_customize -> add_setting( 'mythemes-header-image', array(
                    'default'           => get_template_directory_uri() . '/media/img/bkg.jpg',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Upload_Control(
                    $wp_customize,
                    'mythemes-header-image',
                    array(
                        'label'         => __( 'Preview Header Image', 'treeson' ),
                        'section'       => 'mythemes-header',
                        'settings'      => 'mythemes-header-image'
                    )
                ));

                /* HEADER BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-header-background-color', array(
                    'default'           => '#000000',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-background-color',
                    array(
                        'label'         => __( 'Background Color', 'treeson' ),
                        'section'       => 'mythemes-header',
                        'settings'      => 'mythemes-header-background-color',
                    )
                ));

                /* MASK COLOR */
                $wp_customize -> add_setting( 'mythemes-header-mask-color', array(
                    'default'           => '#000000',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-mask-color',
                    array(
                        'label'         => __( 'Mask Color', 'treeson' ),
                        'section'       => 'mythemes-header',
                        'settings'      => 'mythemes-header-mask-color',
                    )
                ));

                /* MASK OPACITY */
                $wp_customize -> add_setting( 'mythemes-header-mask-opacity', array(
                    'default'           => 80,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-mask-opacity', array(
                    'label'             => __( 'Mask Opacity ( % )', 'treeson' ),
                    'description'       => __( 'by default the mask is a dark transparent foil over the header background image.' , 'treeson' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-mask-opacity',
                    'type'              => 'range',
                    'input_attrs' => array(
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ),
                ));
            }


            {   /* CONTENT */

                $wp_customize -> add_section( 'mythemes-header-content', array(
                    'title'             => __( 'Content' , 'treeson' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                ));

                /* DISPLAY TITLE ON HEADER */
                $wp_customize -> add_setting( 'mythemes-header-title', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-title', array(
                    'label'             => __( 'Display title on header', 'treeson' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-title',
                    'type'              => 'checkbox',
                ));

                /* TITLE COLOR */
                $wp_customize -> add_setting( 'mythemes-header-title-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-title-color',
                    array(
                        'label'         => __( 'Title color', 'treeson' ),
                        'section'       => 'mythemes-header-content',
                        'settings'      => 'mythemes-header-title-color',
                    )
                ));

                /* DISPLAY DESCRIPTION ON HEADER */
                $wp_customize -> add_setting( 'mythemes-header-description', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-description', array(
                    'label'             => __( 'Display description on header', 'treeson' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-description',
                    'type'              => 'checkbox',
                ));

                /* DESCRIPTION COLOR */
                $wp_customize -> add_setting( 'mythemes-header-description-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-description-color',
                    array(
                        'label'         => __( 'Description color', 'treeson' ),
                        'section'       => 'mythemes-header-content',
                        'settings'      => 'mythemes-header-description-color',
                    )
                ));
            }


            {   /* FIRST BUTTON */

                $wp_customize -> add_section( 'mythemes-header-first-btn', array(
                    'title'             => __( 'First Button' , 'treeson' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30
                ));

                /* DISPLAY */
                $wp_customize -> add_setting( 'mythemes-first-btn', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn', array(
                    'label'             => __( 'Display first button', 'treeson' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn',
                    'type'              => 'checkbox',
                ));

                /* COLOR */
                $wp_customize -> add_setting( 'mythemes-first-btn-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-first-btn-color',
                    array(
                        'label'         => __( 'Color', 'treeson' ),
                        'section'       => 'mythemes-header-first-btn',
                        'settings'      => 'mythemes-first-btn-color',
                    )
                ));

                /* URL */
                $wp_customize -> add_setting( 'mythemes-first-btn-url', array(
                    'default'           => esc_url( home_url( '#' ) ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-url', array(
                    'label'             => __( 'URL', 'treeson' ),
                    'description'       => __( 'Link for first button', 'treeson' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-url',
                    'type'              => 'url',
                ));

                /* LABEL */
                $wp_customize -> add_setting( 'mythemes-first-btn-label', array(
                    'default'           => __( 'First Button', 'treeson' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-label', array(
                    'label'             => __( 'Label', 'treeson' ),
                    'description'       => __( 'Text for first button', 'treeson' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION */
                $wp_customize -> add_setting( 'mythemes-first-btn-description', array(
                    'default'           => __( 'first button link description...', 'treeson' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-description', array(
                    'label'             => __( 'Description', 'treeson' ),
                    'description'       => __( 'link description for first button', 'treeson' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-description',
                    'type'              => 'textarea',
                ));

                /* LINK TARGET */
                $wp_customize -> add_setting( 'mythemes-first-btn-target', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-target', array(
                    'label'             => __( 'Open url in new window', 'treeson' ),
                    'description'       => __( 'enable / disable link attribut target="_blank"', 'treeson' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-target',
                    'type'              => 'checkbox',
                ));
            }


            {   /* SECOND BUTTON */

                $wp_customize -> add_section( 'mythemes-header-second-btn', array(
                    'title'             => __( 'Second Button' , 'treeson' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                ));

                /* DISPLAY */
                $wp_customize -> add_setting( 'mythemes-second-btn', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn', array(
                    'label'             => __( 'Display second button', 'treeson' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn',
                    'type'              => 'checkbox',
                ));

                /* COLOR */
                $wp_customize -> add_setting( 'mythemes-second-btn-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-second-btn-color',
                    array(
                        'label'         => __( 'Color', 'treeson' ),
                        'section'       => 'mythemes-header-second-btn',
                        'settings'      => 'mythemes-second-btn-color'
                    )
                ));

                /* URL */
                $wp_customize -> add_setting( 'mythemes-second-btn-url', array(
                    'default'           => esc_url( home_url( '#' ) ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-url', array(
                    'label'             => __( 'URL', 'treeson' ),
                    'description'       => __( 'Link for second button', 'treeson' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-url',
                    'type'              => 'url',
                ));

                /* LABEL */
                $wp_customize -> add_setting( 'mythemes-second-btn-label', array(
                    'default'           => __( 'Second Button', 'treeson' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-label', array(
                    'label'             => __( 'Label', 'treeson' ),
                    'description'       => __( 'Text for second button', 'treeson' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION */
                $wp_customize -> add_setting( 'mythemes-second-btn-description', array(
                    'default'           => __( 'second button link description...', 'treeson' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-description', array(
                    'label'             => __( 'Description', 'treeson' ),
                    'description'       => __( 'link description for second button', 'treeson' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-description',
                    'type'              => 'textarea',
                ));

                /* LINK TARGET */
                $wp_customize -> add_setting( 'mythemes-second-btn-target', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-target', array(
                    'label'             => __( 'Open url in new window', 'treeson' ),
                    'description'       => __( 'enable / disable link attribut target="_blank"', 'treeson' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-target',
                    'type'              => 'checkbox',
                ));
            }
        }


        {   //- BREADCRUMBS -//

            $wp_customize -> add_section( 'mythemes-breadcrumbs', array(
                'title'             => __( 'Breadcrumbs' , 'treeson' ),
                'priority'          => 5,
                'capability'        => 'edit_theme_options'
            ));

            //- DISPLAY BREADCRUMBS -//
            $wp_customize -> add_setting( 'mythemes-breadcrumbs', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-breadcrumbs', array(
                'label'             => __( 'Display breadcrumbs', 'treeson' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-breadcrumbs',
                'type'              => 'checkbox',
            ));

            //- LABEL -//
            $wp_customize -> add_setting( 'mythemes-home-label', array(
                'default'           => __( 'Home', 'treeson' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-home-label', array(
                'label'             => __( '"Home" label', 'treeson' ),
                'description'       => __( 'breadcrumbs "Home" link label.', 'treeson' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-home-label',
                'type'              => 'text',
            ));

            //- DESCRIPTION -//
            $wp_customize -> add_setting( 'mythemes-home-link-description', array(
                'default'           => __( 'go to home', 'treeson' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-home-link-description', array(
                'label'             => __( '"Home" link description', 'treeson' ),
                'description'       => __( 'breadcrumbs "Home" link description.', 'treeson' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-home-link-description',
                'type'              => 'textarea',
            ));

            //- SPACE -//
            $wp_customize -> add_setting( 'mythemes-breadcrumbs-space', array(
                'default'           => 60,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_number',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-breadcrumbs-space', array(
                'label'             => __( 'Space ( in pixels )', 'treeson' ),
                'description'       => __( 'inner top and bottom space allow you to change breadcrumbs height.', 'treeson' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-breadcrumbs-space',
                'type'              => 'number',
                'input_attrs'       => array(
                    'min'   => 0,
                    'max'   => 100,
                )
            ));
        }
        

        {   //- ADDITIONAL -//

            $wp_customize -> add_section( 'mythemes-additional', array(
                'title'             => __( 'Additional' , 'treeson' ),
                'priority'          => 33,
                'capability'        => 'edit_theme_options'

            ));

            //- LABEL "BLOG PAGE" -//
            $wp_customize -> add_setting( 'mythemes-blog-title', array(
                'default'           => __( 'Blog', 'treeson' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-blog-title', array(
                'label'             => __( 'Title for Blog Page', 'treeson' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-blog-title',
                'type'              => 'text'
            ));

            //- ENABLE / DISABLE MYTHEMES GALLERY -//
            $wp_customize -> add_setting( 'mythemes-gallery-style', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-gallery-style', array(
                'label'             => __( 'myThem.es Gallery Style', 'treeson' ),
                'description'       => __( 'enable / disable myThem.es Gallery Style.', 'treeson' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-gallery-style',
                'type'              => 'checkbox',
            ));

            //- DISPLAY DEFAULT CONTENT -//
            $wp_customize -> add_setting( 'mythemes-default-content', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-default-content', array(
                'label'             => __( 'Display default content', 'treeson' ),
                'description'       => __( 'enable / disable default content from sidebars.', 'treeson' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-default-content',
                'type'              => 'checkbox',
            ));

            /* DISPLAY TOP META */
            $wp_customize -> add_setting( 'mythemes-top-meta', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-top-meta', array(
                'label'             => __( 'Display top meta', 'treeson' ),
                'description'       => __( 'enable / disable top meta from single posts ( all posts ).', 'treeson' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-top-meta',
                'type'              => 'checkbox',
            ));

            /* DISPLAY BOTTOM META */
            $wp_customize -> add_setting( 'mythemes-bottom-meta', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-bottom-meta', array(
                'label'             => __( 'Display bottom meta', 'treeson' ),
                'description'       => __( 'enable / disable bottom meta from single posts ( all posts ).', 'treeson' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-bottom-meta',
                'type'              => 'checkbox',
            ));

            /* HTML SUGGESTIONS */
            $wp_customize -> add_setting( 'mythemes-html-suggestions', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-html-suggestions', array(
                'label'             => __( 'HTML Suggestions', 'treeson' ),
                'description'       => __( 'enable / disable HTML Suggestions after comments form ( all posts ).', 'treeson' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-html-suggestions',
                'type'              => 'checkbox',
            ));
        }


        {   /* LAYOUTS */

            $wp_customize -> add_panel( 'mythemes-layout-panel', array(
                'title'             => __( 'Layout' , 'treeson' ),
                'description'       => sprintf( __( 'On the premium version for each page, post or / and portfolio you can overwrite the Layout options with custom settings. %s' , 'treeson' ) , '<br/><br/><a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '" target="_blank" title="Treeson Premium Multipurpose Wordpress Theme">' . __( 'Upgrade to Premium' , 'treeson' ) . ' &rarr;</a>' ),
                'priority'          => 34,
                'capability'        => 'edit_theme_options'
            ));


            $sidebars   = array(
                'main'              => __( 'Main Sidebar' , 'treeson' ),
                'front-page'        => __( 'Front Page Sidebar' , 'treeson' ),
                'page'              => __( 'Page Sidebar' , 'treeson' ),
                'post'              => __( 'Post Sidebar' , 'treeson' ),
                'special-page'      => __( 'Special Page Sidebar' , 'treeson' )
            );


            {   /* DEFAULT */

                $wp_customize -> add_section( 'mythemes-layout', array(
                    'title'             => __( 'Default' , 'treeson' ),
                    'description'       => __( 'Default Layout is used for the next templates: Blog, Archives, Categories, Tags, Author and Search Results.' , 'treeson' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-layout', array(
                    'label'             => __( 'Layout' , 'treeson' ),
                    'section'           => 'mythemes-layout',
                    'settings'          => 'mythemes-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'treeson' ),
                        'full'  => __( 'Full Width', 'treeson' ),
                        'right' => __( 'Right Sidebar', 'treeson' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-sidebar', array(
                    'default'           => 'main',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-sidebar', array(
                    'label'             => __( 'Sidebar' , 'treeson' ),
                    'description'       => __( 'on the premium version you can create unlimited number of sidebars' , 'treeson' ),
                    'section'           => 'mythemes-layout',
                    'settings'          => 'mythemes-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                ));
            }


            {   /* FRONT PAGE */

                $wp_customize -> add_section( 'mythemes-front-page-layout', array(
                    'title'             => __( 'Front Page' , 'treeson' ),
                    'description'       => __( 'In order to use this option set you need to activate a staic page on Front Page from - "Static Front Page" tab' , 'treeson' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-front-page-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-front-page-layout', array(
                    'label'             => __( 'Layout' , 'treeson' ),
                    'section'           => 'mythemes-front-page-layout',
                    'settings'          => 'mythemes-front-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'treeson' ),
                        'full'  => __( 'Full Width', 'treeson' ),
                        'right' => __( 'Right Sidebar', 'treeson' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-front-page-sidebar', array(
                    'default'           => 'front-page',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-front-page-sidebar', array(
                    'label'             => __( 'Sidebar' , 'treeson' ),
                    'description'       => __( 'on the premium version you can create unlimited number of sidebars' , 'treeson' ),
                    'section'           => 'mythemes-front-page-layout',
                    'settings'          => 'mythemes-front-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                ));
            }
            

            {   /* SINGLE PAGE */

                $wp_customize -> add_section( 'mythemes-page-layout', array(
                    'title'             => __( 'Single Page' , 'treeson' ),
                    'description'       => __( 'On the premium version for the each page you can overwrite the Layout options with the custom settings.' , 'treeson' ),
                    'panel'             => 'mythemes-layout-panel'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-page-layout', array(
                    'default'           => 'full',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-page-layout', array(
                    'label'             => __( 'Layout' , 'treeson' ),
                    'section'           => 'mythemes-page-layout',
                    'settings'          => 'mythemes-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'treeson' ),
                        'full'  => __( 'Full Width', 'treeson' ),
                        'right' => __( 'Right Sidebar', 'treeson' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-page-sidebar', array(
                    'default'           => 'page',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-page-sidebar', array(
                    'label'             => __( 'Sidebar' , 'treeson' ),
                    'description'       => __( 'on the premium version you can create unlimited number of sidebars' , 'treeson' ),
                    'section'           => 'mythemes-page-layout',
                    'settings'          => 'mythemes-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                ));
            }
            

            {   /* SINGLE POST */

                $wp_customize -> add_section( 'mythemes-post-layout', array(
                    'title'             => __( 'Single Post' , 'treeson' ),
                    'description'       => __( 'On the premium version for the each post you can overwrite the Layout options with the custom settings.' , 'treeson' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-post-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-post-layout', array(
                    'label'             => __( 'Layout' , 'treeson' ),
                    'section'           => 'mythemes-post-layout',
                    'settings'          => 'mythemes-post-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'treeson' ),
                        'full'  => __( 'Full Width', 'treeson' ),
                        'right' => __( 'Right Sidebar', 'treeson' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-post-sidebar', array(
                    'default'           => 'post',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-post-sidebar', array(
                    'label'             => __( 'Sidebar' , 'treeson' ),
                    'description'       => __( 'on the premium version you can create unlimited number of sidebars' , 'treeson' ),
                    'section'           => 'mythemes-post-layout',
                    'settings'          => 'mythemes-post-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                ));
            }
            

            {   /* SPECIAL PAGE */

                $wp_customize -> add_section( 'mythemes-special-page-layout', array(
                    'title'             => __( 'Special Page' , 'treeson' ),
                    'description'       => __( 'On the premium version for each page you can overwrite the Layout options with custom settings.' , 'treeson' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* SPECIAL PAGE */
                $wp_customize -> add_setting( 'mythemes-special-page', array(
                    'default'           => 2,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page', array(
                    'label'             => __( 'Special page' , 'treeson' ),
                    'description'       => __( 'for selected page you can overwrite default page layout settings with special layout settings', 'treeson' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page',
                    'type'              => 'dropdown-pages'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-special-page-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page-layout', array(
                    'label'             => __( 'Layout' , 'treeson' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'treeson' ),
                        'full'  => __( 'Full Width', 'treeson' ),
                        'right' => __( 'Right Sidebar', 'treeson' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-special-page-sidebar', array(
                    'default'           => 'special-page',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page-sidebar', array(
                    'label'             => __( 'Sidebar' , 'treeson' ),
                    'description'       => __( 'on the premium version you can create unlimited number of sidebars' , 'treeson' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                ));
            }
        
        }


        {   /* SOCIAL */

            $wp_customize -> add_section( 'mythemes-social', array(
                'title'             => __( 'Social' , 'treeson' ),
                'priority'          => 35,
                'capability'        => 'edit_theme_options'
            ));

            /* VIMEO */
            $wp_customize -> add_setting( 'mythemes-vimeo', array(
                'default'           => 'http://vimeo.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-vimeo', array(
                'label'             => __( 'Vimeo', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-vimeo',
                'type'              => 'url',
            ));

            /* TWITTER */
            $wp_customize -> add_setting( 'mythemes-twitter', array(
                'default'           => 'http://twitter.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-twitter', array(
                'label'             => __( 'Twitter', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-twitter',
                'type'              => 'url'
            ));

            /* SKYPE */
            $wp_customize -> add_setting( 'mythemes-skype', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-skype', array(
                'label'             => __( 'Skype', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-skype',
                'type'              => 'url'
            ));

            /* RENREN */
            $wp_customize -> add_setting( 'mythemes-renren', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-renren', array(
                'label'             => __( 'Renren', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-renren',
                'type'              => 'url',
            ));

            /* GITHUB */
            $wp_customize -> add_setting( 'mythemes-github', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-github', array(
                'label'             => __( 'Github', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-github',
                'type'              => 'url'
            ));

            /* RDIO */
            $wp_customize -> add_setting( 'mythemes-rdio', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-rdio', array(
                'label'             => __( 'Rdio', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-rdio',
                'type'              => 'url'
            ));

            /* LINKEDIN */
            $wp_customize -> add_setting( 'mythemes-linkedin', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-linkedin', array(
                'label'             => __( 'Linkedin', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-linkedin',
                'type'              => 'url',
            ));

            /* BEHANCE */
            $wp_customize -> add_setting( 'mythemes-behance', array(
                'default'           => 'http://behance.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-behance', array(
                'label'             => __( 'Behance', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-behance',
                'type'              => 'url',
            ));

            /* DROPBOX */
            $wp_customize -> add_setting( 'mythemes-dropbox', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-dropbox', array(
                'label'             => __( 'Dropbox', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-dropbox',
                'type'              => 'url',
            ));

            /* FLICKR */
            $wp_customize -> add_setting( 'mythemes-flickr', array(
                'default'           => 'http://flickr.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-flickr', array(
                'label'             => __( 'Flickr', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-flickr',
                'type'              => 'url',
            ));

            /* TUMBLR */
            $wp_customize -> add_setting( 'mythemes-tumblr', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-tumblr', array(
                'label'             => __( 'Tumblr', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-tumblr',
                'type'              => 'url',
            ));

            /* INSTAGRAM */
            $wp_customize -> add_setting( 'mythemes-instagram', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-instagram', array(
                'label'             => __( 'Instagram', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-instagram',
                'type'              => 'url',
            ));

            /* VKONTAKTE */
            $wp_customize -> add_setting( 'mythemes-vkontakte', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-vkontakte', array(
                'label'             => __( 'Vkontakte', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-vkontakte',
                'type'              => 'url',
            ));

            /* FACEBOOK */
            $wp_customize -> add_setting( 'mythemes-facebook', array(
                'default'           => 'http://facebook.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-facebook', array(
                'label'             => __( 'Facebook', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-facebook',
                'type'              => 'url',
            ));

            /* EVERNOTE */
            $wp_customize -> add_setting( 'mythemes-evernote', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-evernote', array(
                'label'             => __( 'Evernote', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-evernote',
                'type'              => 'url',
            ));

            /* FLATTR */
            $wp_customize -> add_setting( 'mythemes-flattr', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-flattr', array(
                'label'             => __( 'Flattr', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-flattr',
                'type'              => 'url',
            ));

            /* PICASA */
            $wp_customize -> add_setting( 'mythemes-picasa', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-picasa', array(
                'label'             => __( 'Picasa', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-picasa',
                'type'              => 'url',
            ));

            /* DRIBBBLE */
            $wp_customize -> add_setting( 'mythemes-dribbble', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-dribbble', array(
                'label'             => __( 'Dribbble', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-dribbble',
                'type'              => 'url',
            ));

            /* MIXI */
            $wp_customize -> add_setting( 'mythemes-mixi', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-mixi', array(
                'label'             => __( 'Mixi', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-mixi',
                'type'              => 'url',
            ));

            /* STUMBLEUPON */
            $wp_customize -> add_setting( 'mythemes-stumbleupon', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-stumbleupon', array(
                'label'             => __( 'Stumbleupon', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-stumbleupon',
                'type'              => 'url',
            ));

            /* LASTFM */
            $wp_customize -> add_setting( 'mythemes-lastfm', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-lastfm', array(
                'label'             => __( 'Lastfm', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-lastfm',
                'type'              => 'url',
            ));

            /* GPLUS */
            $wp_customize -> add_setting( 'mythemes-gplus', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-gplus', array(
                'label'             => __( 'GPlus', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-gplus',
                'type'              => 'url',
            ));

            /* GOOGLE CIRCLES */
            $wp_customize -> add_setting( 'mythemes-google-circles', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-google-circles', array(
                'label'             => __( 'Google circles', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-google-circles',
                'type'              => 'url',
            ));

            /* PINTEREST */
            $wp_customize -> add_setting( 'mythemes-pinterest', array(
                'default'           => 'http://pinterest.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-pinterest', array(
                'label'             => __( 'Pinterest', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-pinterest',
                'type'              => 'url',
            ));

            /* SMASHING */
            $wp_customize -> add_setting( 'mythemes-smashing', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-smashing', array(
                'label'             => __( 'Smashing', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-smashing',
                'type'              => 'url',
            ));

            /* SOUNDCLOUD */
            $wp_customize -> add_setting( 'mythemes-soundcloud', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-soundcloud', array(
                'label'             => __( 'Soundcloud', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-soundcloud',
                'type'              => 'url',
            ));

            /* RSS */
            $wp_customize -> add_setting( 'mythemes-rss', array(
                'default'           => esc_url( get_bloginfo('rss2_url') ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-rss', array(
                'label'             => __( 'Rss', 'treeson' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-rss',
                'type'              => 'url',
            ));
        }
    	

        {   /* OTHERS */
            $wp_customize -> add_section( 'mythemes-others', array(
                'title'             => __( 'Others' , 'treeson' ),
                'priority'          => 36,
                'capability'        => 'edit_theme_options'
            ));

            /* CUSTOM CSS */
            $wp_customize -> add_setting( 'mythemes-custom-css', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_css',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-custom-css', array(
                'label'             => __( 'Custom css', 'treeson' ),
                'section'           => 'mythemes-others',
                'settings'          => 'mythemes-custom-css',
                'type'              => 'textarea',
            ));

            /* COPYRIGHT */
            $wp_customize -> add_setting( 'mythemes-copyright', array(
                'default'           => sprintf( __( 'Copyright &copy; 2015. Powered by %s.' , 'treeson' ) , '<a href="http://wordpress.org/">WordPress</a>' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_copyright',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-copyright', array(
                'label'             => __( 'Copyright', 'treeson' ),
                'description'       => __( 'You can change only the first side of copyright. With the premium version you can change all the footer text.' , 'treeson' ),
                'section'           => 'mythemes-others',
                'settings'          => 'mythemes-copyright',
                'type'              => 'textarea',
            ));
        }
	}
 
	add_action( 'customize_register' , 'mythemes_customize_register' );

	function mythemes_customizer_live_preview()
	{
        $ver = mythemes_core::theme( 'version' );

        $mythemes_js_ajaxurl = esc_url( admin_url( '/admin-ajax.php' ) );
    	wp_register_script( 'mythemes-themecustomizer', get_template_directory_uri() . '/media/_backend/js/customizer.js', array( 'jquery', 'customize-preview' ), $ver,  true );
        wp_localize_script( 'mythemes-themecustomizer', 'mythemes_js_ajaxurl', $mythemes_js_ajaxurl );
        wp_enqueue_script( 'mythemes-themecustomizer' );
	}

    function mythemes_upgrade()
    {
        $mythemes_premium_url = mythemes_core::theme( 'premium' );
        
        if( esc_url( $mythemes_premium_url ) ){
            wp_register_script( 'mythemes-upgrade', get_template_directory_uri() . '/media/_backend/js/upgrade.js', array( 'jquery' ), null, true );
            wp_localize_script( 'mythemes-upgrade', 'mythemes_premium_url', $mythemes_premium_url );
            wp_enqueue_script( 'mythemes-upgrade' );
        }
    }

    function mythemes_get_menu_childrens( $id )
    {
        global $mythemes_curr_ancestor;

        $pages = get_posts( array(
            'post_type'     => 'page',
            'order'         => 'ASC',
            'post_parent'   => $id
        ) );

        $rett = '';

        if( !empty( $pages ) ){

            $rett = '<ul class="sub-menu">';

            foreach( $pages as $p => $item ){

                $classes = '';

                if( is_page( $item -> ID ) ){
                    $classes = 'current-menu-item';
                    $mythemes_curr_ancestor = true;
                }

                $submenu = mythemes_get_menu_childrens( $item -> ID );

                if( !empty( $submenu ) ){
                    $classes .= 'menu-item-has-children';

                    if( $mythemes_curr_ancestor  ){
                        $classes .= ' current-menu-ancestor';
                    }
                }

                $rett .= '<li class="menu-item ' . esc_attr( $classes ) . '">';
                $rett .= '<a href="' . esc_url( get_permalink( $item -> ID ) ) . '" title="' . mythemes_post::title( $item -> ID, true ) . '">' . mythemes_post::title( $item -> ID ) . '</a>';

                $rett .= $submenu;

                $rett .= '</li>';

            }

            $rett .= '</ul>';
        }

        return $rett;
    }

	add_action( 'customize_preview_init', 'mythemes_customizer_live_preview' );
    add_action( 'customize_controls_print_footer_scripts', 'mythemes_upgrade' );

    if( is_user_logged_in() ){
        add_action( 'wp_ajax_mythemes_layout_load_sidebar' , array( 'mythemes_layout', 'load_sidebar' ), 100 );
    }

    /* FUNCTIONS FOR VALIDATE */
    function mythemes_validate_logic( $value )
    {
        $rett = true;

        if( absint( $value ) == 0 ){
            $rett = false;
        }

        return $rett;
    }

    function mythemes_validate_number( $value )
    {
        return absint( $value );
    }

    function mythemes_validate_layout( $value )
    {
        if( !in_array( $value , array( 'left' , 'full' , 'right' ) ) ){
            $value = 'right';
        }

        return $value;
    }

    function mythemes_validate_sidebar( $value )
    {
        if( !in_array( $value , array( 'main', 'front-page', 'page', 'post', 'special-page' ) ) ){
            $value = 'main';
        }

        return $value;
    }

    function mythemes_validate_copyright( $value )
    {
        return wp_kses( $value, array(
            'a' => array(
                'href'  => array(),
                'title' => array(),
                'class' => array(),
                'id'    => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'span'      => array()
        ));
    }

    function mythemes_validate_css( $value )
    {
        return stripslashes( strip_tags( $value ) );
    }

    function mythemes_mod( $option, $deff = null )
    {
        $rett = null;

        if( !empty( $deff ) ){
            $rett = get_theme_mod( 'mythemes-' . esc_attr( $option ) , get_theme_mod( esc_attr( $option ) , $deff ) );
        }
        else{
            $rett = get_theme_mod( 'mythemes-' . esc_attr( $option ) , get_theme_mod( esc_attr( $option ) ) );
        }
        
        return $rett;
    }
?>