<?php
$def = array();

/* OTHERS */
$def[ 'author-link' ] 						= sprintf( __( 'Designed by %s.' , 'treeson' ) , '<a href="' . esc_url( mythemes_core::author( 'url' ) ) . '" target="_blank" title="' . esc_attr( mythemes_core::author( 'name' ) ) . '">' . mythemes_core::author( 'name' ) . '</a>' );

mythemes_cfg::set_def( $def );
?>