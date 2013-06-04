( function( $ ) {
	// Responsive videos
    var all_videos = $( '.entry-content' ).find( 'iframe[src^="http://player.vimeo.com"], iframe[src^="http://www.youtube.com"], object, embed' ),
    	input = document.createElement( 'input' ),
    	i;

	all_videos.each(function() {
		var el = $(this);
		el
			.attr( 'data-aspectRatio', el.height() / el.width() )
			.attr( 'data-oldWidth', el.attr( 'width' ) );
	} );

	$(window)
		.resize( function() {
			all_videos.each( function() {
				var el = $(this),
					newWidth = el.parents( '.entry-content' ).width(),
					oldWidth = el.attr( 'data-oldWidth' );

				if ( oldWidth > newWidth ) {
					el
						.removeAttr( 'height' )
						.removeAttr( 'width' )
					    .width( newWidth )
				    	.height( newWidth * el.attr( 'data-aspectRatio' ) );
				}
			} );

			if ( $( window ).width() > 600 ) {
				$( '#site-navigation' ).show();
				$( '#drop-down-search' ).hide();
				$( '#site-navigation' ).find( 'ul.secondary-menu').appendTo( '#site-sub-navigation .menu-main-container' );
			} else {
				$( '#site-sub-navigation' ).find( 'ul.secondary-menu').appendTo( '#site-navigation .menu-main-container' );
			}
		} )
		.resize()

	// Placeholder fix for older browsers
    if ( ( 'placeholder' in input ) == false ) {
		$( '[placeholder]' ).focus( function() {
			i = $( this );
			if ( i.val() == i.attr( 'placeholder' ) ) {
				i.val( '' ).removeClass( 'placeholder' );
				if ( i.hasClass( 'password' ) ) {
					i.removeClass( 'password' );
					this.type = 'password';
				}
			}
		} ).blur( function() {
			i = $( this );
			if ( i.val() == '' || i.val() == i.attr( 'placeholder' ) ) {
				if ( this.type == 'password' ) {
					i.addClass( 'password' );
					this.type = 'text';
				}
				i.addClass( 'placeholder' ).val( i.attr( 'placeholder' ) );
			}
		} ).blur().parents( 'form' ).submit( function() {
			$( this ).find( '[placeholder]' ).each( function() {
				i = $( this );
				if ( i.val() == i.attr( 'placeholder' ) )
					i.val( '' );
			} )
		} );
	}

	// Lightbox effect for gallery
	$( '#primary' ).find( '.lightbox.gallery-item img' ).click( function() {
		$( '#lightbox' ).remove();

		var el = $( this ),
			full = el.data( 'full-image' ),
			caption = el.data( 'caption' ),
			next = el.data( 'next-image' ),
			prev = el.data( 'prev-image' ),
			count = $( '.gallery-item img' ).length,
			prev_text = ( 'img-0' != prev ) ? '<span class="prev-image" data-prev-image="' + prev + '">&larr;</span>' : '';
			next_text = ( 'img-' + ( count + 1 ) != next ) ? '<span class="next-image" data-next-image="' + next + '">&rarr;</span>' : '';

		$( '#page' ).append( '<div id="lightbox">' + prev_text + next_text + '<div class="lightbox-container"><img src="' + full + '" /><p>' + caption + '</p></div></div>' );
	} );

	$( '#page' )
		.on( 'click', '#lightbox', function() {
			$( this ).fadeOut();
		} )
		.on( 'click', '#lightbox .prev-image', function(e) {
			e.stopPropagation();
			var prev = $( this ).data( 'prev-image' );

			$( '.' + prev ).trigger( 'click' );
		} )
		.on( 'click', '#lightbox .next-image', function(e) {
			e.stopPropagation();
			var next = $( this ).data( 'next-image' );

			$( '.' + next ).trigger( 'click' );
		} )
		.on( 'click', '#lightbox img', function(e) {
			e.stopPropagation();
			$( '#lightbox .next-image' ).trigger( 'click' );
		} );

	// Mobile menu
	$( '#header' ).on( 'click', '#mobile-menu a', function(e) {
		var el = $( this ),
			div = $(this).data("div"),
			speed = $(this).data("speed");

		if ( el.hasClass( 'home' ) )
			return true;

		e.preventDefault();
		$(div).slideToggle(speed);
	} );
} )( jQuery );