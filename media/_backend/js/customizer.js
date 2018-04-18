
function lg( params ){
	console.log( params );
}

function mythemes_hex2rgb( hex )
{
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( hex );
    var colors = result ? {
        r: parseInt( result[1], 16 ),
        g: parseInt( result[2], 16 ),
        b: parseInt( result[3], 16 )
    } : null;

    var rett = '';

    if( colors.hasOwnProperty( 'r' ) ){
    	rett += colors.r + ' , ';
    }
    else{
    	rett += '255 , ';
    }

    if( colors.hasOwnProperty( 'g' ) ){
    	rett += colors.g + ' , ';
    }
    else{
    	rett += '255 , ';
    }

    if( colors.hasOwnProperty( 'b' ) ){
    	rett += colors.b;
    }
    else{
    	rett += '255';	
    }

    return rett;
}

function mythemes_brightness( hex, steps )
{
    var steps 	= Math.max( -255, Math.min( 255, steps ) );
    var hex 	= hex.toString().replace( /#/g, "" );

    if ( hex.length == 3 ) {
        hex = 
        hex.substring( 0, 1 ) + hex.substring( 0, 1 ) +
        hex.substring( 1, 2 ) + hex.substring( 1, 2 ) +
        hex.substring( 2, 3 ) + hex.substring( 2, 3 );
    }

    var r = parseInt( hex.substring( 0, 2 ).toString() , 16 );
    var g = parseInt( hex.substring( 2, 4 ).toString() , 16 );
    var b = parseInt( hex.substring( 4, 6 ).toString() , 16 );

    r = Math.max( 0, Math.min( 255, r + steps ) ).toString(16).toUpperCase();
    g = Math.max( 0, Math.min( 255, g + steps ) ).toString(16).toUpperCase();  
    b = Math.max( 0, Math.min( 255, b + steps ) ).toString(16).toUpperCase();

	var r_hex = Array( 3 - r.length ).join( '0' ) + r;
	var g_hex = Array( 3 - g.length ).join( '0' ) + g;
	var b_hex = Array( 3 - b.length ).join( '0' ) + b;

    return '#' + r_hex + g_hex + b_hex;
}

function mythemes_load_sidebar( sidebar, position ){
    jQuery(function(){

        if( typeof mythemes_js_ajaxurl == 'string' && mythemes_js_ajaxurl.length ){

            if( jQuery( 'div.content > div.container > div.row > aside' ).length ){
                jQuery( 'div.content > div.container > div.row > aside' ).remove();
            }

            if( jQuery( 'div.content > div.container > div.row > section' ).hasClass( 'col-lg-12' ) ){
                jQuery( 'div.content > div.container > div.row > section' ).removeClass( 'col-lg-12' );
                jQuery( 'div.content > div.container > div.row > section' ).addClass( 'col-sm-8 col-md-9 col-lg-9' );
            }

            if( position == 'left' ){
                if( jQuery( 'div.content > div.container > div.row > section div.content-border' ).hasClass( 'right' ) ){
                    jQuery( 'div.content > div.container > div.row > section div.content-border' ).removeClass( 'right' );
                }
                
                if( !jQuery( 'div.content > div.container > div.row > section div.content-border' ).hasClass( 'left' ) ){
                    jQuery( 'div.content > div.container > div.row > section div.content-border' ).addClass( 'left' );
                }

                jQuery( 'div.content > div.container > div.row > section' ).parent().prepend( '<aside class="col-sm-4 col-md-3 col-lg-3 sidebar-to-' + position + '"></aside>' );
            }
            else{
                if( jQuery( 'div.content > div.container > div.row > section div.content-border' ).hasClass( 'left' ) ){
                    jQuery( 'div.content > div.container > div.row > section div.content-border' ).removeClass( 'left' );
                }
                
                if( !jQuery( 'div.content > div.container > div.row > section div.content-border' ).hasClass( 'right' ) ){
                    jQuery( 'div.content > div.container > div.row > section div.content-border' ).addClass( 'right' );
                }

                jQuery( 'div.content > div.container > div.row > section' ).parent().append( '<aside class="col-sm-4 col-md-3 col-lg-3 sidebar-to-' + position + '"></aside>' );
            }

            jQuery.post( mythemes_js_ajaxurl, 
                {
                    'action' : 'mythemes_layout_load_sidebar',
                    'sidebar': sidebar
                },
                function( result ){
                    jQuery( 'div.content > div.container > div.row > aside' ).html( result );

                    jQuery( 'div.content > div.container > div.row > aside div.widget_tag_cloud div.tagcloud' ).append( '<div class="clear clearfix"></div>' );
                    jQuery( 'div.content > div.container > div.row > aside div.widget_tag_cloud div.tagcloud a, div.content > div.container > div.row > aside div.widget_post_tags div.tagcloud a' ).each(function(){

                        jQuery( this ).removeAttr( 'style' );
                        jQuery( this ).removeAttr( 'class' );

                        var text = jQuery( this ).text();
                        var nr   = jQuery( this ).attr( 'title' ).split( " " )[0];


                        jQuery( this ).html( '<span>' +
                            '<span class="icon"><i class="icon-tag"></i></span>' +
                            '<span class="tag-name">' + text + '</span>' +
                            '<span class="counter">' + nr + '</span>' +
                            '</span>'
                        );

                        var icon            = jQuery( this ).find( 'span.icon' );
                        var name            = jQuery( this ).find( 'span.tag-name' );
                        var counter         = jQuery( this ).find( 'span.counter' );

                        var icon_width      = icon.outerWidth();
                        var counter_width   = counter.outerWidth();

                        var diff            = counter_width - icon_width;
                        var name_width      = name.outerWidth();
                        var width           = 0;

                        if( diff < 0 ){
                            diff            = 0;
                            width           = name_width + icon_width;
                            counter.css({ 'width' : icon_width + 'px' });    
                        }else{
                            width           = name_width + counter_width;
                        }

                        counter.css({ 'margin-left' : diff + 'px' });
                        jQuery( this ).css({ 'width' : width + 'px' });
                    });
                }
            );
        }
    });
} 

(function($){

    wp.customize( 'mythemes-logo' , function( value ){
        value.bind(function( newval ){

        	if( newval.length ){
        		if( jQuery( 'div.mythemes-header a.mythemes-logo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-header a.mythemes-logo' ).removeClass( 'hidden' );
        		}

        		if( jQuery( 'div.mythemes-header a.mythemes-logo img' ).length ){
        			jQuery( 'div.mythemes-header a.mythemes-logo img' ).attr( 'src' , newval );	
        		}
        		else{
        			jQuery( '<img src="' + newval + '"/>' ).appendTo( 'div.mythemes-header a.mythemes-logo' );
        		}
        		
        	}
        	else{
				if( !jQuery( 'div.mythemes-header a.mythemes-logo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-header a.mythemes-logo' ).addClass( 'hidden' );
        		}        		
        	}
        });
    });

    /* COLORS */
    wp.customize( 'background_color' , function( value ){
        value.bind(function( newval ){

        	var bg_color 		= newval;
        	var bg_color_rgba 	= 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.91 )';
        	jQuery( 'style#mythemes-custom-style-background' ).html(

        		/* BACKGROUND COLOR */
    			'body > div.content,' +
    			'body footer aside{' +
        		'background-color: ' + bg_color + ';' +
    			'}' +

    			/* MENU NAVIGATION */
    			/* BACKGROUND COLOR */
    			'body.scroll-nav .mythemes-poor{' +
        		'background-color: ' + bg_color_rgba + ';' +
    			'}' +

    			'.mythemes-poor{' +
        		'background-color: ' + bg_color + ';' +
    			'}'
        	);
        });
    });

    wp.customize( 'mythemes-first-color' , function( value ){
        value.bind(function( newval ){

        	var color_1 		= newval;

        	var nav_1			= mythemes_brightness( color_1 ,  60 );
        	var nav_2			= mythemes_brightness( color_1 , -60 );

        	var link_1			= mythemes_brightness( color_1 ,  30 );

        	var btn_border_1	= mythemes_brightness( color_1 , -40 );

        	var footer_p		= mythemes_brightness( color_1 ,  95 );
        	var footer_a 		= mythemes_brightness( color_1 , 150 );
        	var footer_ah		= mythemes_brightness( color_1 , 190 );

        	jQuery( 'style#mythemes-custom-style-color-1' ).html(
        		'nav.base-nav ul li a,' +
    			'div.widget-grofile.grofile a.grofile-full-link{' +
        		'color:' + nav_1 + ';' +
    			'}' +

    			'nav.base-nav ul li:hover > a,' +
    			'nav.base-nav ul li > a:hover,' +
    			'div.widget-grofile.grofile a.grofile-full-link:hover{' +
        		'color:' + nav_2 + ';' +
    			'}' +

    			/* COMMENTS */
    			'div.comments-list > ol li.pingback header cite a:hover,' +
			    'div.comments-list > ol li.comment header cite a:hover{' +
			    'color: ' + link_1 + ';' +
			    '}' +

			    /* BUTTONS */
			    /* CLASSES */
			    '.btn,' +
			    '.button,' +
			    '.mythemes-button,' +

			    /* FORMS */
			    'button,' +
			    'input[type="submit"],' +
			    'input[type="button"],' +


			    /* POST / PAGE CONTENT */
			    '.hentry button,' +
			    '.hentry input[type="button"],' +
			    '.hentry input[type="submit"],' +
			    
			    /* WIDGETS */
			    'div.widget_calendar table th,' +
			    'div.widget_post_meta ul li span.post-tag,' +

			    /* POST META */
			    'article div.post-meta-tags a:hover,' +
			    'article div.post-meta-categories a,' +

			    /* COMMENTS */
                'div.comments-list > ol li.comment header span.comment-meta span.comment-replay a:hover' +
			    'div#comments  p.form-submit input[type="submit"],' +

			    /* PAGINATION */
			    'div.pagination nav span{' +
			    'background-color: ' + color_1 + ';' +
			    '}' +


			    /* BUTTONS */
    			/* BORDER BOTTOM */
    			/* CLASSES */
			    '.btn,' +
			    '.button,' +
			    '.mythemes-button,' +

			    /* FORMS */
			    'button,' +
			    'input[type="submit"],' +
			    'input[type="button"],' +

    			/* POST CONTENT */
    			'.hentry button,' +
    			'.hentry input[type="button"],' +
			    '.hentry input[type="submit"],' +

			    /* POST META */
			    'div.widget_post_meta ul li span.post-tag,' +


			    /* POST META */
			    'article div.post-meta-tags a:hover,' +
			    'article div.post-meta-categories a,' +

			    /* COMMENTS */
			    'div#comments  p.form-submit input[type="submit"],' +

			    /* PAGINATION */
			    'div.pagination nav span{' +
			    'border-bottom: 1px solid ' + btn_border_1 + ';' +
			    '}' +

			    /* BLOG */
			    'div.pagination nav a,' +
			    'article div.meta,' +
			    'article div.meta a,' +
			    'article a.more-link:hover,' +
			    'article div.meta ul.post-categories li a{' +
			    'color: ' + color_1 + ';' +
			    '}' +

			    'article div.meta ul.post-categories li a:hover{' +
			    'background-color: ' + color_1 + ';' +
			    '}' +

			    'article a.more-link:hover{' +
			    'border: 3px solid ' + color_1 + ';' +
			    '}' +

			    /* STIKY */
			    'article.sticky a.more-link{' +
			    'background: ' + color_1 + ';' +
			    'border: 3px solid ' + color_1 + ';' +
			    '}' +

			    'article.sticky a.more-link:hover{' +
			    'color: ' + color_1 + ';' +
			    '}' +

			    /* FOOTER */
			    'footer .mythemes-black-side{' +
			    'background: ' + color_1 + ';' +
			    '}' +

			    'footer .mythemes-black-side .mythemes-copyright p,' +
			    'footer .mythemes-black-side .mythemes-menu a{' +
			    'color: ' + footer_p + ';' +
			    '}' +

			    'footer .mythemes-black-side .mythemes-copyright a,' +
			    'footer .mythemes-black-side .mythemes-menu a:hover{' +
			    'color: ' + footer_a + ';' +
			    '}' +

			    'footer .mythemes-black-side .mythemes-copyright a:hover{' +
			    'color: ' + footer_ah + ';' +
			    '}'
        	);
        });
    });

	wp.customize( 'mythemes-second-color' , function( value ){
        value.bind(function( newval ){

        	var color_2			= newval;
        	var link_2 			= mythemes_brightness( color_2 ,  30 );
        	var btn_border_2	= mythemes_brightness( color_2 , -40 );


        	jQuery( 'style#mythemes-custom-style-color-2' ).html( 

        		/* COLOR 2 */
        		'nav.base-nav ul li.current-menu-item > a{' +
			    'color: ' + link_2 + ';' +
			    '}' +

			    /* HOVER COLOR */
			    'a:hover,' + 

			    /* META */
			    'article div.meta a:hover{' +
			    'color: ' + link_2 + ';' +
			    '}' +

			    /* SECOND BUTTONS */
			    /* CLASSES */
			    '.btn.second-button,' +
			    '.button.second-button,' +
			    '.mythemes-button.second-button,' +

			    /* MENU */
			    '.mythemes-nav-btn button.btn-base-nav,' +

			    /* WIDGETS */
			    'div.widget_post_tags div.tagcloud a,' +
			    'div.widget_tag_cloud div.tagcloud a,' +
			    'div.widget_newsletter form button[type="submit"],' +

			    /* COMMENTS */
			    'div.comment-respond h3.comment-reply-title small a,' +
                'div.comments-list > ol li.comment header span.comment-meta span.comment-replay a,' +
			    
			    /* POST META */
			    'article div.post-meta-categories a:hover,' +
			    'article div.post-meta-tags a{' +
			    'background-color: ' + color_2 + ';' +
			    '}' +

			    /* SECOND BUTTONS */
			    /* BORDER BOTTOM */
			    /* CLASSES */
			    '.btn.second-button,' +
			    '.button.second-button,' +
			    '.mythemes-button.second-button,' +

			    /* MENU */
			    '.mythemes-nav-btn button.btn-base-nav,' +

			    /* WIDGETS */
			    'div.widget_post_tags div.tagcloud a,' +
			    'div.widget_tag_cloud div.tagcloud a,' +
			    'div.widget_newsletter form button[type="submit"],' +

			    /* POST META */
			    'article div.post-meta-tags a,' +
			    'article div.post-meta-categories a:hover,' +

			    /* COMMENTS */
			    'div.comment-respond h3.comment-reply-title small a{' +
			    'border-bottom: 1px solid ' + btn_border_2 + ';' +
			    '}'
        	);
        });
    });

	wp.customize( 'mythemes-third-color' , function( value ){
        value.bind(function( newval ){

        	var color_3			= newval;
        	var link_3         	= mythemes_brightness( color_3 , 30 );

        	jQuery( 'style#mythemes-custom-style-color-3' ).html(
        		/* COLOR 3 */
    			/* LINK */
    			'a,' +

    			/* WIDGETS */
    			'div.widget ul li a:hover,' +
    			'div.widget_calendar table td a:hover,' +
    			'div.widget_categories ul li a:hover,' +
    			'div.widget_recent_comments_with_avatar ul li h5 a:hover{' +
        		'color: ' + link_3 + ';' +
    			'}' +

    			/* POST TITLE HEADLINE */
    			'.hentry h2 a:hover,' +
    			'article h2 a:hover{' +
        		'color: ' + color_3 + ';' +
    			'}'
        	);
        });
    });

    /* HEADER */
    /* GENERAL */
    wp.customize( 'mythemes-header-front-page' , function( value ){
        value.bind(function( newval ){
            if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'on-front-page' ) ){
                if( newval ){
                    if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).removeClass( 'hidden' );
                    }
                }
                else{
                    if( !jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).addClass( 'hidden' );
                    }   
                }
            }
        });
    });

    wp.customize( 'mythemes-header-blog-page' , function( value ){
        value.bind(function( newval ){
            if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'on-blog-page' ) ){
                if( newval ){
                    if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).removeClass( 'hidden' );
                    }
                }
                else{
                    if( !jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).addClass( 'hidden' );
                    }   
                }
            }
        });
    });

    wp.customize( 'mythemes-header-templates' , function( value ){
        value.bind(function( newval ){
            if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'on-templates' ) ){
                if( newval ){
                    if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).removeClass( 'hidden' );
                    }
                }
                else{
                    if( !jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).addClass( 'hidden' );
                    }   
                }
            }
        });
    });

    wp.customize( 'mythemes-header-single-posts' , function( value ){
        value.bind(function( newval ){
            if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'on-single-posts' ) ){
                if( newval ){
                    if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).removeClass( 'hidden' );
                    }
                }
                else{
                    if( !jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).addClass( 'hidden' );
                    }   
                }
            }
        });
    });

    wp.customize( 'mythemes-header-single-pages' , function( value ){
        value.bind(function( newval ){
            if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'on-single-pages' ) ){
                if( newval ){
                    if( jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).removeClass( 'hidden' );
                    }
                }
                else{
                    if( !jQuery( 'div.mythemes-header.mythemes-bkg-image' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.mythemes-header.mythemes-bkg-image' ).addClass( 'hidden' );
                    }   
                }
            }
        });
    });

    wp.customize( 'mythemes-header-height' , function( value ){
        value.bind(function( newval ){
            jQuery( 'div.mythemes-header.parallax-container' ).css( 'height' , parseInt( newval ).toString() + 'px' );
        });
    });

    wp.customize( 'mythemes-header-image' , function( value ){
        value.bind(function( newval ){
            if( jQuery( 'div.mythemes-header.parallax-container div.parallax img' ).length ){
                jQuery( 'div.mythemes-header.parallax-container div.parallax img' ).attr( 'src' , newval );
            }
            else{
                jQuery( 'div.mythemes-header.parallax-container div.parallax' ).html( '<img src="' + newval + '"/>' );   
            }
        });
    });

    wp.customize( 'mythemes-header-background-color' , function( value ){
        value.bind(function( newval ){
            jQuery( 'body' ).css( 'background-color' , newval );
            jQuery( 'body' ).css( 'backgroundColor' , newval );
        });
    });

    wp.customize( 'mythemes-header-mask-color' , function( value ){
        value.bind(function( newval ){
            var opacity = parseFloat( wp.customize.instance( 'mythemes-header-mask-opacity' ).get() / 100 ).toString();
            jQuery( 'div.mythemes-header div.valign-cell-wrapper' ).css( 'background-color' , 'rgba(' + mythemes_hex2rgb( newval ) + ' , ' + opacity + ')' );
        });
    });

    wp.customize( 'mythemes-header-mask-opacity' , function( value ){
        value.bind(function( newval ){
            var opacity = parseFloat( newval / 100 ).toString();
            var color   = wp.customize.instance( 'mythemes-header-mask-color' ).get().toString();
            jQuery( 'div.mythemes-header div.valign-cell-wrapper' ).css( 'background-color' , 'rgba(' + mythemes_hex2rgb( color ) + ' , ' + opacity + ')' );
        });
    });

    /* CONTENT */
    wp.customize( 'mythemes-header-title' , function( value ){
        value.bind(function( newval ){
        	if( newval ){
        		if( jQuery( '.mythemes-header a.header-title' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-title' ).removeClass( 'hidden' );
        		}
        	}
        	else{
        		if( !jQuery( '.mythemes-header a.header-title' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-title' ).addClass( 'hidden' );
        		}	
        	}
        });
    });

    wp.customize( 'mythemes-header-title-color' , function( value ){
        value.bind(function( newval ){
        	jQuery( '.mythemes-header a.header-title' ).css( 'color' , newval );
        });
    });

    wp.customize( 'mythemes-header-description' , function( value ){
        value.bind(function( newval ){
        	if( newval ){
        		if( jQuery( '.mythemes-header a.header-description' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-description' ).removeClass( 'hidden' );
        		}
        	}
        	else{
        		if( !jQuery( '.mythemes-header a.header-description' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-description' ).addClass( 'hidden' );
        		}	
        	}
        });
    });

    wp.customize( 'mythemes-header-description-color' , function( value ){
        value.bind(function( newval ){

        	var desc_color 		= 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.5 )';
        	var desc_color_h 	= 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.7 )';

        	jQuery( 'style#mythemes-custom-style-header' ).html( 
        		'.mythemes-header a.header-description{' +
        		'color: ' + desc_color + ';' +
    			'}'+

    			'.mythemes-header a.header-description:hover{' +
        		'color: ' + desc_color_h + ';' +
    			'}'
    		);
        });
    });


    /* FIRST BUTTON */
    wp.customize( 'mythemes-first-btn' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                if( jQuery( 'div.header-button-wrapper a.first-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.first-btn' ).removeClass( 'hidden' );
                }
            }
            else{
                if( !jQuery( 'div.header-button-wrapper a.first-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.first-btn' ).addClass( 'hidden' );
                }   
            }
        });
    });
    
    wp.customize( 'mythemes-first-btn-color' , function( value ){
        value.bind(function( newval ){

            var hd_btn1_color       = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.4 )';
            var hd_btn1_border      = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.2 )';
            var hd_btn1_bkg         = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.03 )';

            var hd_btn1_color_      = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.9 )';
            var hd_btn1_border_     = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.7 )';

            jQuery( 'style#mythemes-custom-style-color-btn-1' ).html( 
                /* FIRST BUTTON */
                '.header-button-wrapper a.btn.first-btn.header-button{' +
                'color: ' + hd_btn1_color + ';' +
                'border: 1px solid ' + hd_btn1_border + ';' +
                'background: ' + hd_btn1_bkg + ';' +
                '}' +

                '.header-button-wrapper a.btn.first-btn.header-button:hover{' +
                'color: ' + hd_btn1_color_ + ';' +
                'border: 1px solid ' + hd_btn1_border_ + ';' +
                '}'
            );
        });
    });
    
    wp.customize( 'mythemes-first-btn-url' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.first-btn' ).attr( 'href' , newval );
        });
    });
    
    wp.customize( 'mythemes-first-btn-label' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.first-btn' ).html( newval );
        });
    });
    
    wp.customize( 'mythemes-first-btn-description' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.first-btn' ).attr( 'title' , newval );
        });
    });

    wp.customize( 'mythemes-first-btn-target' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( '.header-button-wrapper a.first-btn' ).attr( 'target' , '_blank' );
            }
            else{
                if( jQuery( '.header-button-wrapper a.first-btn' ).attr( 'target' ).length ){
                    jQuery( '.header-button-wrapper a.first-btn' ).removeAttr( 'target' );
                }
            }
        });
    });

    /* SECOND BUTTON */
    wp.customize( 'mythemes-second-btn' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                if( jQuery( 'div.header-button-wrapper a.second-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.second-btn' ).removeClass( 'hidden' );
                }
            }
            else{
                if( !jQuery( 'div.header-button-wrapper a.second-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.second-btn' ).addClass( 'hidden' );
                }   
            }
        });
    });
    
    wp.customize( 'mythemes-second-btn-color' , function( value ){
        value.bind(function( newval ){

            var hd_btn2_color       = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.4 )';
            var hd_btn2_border      = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.2 )';
            var hd_btn2_bkg         = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.03 )';

            var hd_btn2_color_      = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.9 )';
            var hd_btn2_border_     = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.7 )';

            jQuery( 'style#mythemes-custom-style-color-btn-2' ).html( 
                /* FIRST BUTTON */
                '.header-button-wrapper a.btn.second-btn.header-button{' +
                'color: ' + hd_btn2_color + ';' +
                'border: 1px solid ' + hd_btn2_border + ';' +
                'background: ' + hd_btn2_bkg + ';' +
                '}' +

                '.header-button-wrapper a.btn.second-btn.header-button:hover{' +
                'color: ' + hd_btn2_color_ + ';' +
                'border: 1px solid ' + hd_btn2_border_ + ';' +
                '}'
            );
        });
    });
    
    wp.customize( 'mythemes-second-btn-url' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.second-btn' ).attr( 'href' , newval );
        });
    });
    
    wp.customize( 'mythemes-second-btn-label' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.second-btn' ).html( newval );
        });
    });
    
    wp.customize( 'mythemes-second-btn-description' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.second-btn' ).attr( 'title' , newval );
        });
    });

    wp.customize( 'mythemes-second-btn-target' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( '.header-button-wrapper a.second-btn' ).attr( 'target' , '_blank' );
            }
            else{
                if( jQuery( '.header-button-wrapper a.second-btn' ).attr( 'target' ).length ){
                    jQuery( '.header-button-wrapper a.second-btn' ).removeAttr( 'target' );
                }
            }
        });
    });


    /* BREADCRUMBS */
	wp.customize( 'mythemes-breadcrumbs' , function( value ){
        value.bind(function( newval ){

        	if( newval ){
        		jQuery( 'div.mythemes-page-header' ).show();
        	}
        	else{
        		jQuery( 'div.mythemes-page-header' ).hide();	
        	}
        });
    });

    wp.customize( 'mythemes-home-label' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-page-header li#home-label a span' ).html( newval );
        });
    });

    wp.customize( 'mythemes-home-link-description' , function( value ){
        value.bind(function( newval ){
            jQuery( 'div.mythemes-page-header li#home-label a' ).attr( 'title' , newval );
        });
    });

    wp.customize( 'mythemes-breadcrumbs-space' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-page-header' ).css({ 'padding-top' : newval + 'px' , 'padding-bottom' : newval + 'px' });
        });
    });

    /* ADDITIONAL */
    wp.customize( 'mythemes-blog-title' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-page-header h1#blog-title' ).html( newval );
        });
    });
    
    wp.customize( 'mythemes-default-content' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                if( jQuery( 'div.mythemes-default-content' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.mythemes-default-content' ).removeClass( 'hidden' );
                }

                /* HEADER WIDGETS */
                if( jQuery( 'div.content aside.mythemes-default-content > div' ).find( 'div.mythemes-default-content' ).length ){
                    if( jQuery( 'div.content aside.mythemes-default-content' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.content aside.mythemes-default-content' ).removeClass( 'hidden' );
                    }
                }

                /* FOOTER WIDGETS */
                if( jQuery( 'footer aside.mythemes-default-content div.container div.row > div' ).find( 'div.mythemes-default-content' ).length ){
                    if( jQuery( 'footer aside.mythemes-default-content' ).hasClass( 'hidden' ) ){
                        jQuery( 'footer aside.mythemes-default-content' ).removeClass( 'hidden' );
                    }
                }
            }
            else{
                if( !jQuery( 'div.mythemes-default-content' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.mythemes-default-content' ).addClass( 'hidden' );
                }

                /* HEADER WIDGETS */
                if( !jQuery( 'div.content aside.mythemes-default-content > div' ).find( 'div.mythemes-default-content' ).length ){
                    if( jQuery( 'div.content aside.mythemes-default-content' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.content aside.mythemes-default-content' ).removeClass( 'hidden' );
                    }
                }

                else if( jQuery( 'div.content aside.mythemes-default-content > div' ).find( 'div.mythemes-default-content' ).length == 3 ){
                    if( !jQuery( 'div.content aside.mythemes-default-content' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.content aside.mythemes-default-content' ).addClass( 'hidden' );
                    }
                }

                /* FOOTER WIDGETS */
                if( !jQuery( 'footer aside.mythemes-default-content div.container div.row > div' ).find( 'div.mythemes-default-content' ).length ){
                    if( jQuery( 'div.content aside.mythemes-default-content' ).hasClass( 'hidden' ) ){
                        jQuery( 'div.content aside.mythemes-default-content' ).removeClass( 'hidden' );
                    }
                }

                else if( jQuery( 'footer aside.mythemes-default-content div.container div.row > div' ).find( 'div.mythemes-default-content' ).length == 3 ){
                    if( !jQuery( 'footer aside.mythemes-default-content' ).hasClass( 'hidden' ) ){
                        jQuery( 'footer aside.mythemes-default-content' ).addClass( 'hidden' );
                    }
                }
            }
        });
    });

    wp.customize( 'mythemes-top-meta' , function( value ){
        value.bind(function( newval ){

        	if( newval ){
        		jQuery( 'div.mythemes-top-meta' ).show();
        	}
        	else{
        		jQuery( 'div.mythemes-top-meta' ).hide();	
        	}
        });
    });

    wp.customize( 'mythemes-bottom-meta' , function( value ){
        value.bind(function( newval ){

        	if( newval ){
        		jQuery( 'div.post-meta-terms' ).show();
        	}
        	else{
        		jQuery( 'div.post-meta-terms' ).hide();	
        	}
        });
    });

    wp.customize( 'mythemes-html-suggestions' , function( value ){
        value.bind(function( newval ){

        	if( newval ){
        		jQuery( 'div.mythemes-html-suggestions' ).show();
        	}
        	else{
        		jQuery( 'div.mythemes-html-suggestions' ).hide();	
        	}
        });
    });

    /* LAYOUT */
    wp.customize( 'mythemes-layout' , function( value ){
        value.bind(function( newval ){

            if( jQuery( 'div.content > div.container > div.row > section' ).hasClass( 'mythemes-classic' ) ){

                var sidebar = wp.customize.instance( 'mythemes-sidebar' ).get().toString();

                if( newval == 'left' || newval == 'right' ){
                    mythemes_load_sidebar( sidebar, newval );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12 mythemes-classic' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }

        });
    });

    /* SIDEBAR */
    wp.customize( 'mythemes-sidebar' , function( value ){
        value.bind(function( newval ){

            if( jQuery( 'div.content > div.container > div.row > section' ).hasClass( 'mythemes-classic' ) ){

                var layout = wp.customize.instance( 'mythemes-layout' ).get().toString();

                if( layout == 'left' || layout == 'right' ){
                    mythemes_load_sidebar( newval, layout );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* FRONT PAGE LAYOUT */
    wp.customize( 'mythemes-front-page-layout' , function( value ){
        value.bind(function( newval ){

            var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();
            
            if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                return;
            }

            if( jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                var sidebar = wp.customize.instance( 'mythemes-front-page-sidebar' ).get().toString();

                console.log( sidebar );

                if( newval == 'left' || newval == 'right' ){
                    mythemes_load_sidebar( sidebar, newval );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12 mythemes-classic' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* FRONT PAGE SIDEBAR */
    wp.customize( 'mythemes-front-page-sidebar' , function( value ){
        value.bind(function( newval ){

            var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();
            
            if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                return;
            }

            if( jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                var layout = wp.customize.instance( 'mythemes-front-page-layout' ).get().toString();

                if( layout == 'left' || layout == 'right' ){
                    mythemes_load_sidebar( newval, layout );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* PAGE LAYOUT */
    wp.customize( 'mythemes-page-layout' , function( value ){
        value.bind(function( newval ){

            var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

            if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                return;
            }

            if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                var sidebar = wp.customize.instance( 'mythemes-page-sidebar' ).get().toString();

                if( newval == 'left' || newval == 'right' ){
                    mythemes_load_sidebar( sidebar, newval );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12 mythemes-classic' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* PAGE SIDEBAR */
    wp.customize( 'mythemes-page-sidebar' , function( value ){
        value.bind(function( newval ){

            var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

            if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                return;
            }

            if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                var layout = wp.customize.instance( 'mythemes-page-layout' ).get().toString();

                if( layout == 'left' || layout == 'right' ){
                    mythemes_load_sidebar( newval, layout );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* POST LAYOUT */
    wp.customize( 'mythemes-post-layout' , function( value ){
        value.bind(function( newval ){

            if( jQuery( 'body' ).hasClass( 'single' ) ){

                var sidebar = wp.customize.instance( 'mythemes-post-sidebar' ).get().toString();

                if( newval == 'left' || newval == 'right' ){
                    mythemes_load_sidebar( sidebar, newval );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12 mythemes-classic' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* POST SIDEBAR */
    wp.customize( 'mythemes-post-sidebar' , function( value ){
        value.bind(function( newval ){

            if( jQuery( 'body' ).hasClass( 'single' ) ){

                var layout = wp.customize.instance( 'mythemes-post-layout' ).get().toString();

                if( layout == 'left' || layout == 'right' ){
                    mythemes_load_sidebar( newval, layout );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* SPECIAL PAGE */
    wp.customize( 'mythemes-special-page' , function( value ){
        value.bind(function( newval ){

            var id = newval;

            if( id == '0' ){
                return;
            }

            if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) && jQuery( 'body' ).hasClass( 'page-id-' + id ) ){

                var sidebar = wp.customize.instance( 'mythemes-special-page-sidebar' ).get().toString();
                var layout  = wp.customize.instance( 'mythemes-special-page-layout' ).get().toString();

                if( layout == 'left' || layout == 'right' ){
                    mythemes_load_sidebar( sidebar, layout );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12 mythemes-classic' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* SPECIAL PAGE LAYOUT */
    wp.customize( 'mythemes-special-page-layout' , function( value ){
        value.bind(function( newval ){

            var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

            if( id == '0' ){
                return;
            }

            if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) && jQuery( 'body' ).hasClass( 'page-id-' + id ) ){

                var sidebar = wp.customize.instance( 'mythemes-special-page-sidebar' ).get().toString();

                if( newval == 'left' || newval == 'right' ){
                    mythemes_load_sidebar( sidebar, newval );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12 mythemes-classic' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });

    /* SPECIAL PAGE SIDEBAR */
    wp.customize( 'mythemes-special-page-sidebar' , function( value ){
        value.bind(function( newval ){

            var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

            if( id == '0' ){
                return;
            }

            if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) && jQuery( 'body' ).hasClass( 'page-id-' + id ) ){

                var layout = wp.customize.instance( 'mythemes-special-page-layout' ).get().toString();

                if( layout == 'left' || layout == 'right' ){
                    mythemes_load_sidebar( newval, layout );
                }
                else{
                    jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hidden' );
                    jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                    jQuery( 'div.content > div.container > div.row section' ).addClass( 'col-lg-12' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'right' );
                    jQuery( 'div.content > div.container > div.row section div.content-border' ).removeClass( 'left' );
                }
            }
        });
    });
    

    /* SOCIAL */
    wp.customize( 'mythemes-vimeo' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-vimeo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-vimeo' ).removeClass( 'hidden' );	
        		}
        		
        		jQuery( 'div.mythemes-social a.icon-vimeo' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-vimeo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-vimeo' ).addClass( 'hidden' );	
        		}
        	}
        });
    });

    wp.customize( 'mythemes-twitter' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-twitter' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-twitter' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-twitter' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-twitter' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-twitter' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-skype' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-skype' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-skype' ).removeClass( 'hidden' );	
        		}
        		
        		jQuery( 'div.mythemes-social a.icon-skype' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-skype' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-skype' ).addClass( 'hidden' );	
        		}
        	}
        });
    });

    wp.customize( 'mythemes-renren' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-renren' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-renren' ).removeClass( 'hidden' );
        		}
        		
        		jQuery( 'div.mythemes-social a.icon-renren' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-renren' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-renren' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-github' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-github' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-github' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-github' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-github' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-github' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-rdio' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-rdio' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-rdio' ).removeClass( 'hidden' );
        		}
        		
        		jQuery( 'div.mythemes-social a.icon-rdio' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-rdio' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-rdio' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-linkedin' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-linkedin' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-linkedin' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-linkedin' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-linkedin' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-linkedin' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-behance' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-behance' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-behance' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-behance' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-behance' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-behance' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-dropbox' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-dropbox' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-dropbox' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-dropbox' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-dropbox' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-dropbox' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-flickr' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-flickr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-flickr' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-flickr' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-flickr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-flickr' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-tumblr' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-tumblr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-tumblr' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-tumblr' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-tumblr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-tumblr' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-instagram' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-instagram' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-instagram' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-instagram' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-instagram' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-instagram' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-vkontakte' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-vkontakte' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-vkontakte' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-vkontakte' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-vkontakte' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-vkontakte' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-facebook' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-facebook' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-facebook' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-facebook' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-facebook' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-facebook' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-evernote' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-evernote' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-evernote' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-evernote' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-evernote' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-evernote' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-flattr' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-flattr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-flattr' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-flattr' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-flattr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-flattr' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-picasa' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-picasa' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-picasa' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-picasa' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-picasa' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-picasa' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-dribbble' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-dribbble' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-dribbble' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-dribbble' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-dribbble' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-dribbble' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-mixi' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-mixi' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-mixi' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-mixi' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-mixi' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-mixi' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-stumbleupon' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-stumbleupon' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-stumbleupon' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-stumbleupon' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-stumbleupon' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-stumbleupon' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-lastfm' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-lastfm' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-lastfm' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-lastfm' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-lastfm' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-lastfm' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-gplus' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-gplus' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-gplus' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-gplus' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-gplus' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-gplus' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-google-circles' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-google-circles' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-google-circles' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-google-circles' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-google-circles' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-google-circles' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-pinterest' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-pinterest' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-pinterest' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-pinterest' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-pinterest' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-pinterest' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-smashing' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-smashing' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-smashing' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-smashing' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-smashing' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-smashing' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-soundcloud' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-soundcloud' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-soundcloud' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-soundcloud' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-soundcloud' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-soundcloud' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-rss' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.icon-rss' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-rss' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.icon-rss' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.icon-rss' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.icon-rss' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    /* OTHERS */
    wp.customize( 'mythemes-custom-css' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'style#mythemes-custom-css' ).html( newval );
        });
    });

    wp.customize( 'mythemes-copyright' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-copyright span.copyright' ).html( newval );
        });
    });

    wp.customize( 'mythemes-background_color' , function( value ){
        value.bind(function( newval ){

            var bg_color        = newval;
            var bg_color_rgba   = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.91 )';
            jQuery( 'style#mythemes-custom-style-background' ).html(

                /* BACKGROUND COLOR */
                'body > div.content,' +
                'body footer aside{' +
                'background-color: ' + bg_color + ';' +
                '}' +

                /* MENU NAVIGATION */
                /* BACKGROUND COLOR */
                'body.scroll-nav .mythemes-poor{' +
                'background-color: ' + bg_color_rgba + ';' +
                '}' +

                '.mythemes-poor{' +
                'background-color: ' + bg_color + ';' +
                '}'
            );
        });
    });

    /* BACKGROUND IMAGE */
    wp.customize( 'mythemes-background_image' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body > div.content, body footer aside' ).css( 'background-image' , 'url(' + newval + ')' );
        });
    });

    wp.customize( 'mythemes-background_repeat' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body > div.content, body footer aside' ).css( 'background-repeat' , newval );
        });
    });

    wp.customize( 'mythemes-background_position_x' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body > div.content, body footer aside' ).css( 'background-position' , newval );
        });
    });

    wp.customize( 'mythemes-background_attachment' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body > div.content, body footer aside' ).css( 'background-attachment' , newval );
        });
    });

})(jQuery);