<?php
    /* COLORS */
    $color_1        = esc_attr( mythemes_mod( 'first-color', '#343b43' ) );
    $color_2        = esc_attr( mythemes_mod( 'second-color', '#5f992f' ) );
    $color_3        = esc_attr( mythemes_mod( 'third-color', '#416a9d' ) );

    $btn1_color     = esc_attr( mythemes_mod( 'first-btn-color', '#ffffff' ) );
    $btn2_color     = esc_attr( mythemes_mod( 'second-btn-color', '#ffffff' ) );

    $bg_color       = esc_attr( '#' . get_background_color() );
    $hd_bkg_color   = esc_attr( mythemes_mod( 'header-background-color', '#343b43' ) );

    $hd_color       = esc_attr( mythemes_mod( 'header-title-color' , '#ffffff' ) );

    $desc_color     = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( mythemes_mod( 'header-description-color' , '#ffffff' ) ) . ' , 0.5 )' );
    $desc_color_h   = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( mythemes_mod( 'header-description-color' , '#ffffff' ) ) . ' , 0.7 )' );

    /* GENERATED COLORS */
    $bg_color_rgba  = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $bg_color ) . ' , 0.91 )' );

    $hd_btn1_color  = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn1_color ) . ' , 0.4 )' );
    $hd_btn1_border = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn1_color ) . ' , 0.2 )' );
    $hd_btn1_bkg    = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn1_color ) . ' , 0.03 )' );

    $hd_btn1_color_ = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn1_color ) . ' , 0.9 )' );
    $hd_btn1_border_= esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn1_color ) . ' , 0.7 )' );

    $hd_btn2_color  = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn2_color ) . ' , 0.4 )' );
    $hd_btn2_border = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn2_color ) . ' , 0.2 )' );
    $hd_btn2_bkg    = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn2_color ) . ' , 0.03 )' );

    $hd_btn2_color_ = esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn2_color ) . ' , 0.9 )' );
    $hd_btn2_border_= esc_attr( 'rgba( ' . mythemes_tools::hex2rgb( $btn2_color ) . ' , 0.7 )' );
    

    $nav_1          = esc_attr( mythemes_tools::brightness( $color_1 , 60 ) );
    $nav_2          = esc_attr( mythemes_tools::brightness( $color_1 , -60 ) );

    $link_1         = esc_attr( mythemes_tools::brightness( $color_1 , 30 ) );

    $link_2         = esc_attr( mythemes_tools::brightness( $color_2 , 30 ) );
    $link_3         = esc_attr( mythemes_tools::brightness( $color_3 , 30 ) );

    $btn_border_1   = esc_attr( mythemes_tools::brightness( $color_1 , -40 ) );
    $btn_border_2   = esc_attr( mythemes_tools::brightness( $color_2 , -40 ) );

    $footer_p       = esc_attr( mythemes_tools::brightness( $color_1 , 95 ) );
    $footer_a       = esc_attr( mythemes_tools::brightness( $color_1 , 150 ) );
    $footer_ah      = esc_attr( mythemes_tools::brightness( $color_1 , 190 ) );
?>

<style type="text/css" id="mythemes-custom-style-header">
    .mythemes-header a.header-description{
        color: <?php echo esc_attr( $desc_color ); ?>;
    }
    .mythemes-header a.header-description:hover{
        color: <?php echo esc_attr( $desc_color_h ); ?>;
    }
</style>

<style type="text/css">

    /* HEADER */
    body{
        background-color: <?php echo esc_attr( $hd_bkg_color ); ?>;
    }
    .mythemes-header a.header-title{
        color: <?php echo esc_attr( $hd_color ); ?>;
    }

    /* BACKGROUND IMAGE */
    body > div.content,
    body footer aside{
        background-image: url(<?php echo esc_url( mythemes_mod( 'background_image' ) ); ?>);
        background-repeat: <?php echo esc_attr( mythemes_mod( 'background_repeat' ) ); ?>;
        background-position: <?php echo esc_attr( mythemes_mod( 'background_position_x' ) ); ?>;
        background-attachment: <?php echo esc_attr( mythemes_mod( 'background_attachment' ) ); ?>;
    }

    /* BREADCRUMBS */
    div.mythemes-page-header{
        padding-top: <?php echo absint( mythemes_mod( 'breadcrumbs-space', 60 ) ); ?>px;
        padding-bottom: <?php echo absint( mythemes_mod( 'breadcrumbs-space', 60 ) ); ?>px;
    }

