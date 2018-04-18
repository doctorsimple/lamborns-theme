<?php
if( !class_exists( 'mythemes_blog_details' ) ){

class mythemes_blog_details extends WP_Widget
{
    function __construct()
    {
        parent::__construct( 'mythemes_blog_details', __( 'Blog Details' , 'treeson' ) . ' [' . mythemes_core::author( 'name' ) . ']', array( 
            'classname'     => 'widget_blog_details', 
            'description'   => __( 'Blog Details' , 'treeson' )
        ));
    }

    function widget( $args, $instance )
    {
        /* PRINT THE WIDGET */
        extract( $args , EXTR_SKIP );
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => null,
            'description'   => null
        ));

        $title  = $instance[ 'title' ];
        $desc   = $instance[ 'description' ];

        echo $before_widget;

        if( !empty( $title ) ){
            echo '<h1><a href="'. esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $title . ' - ' . strip_tags( $desc ) ) . '">' . esc_html( $title ) . '</a></h1>';
        }

        if( !empty( $desc ) ){
            echo htmlspecialchars_decode( $desc );
        }

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        /* UPATE THE WIDGET OPTIONS */
        $instance                       = $old_instance;
        $instance[ 'title' ]            = esc_attr( strip_tags( $new_instance[ 'title' ] ) );
        $instance[ 'description' ]      = htmlspecialchars( $new_instance[ 'description' ] , null, null, false );
        return $instance;
    }

    function form( $instance )
    {
        /* PRINT WIDGET FORM */
        $instance = wp_parse_args( (array) $instance, array( 
            'title'         => esc_attr( get_bloginfo( 'name' ) ),
            'description'   => esc_attr( get_bloginfo( 'description' ) )
        ));
        
        $title  = $instance[ 'title' ];
        $desc   = $instance[ 'description' ];
        
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'title' ) . '">' . __( 'Title' , 'treeson' );
        echo '<input type="text" class="widefat" id="' . $this -> get_field_id( 'title' ) . '" name="' . $this -> get_field_name( 'title' ) . '" value="' . esc_attr( $title ) . '" />';
        echo '</label>';
        echo '</p>';

        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'description' ) . '">' . __( 'Description' , 'treeson' );
        echo '<textarea class="widefat" id="' . $this -> get_field_id( 'description' ) . '" name="' . $this -> get_field_name( 'description' ) . '">' . htmlspecialchars( $desc , null, null, false ) . '</textarea>';
        echo '</label>';
        echo '</p>';
    }
}

register_widget( 'mythemes_blog_details' );

}   /* END IF CLASS EXISTS */
?>