<?php

$pages  = mythemes_cfg::get_pages();


$cols   = array();
$boxes  = array();
$sett   = array();


$pages[ 'mythemes-treeson-faq' ] = array(
    'menu' => array(
        'label'     => __( 'Treeson FAQ' , 'treeson' )
    ),
    'cols'  => & $cols,
    'boxes' => & $boxes,
    'sett'  => & $sett
);


mythemes_cfg::set_pages( $pages );


$is_enb_fp  = get_option( 'show_on_front' ) == 'page';
$content    = array( 'left', 'full', 'right' );
$sidebars   = array(
    'main-sidebar'          => __( 'Main Sidebar' , 'treeson' ),
    'front-page-sidebar'    => __( 'Front Page Sidebar' , 'treeson' ),
    'page-sidebar'          => __( 'Default Page Sidebar' , 'treeson' ),
    'post-sidebar'          => __( 'Default Post Sidebar' , 'treeson' ),
    'special-page-sidebar'  => __( 'Special Page Sidebar' , 'treeson' )
);

$sett[ 'author-link' ] = array(
    'type' => array(
        'validator' => 'copyright'
    )
);

mythemes_cfg::set_sett( array_merge( mythemes_cfg::get_sett() , $sett ) );
?>