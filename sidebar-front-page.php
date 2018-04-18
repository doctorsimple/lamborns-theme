<?php
	global $wp_customize;

	$default_class = '';

	/* WP CUSTOMIZE */
	if( isset( $wp_customize ) ){
		$default = true;
		$default_class = !(bool)mythemes_mod( 'default-content', true ) ? 'hidden' : '';
	}

	/* FRONTEND */
	else{
		$default = (bool)mythemes_mod( 'default-content', true );
	}

	/* SIDEBAR */
    if ( dynamic_sidebar( 'front-page' ) ){
        /* IF NOT EMPTY */    
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<div class="textwidget">';
        echo '<h3>' . __( 'Default Content' , 'treeson' ) . '</h3>';
        echo '<p>' . __( 'You can hide all default content from sidebars if you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional and disable option "Display default content".' , 'treeson' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>