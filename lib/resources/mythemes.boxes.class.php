<?php
if( !class_exists( 'mythemes_boxes' ) ){

class mythemes_boxes
{
    static function add( )
    {
        $boxes = mythemes_cfg::get_boxes();
        
        foreach( $boxes as $postSlug => & $postBoxes ) {
            foreach( $postBoxes as $boxSlug => $box ) {
                add_meta_box( $boxSlug
                    , $box[ 'title' ] 
                    , $box[ 'callback' ] 
                    , $postSlug 
                    , $box[ 'context' ] 
                    , $box[ 'priority' ] 
                    , $box[ 'args' ] 
                );
				
                if( isset( $box[ 'onSave' ] ) ) {
                    add_action( 'save_post', $box[ 'onSave' ], 10, 1 );
                }
            }
        }
    }
}

mythemes_cfg::add_action( array(
    'hook'      => 'admin_init',
    'caller'    => array( 'mythemes_boxes' , "add" )
));

}   /* END IF CLASS EXISTS */
?>