</style>

<style type="text/css" id="mythemes-custom-style-background">

    /* BACKGROUND COLOR */
    body > div.content,
    body footer aside{
        background-color: <?php echo $bg_color; ?>;
    }


    /* MENU NAVIGATION */
    /* BACKGROUND COLOR */
    body.scroll-nav .mythemes-poor{
        background-color: <?php echo $bg_color_rgba; ?>;
    }
    .mythemes-poor{
        background-color: <?php echo $bg_color; ?>;
    }

</style>

<style type="text/css" id="mythemes-custom-style-color-btn-1">

    /* FIRST BUTTON */
    .header-button-wrapper a.btn.first-btn.header-button{
        color: <?php echo $hd_btn1_color; ?>;
        border: 1px solid <?php echo $hd_btn1_border; ?>;
        background: <?php echo $hd_btn1_bkg; ?>;
    }
    .header-button-wrapper a.btn.first-btn.header-button:hover{
        color: <?php echo $hd_btn1_color_; ?>;
        border: 1px solid <?php echo $hd_btn1_border_; ?>;
    }

</style>

<style type="text/css" id="mythemes-custom-style-color-btn-2">

    /* SECOND BUTTON */
    .header-button-wrapper a.btn.second-btn.header-button{
        color: <?php echo $hd_btn2_color; ?>;
        border: 1px solid <?php echo $hd_btn2_border; ?>;
        background: <?php echo $hd_btn2_bkg; ?>;
    }
    .header-button-wrapper a.btn.second-btn.header-button:hover{
        color: <?php echo $hd_btn2_color_; ?>;
        border: 1px solid <?php echo $hd_btn2_border_; ?>;
    }

</style>

<style type="text/css" id="mythemes-custom-style-color-1">

    /* COLOR 1 */
    nav.base-nav ul li a,
    div.widget-grofile.grofile a.grofile-full-link{
        color: <?php echo $nav_1; ?>;
    }
    nav.base-nav ul li:hover > a,
    nav.base-nav ul li > a:hover,
    nav.base-nav ul li.current-menu-item > a,
    nav.base-nav ul li.current-menu-ancestor > a,
    div.widget-grofile.grofile a.grofile-full-link:hover{
        color: <?php echo $nav_2; ?>;
    }

    /* COMMENTS */
    div.comments-list > ol li.pingback header cite a:hover,
    div.comments-list > ol li.comment header cite a:hover{
        color: <?php echo $link_1; ?>;
    }

    /* BUTTONS */
    /* CLASSES */
    .btn,
    .button,
    .mythemes-button,

    /* FORMS */
    button,
    input[type="submit"],
    input[type="button"],

    /* POST / PAGE CONTENT */
    .hentry button,
    .hentry input[type="button"],
    .hentry input[type="submit"],
    
    /* WIDGETS */
    div.widget_calendar table th,
    div.widget_post_meta ul li span.post-tag,

    /* POST META */
    article div.post-meta-tags a:hover,
    article div.post-meta-categories a,

    /* COMMENTS */
    div.comments-list > ol li.comment header span.comment-meta span.comment-replay a:hover,
    div#comments  p.form-submit input[type="submit"],

    /* PAGINATION */
    div.pagination nav span{
        background-color: <?php echo $color_1; ?>;
    }

    /* BUTTONS */
    /* BORDER BOTTOM */
    /* CLASSES */
    .btn,
    .button,
    .mythemes-button,

    /* FORMS */
    button,
    input[type="submit"],
    input[type="button"],

    /* POST CONTENT */
    .hentry button,
    .hentry input[type="button"],
    .hentry input[type="submit"],

    /* POST META */
    div.widget_post_meta ul li span.post-tag,

    /* POST META */
    article div.post-meta-tags a:hover,
    article div.post-meta-categories a,

    /* COMMENTS */
    div#comments  p.form-submit input[type="submit"],

    /* PAGINATION */
    div.pagination nav span{
        border-bottom: 1px solid <?php echo $btn_border_1; ?>;
    }

    /* BLOG */
    div.pagination nav a,
    article div.meta,
    article div.meta a,
    article a.more-link:hover,
    article div.meta ul.post-categories li a{
        color: <?php echo $color_1; ?>;
    }
    article div.meta ul.post-categories li a:hover{
        background-color: <?php echo $color_1; ?>;
    }
    article a.more-link:hover{
        border: 3px solid <?php echo $color_1; ?>;
    }

    /* STIKY */
    article.sticky a.more-link{
        background: <?php echo $color_1; ?>;
        border: 3px solid <?php echo $color_1; ?>;
    }
    article.sticky a.more-link:hover{
        color: <?php echo $color_1; ?>;
    }
        

    /* FOOTER */
    footer .mythemes-black-side{
        background: <?php echo $color_1; ?>;
    }
    footer .mythemes-black-side .mythemes-copyright p,
    footer .mythemes-black-side .mythemes-menu a{
        color: <?php echo $footer_p; ?>;
    }
    footer .mythemes-black-side .mythemes-copyright a,
    footer .mythemes-black-side .mythemes-menu a:hover{
        color: <?php echo $footer_a; ?>;
    }
    footer .mythemes-black-side .mythemes-copyright a:hover{
        color: <?php echo $footer_ah; ?>;   
    }

