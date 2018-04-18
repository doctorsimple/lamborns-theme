/* PARALLAX */

;(function($){



    $.fn.parallax = function () {

        var window_width = $(window).width();

        // Parallax Scripts

        return this.each(function(i) {

            var $this = $(this);

            $this.addClass('parallax');



            function updateParallax(initial) {

                var container_height;

                if (window_width < 601) {

                    container_height = ($this.height() > 0) ? $this.height() : $this.children("img").height();

                }

                else {

                    container_height = ($this.height() > 0) ? $this.height() : 500;

                }



                var $img = $this.children("img").first();

                var img_height = $img.height();

                var parallax_dist = img_height - container_height;

                var bottom = $this.offset().top + container_height;

                var top = $this.offset().top;

                var scrollTop = $(window).scrollTop();

                var windowHeight = window.innerHeight;

                var windowBottom = scrollTop + windowHeight;

                var percentScrolled = (windowBottom - top) / (container_height + windowHeight);

                var parallax = Math.round((parallax_dist * percentScrolled));



                if (initial) {

                    $img.css('display', 'block');

                }



                if ((bottom > scrollTop) && (top < (scrollTop + windowHeight))) {

                    $img.css('transform', "translate3D(-50%," + parallax + "px, 0)");

                }

            }



            //- Wait for image load -//

            $this.children("img").one("load", function() {

                updateParallax(true);

            }).each(function() {

                if(this.complete) $(this).load();

            });



            $(window).scroll(function() {

                window_width = $(window).width();

                updateParallax(false);

            });



            $(window).resize(function() {

                window_width = $(window).width();

                updateParallax(false);

            });

        });

    };

}(jQuery));



(function($){

    $(function(){

        $('.parallax').parallax();

    });

})(jQuery);





/* PRELOADER */

var mythemes_masonry = {

    _class : function(){

        this.init = function( el, callback ){

            var total = jQuery( el ).find( 'img' ).length;



            jQuery( el ).find( 'img' ).each(function(){

                var image = new Image();



                image.onload = function(){

                    total--;



                    if( total == 0 ){

                        callback();

                    }

                }



                image.src = jQuery( this ).attr( 'src' );

            });

        }

    }

};



var _mythemes_masonry = new mythemes_masonry._class();



jQuery(document).ready(function(){    



    /* ADD MENU ARROWS */

    jQuery('nav.base-nav ul.mythemes-menu li.menu-item-has-children').prepend('<span class="menu-plus"></span>');



    jQuery( 'nav.base-nav ul li span.menu-plus' ).on( "click" , function(){

        if( jQuery( this ).hasClass( 'collapsed' ) ){

            jQuery( this ).parent().children('ul').hide( "slow" , function(){

                jQuery( this ).removeAttr( 'style' );

            });

            jQuery( this ).removeClass( 'collapsed' );

        }

        else{

            jQuery( this ).addClass( 'collapsed' );

            jQuery( this ).parent().children('ul').show( "slow" );

        }

    });



    /* ADD PLUS AND MINUS FOR MENU ITEMS WITH SUB MENU */

    jQuery( '.btn-collapse' ).click(function(){

        

        if( jQuery( this ).hasClass( 'collapsed' ) ){

            jQuery( this ).removeClass( 'collapsed' );

            jQuery( '.nav-collapse.in' ).each(function(){

                jQuery( this ).hide( 'slow' , function(){

                    jQuery( this ).removeClass( 'in' );

                    jQuery( this ).removeAttr( 'style' );

                });

            });

        }

        else{

            jQuery( '.btn-collapse' ).removeClass( 'collapsed' );

            jQuery( this ).addClass( 'collapsed' );



            var nav = jQuery( this ).attr( 'data-toggle' );



            jQuery( '.nav-collapse.in' ).each(function(){

                jQuery( this ).hide( 'slow' , function(){

                    jQuery( this ).removeClass( 'in' );

                    jQuery( this ).removeAttr( 'style' );

                });

            });



            jQuery( nav ).show( 'slow' , function(){

                jQuery( this ).addClass( 'in' );

                jQuery( this ).removeAttr( 'style' );

            });

        }

    });



    /* GALLERY WITH MASONRY */

    _mythemes_masonry.init( '.mythemes-gallery', function(){

        jQuery( '.mythemes-gallery' ).masonry();

    });



    /* CHANGE BORDER BOTTOM ON WINDOW RESIZE */

    jQuery( window ).resize(function() {



        jQuery( 'nav.base-nav ul span.menu-plus' ).removeClass( 'collapsed' );

        jQuery( 'nav.base-nav ul li ul' ).removeAttr( 'style' );



        if( jQuery( '.mythemes-gallery' ).length ){

            jQuery( '.mythemes-gallery' ).masonry();    

        }

        

    });



    /* TAGS WITH COUNTER */

    jQuery( 'div.widget_tag_cloud div.tagcloud' ).append( '<div class="clear clearfix"></div>' );



    jQuery( 'div.widget_tag_cloud div.tagcloud a, div.widget_post_tags div.tagcloud a' ).each(function(){



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

	
	jQuery('table').hide().show(700);
});

jQuery(window).scroll( function() {
	
  var $menu = jQuery('header .container');
  
  var stickyOffset = jQuery('.mythemes-poor').offset().top;
  
  if (jQuery(window).scrollTop() >= stickyOffset) {
	  
    $menu.css({ 'position': 'fixed', 'top': '0', 'left':'0', 'width' : '100%', 'z-index':'10000', 'background-color' : 'transparent' })
	
    }
			  
  else { 
  
    $menu.css({ 'position' : 'relative' });
	
  }
  
});