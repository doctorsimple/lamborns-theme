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
    if ( dynamic_sidebar( 'front-page-header-first' ) ){
        /* IF NOT EMPTY */
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<div class="textwidget">';
        echo '<img class="aligncenter" src="' . get_template_directory_uri() . '/media/img/diamond.png"/>';
        echo '<h3 style="text-align: center;">' . __( 'Many Components' , 'treeson' ) . '</h3>';
        echo '<p>' . __( 'There are a lot of different components that will help you to make a perfect suit for startup project with WordPress theme Treeson.' , 'treeson' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>