<?php
global $mb_content_area;
$format = ( function_exists( 'has_post_format' ) ) ? get_post_format() : '';
$class = mb_article_class();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>

	    <?php get_template_part( 'content', 'header' ); ?>

	    <div class="entry-content">
	    <?php
	    if ( ( is_singular() || 'content' == mb_theme_options( 'excerpt_content' ) ) && 'main' == $mb_content_area && ! is_archive() && ! is_search() ) {
		    the_content( 'Read more &rarr;' );
	    } else {
	    	$image_name = 'thumbnail';
    		$image_name = ( 'three-col c4' == $class && is_home() ) ? '3_column' : '1_column';
    		$image_name = ( 'two-col c6' == $class && is_home() ) ? '2_column' : $image_name;

			$size = ( 'image' == $format ) ? 'full' : $image_name;
			$class = ( 'image' == $format ) ? '' : 'alignleft';
			if( has_post_thumbnail() ) {
				the_post_thumbnail( $size, array( 'class' => $class ) );
			}
			the_excerpt();
	    }
		?>
	    </div><!-- .entry-content -->

	    <?php get_template_part( 'content', 'footer' ); ?>

	</article><!-- #post-<?php the_ID(); ?> -->