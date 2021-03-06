<?php
    global $posts_total, $posts_index;
    
    $mythemes_layout = new mythemes_layout( );

    /* LEFT SIDEBAR */
    $mythemes_layout -> sidebar( 'left' );
?>

<!-- CONTENT -->
<section class="<?php echo $mythemes_layout -> classes(); ?> mythemes-classic">
<?php

    /* LEFT WRAPPER */
    echo $mythemes_layout -> wrapper( 'left' );
    
    /* CONTENT WRAPPER */ 
    if( have_posts() ){
        $posts_total = count( $wp_query -> posts );
        $posts_index = 0;
        while( have_posts() ){
            $posts_index++;
            the_post();
            get_template_part( 'templates/views/classic' );
        }
    }
    else{
        echo '<h3>' . __( 'Not found results' , 'treeson' ) . '</h3>';
        echo '<p>' . __( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'treeson' ) . '</p>';
    }

    /* PAGINATION */
    get_template_part( 'templates/pagination' );

    /* RIGHT WRAPPER */
    echo $mythemes_layout -> wrapper( 'right' );
?>
</section>

<?php
    /* LEFT SIDEBAR */
    $mythemes_layout -> sidebar( 'right' );
?>