</style>

<style type="text/css" id="mythemes-custom-style-color-2">

    /* COLOR 2 */
    nav.base-nav ul li.current-menu-item > a{
        color: <?php echo $link_2; ?>;
    }

    /* HOVER COLOR */
    a:hover,

    /* META */
    article div.meta a:hover{
        color: <?php echo $link_2; ?>;
    }

    /* SECOND BUTTONS */
    /* CLASSES */
    .btn.second-button,
    .button.second-button,
    .mythemes-button.second-button,

    /* MENU */
    .mythemes-nav-btn button.btn-base-nav,

    /* WIDGETS */
    div.widget_post_tags div.tagcloud a,
    div.widget_tag_cloud div.tagcloud a,
    div.widget_newsletter form button[type="submit"],

    /* COMMENTS */
    div.comments-list > ol li.comment header span.comment-meta span.comment-replay a,
    div.comment-respond h3.comment-reply-title small a,
    
    /* POST META */
    article div.post-meta-categories a:hover,
    article div.post-meta-tags a{
        background-color: <?php echo $color_2; ?>;
    }

    /* SECOND BUTTONS */
    /* BORDER BOTTOM */
    /* CLASSES */
    .btn.second-button,
    .button.second-button,
    .mythemes-button.second-button,

    /* MENU */
    .mythemes-nav-btn button.btn-base-nav,

    /* WIDGETS */
    div.widget_post_tags div.tagcloud a,
    div.widget_tag_cloud div.tagcloud a,
    div.widget_newsletter form button[type="submit"],

    /* POST META */
    article div.post-meta-tags a,
    article div.post-meta-categories a:hover,

    /* COMMENTS */
    div.comment-respond h3.comment-reply-title small a{
        border-bottom: 1px solid <?php echo $btn_border_2; ?>;
    }

</style>

<style type="text/css" id="mythemes-custom-style-color-3">

    /* COLOR 3 */
    /* LINK */
    a,

    /* WIDGETS */
    div.widget ul li a:hover,
    div.widget_calendar table td a:hover,
    div.widget_categories ul li a:hover,
    div.widget_recent_comments_with_avatar ul li h5 a:hover{
        color: <?php echo $link_3; ?>;
    }

    /* POST TITLE HEADLINE */
    .hentry h2 a:hover,
    article h2 a:hover{
        color: <?php echo $color_3; ?>;
    }

</style>

<style type="text/css" id="mythemes-custom-css">

    <?php
        echo mythemes_validate_css( mythemes_mod( 'custom-css' ) );
    ?>

</style>