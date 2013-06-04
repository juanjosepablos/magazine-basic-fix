<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 * and the left sidebar conditional
 *
 * @since 3.0.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="grid<?php echo ' ' . mb_theme_options( 'width' ); ?>">
		<header id="header" class="row" role="banner">
			<div class="c12">
				<?php
				$logo = mb_theme_options( 'logo' );
				$text_color = get_header_textcolor();
				$alignment = mb_theme_options( 'header_alignment' );
				$header_class = ( $alignment ) ? $alignment : '';
				$header_class2 = ( ! $logo && 'blank' == $text_color ) ? 'remove' : $header_class;
				$class = ( $logo ) ? ' class="remove"' : '';

				if ( is_active_sidebar( 'header-area' ) ) { ?>
					<div id="header-widgets" class="<?php echo $header_class; ?>">
						<?php dynamic_sidebar( 'header-area' ); ?>
					</div>
					<?php
				}

				if ( $logo ) {
					?>
					<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" id="site-logo" class="<?php echo $header_class2; ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
				<?php } ?>
				<hgroup class="<?php echo $header_class2; ?>">
					<h1 id="site-title"<?php echo $class; ?>><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php if ( mb_theme_options( 'tagline' ) ) { ?><h2 id="site-description"><?php bloginfo( 'description' ); ?></h2><?php } ?>
				</hgroup>

				<?php
				$header_image = get_header_image();
				if ( $header_image ) {
					?>
					<img id="header-img" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
					<?php
				}
				?>

				<nav id="site-navigation" role="navigation">
					<h3 class="assistive-text"><?php _e( 'Main menu', 'magazine-basic' ); ?></h3>
					<?php echo str_replace( '</li>', '', wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => false ) ) ); ?>
				</nav><!-- #site-navigation -->

				<nav id="site-sub-navigation" role="navigation">
					<h3 class="assistive-text"><?php _e( 'Sub menu', 'magazine-basic' ); ?></h3>
					<?php echo str_replace( '</li>', '', wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'secondary-menu', 'echo' => false, 'fallback_cb' => false ) ) ); ?>
				</nav><!-- #site-sub-navigation -->

				<div id="drop-down-search">
					<?php get_search_form(); ?>
				</div>

				<nav id="mobile-menu">
					<a href="<?php echo home_url(); ?>" class="circle home"></a>
					<a href="#" class="circle menu" data-div="#site-navigation" data-speed="500"></a>
					<a href="#" class="circle search" data-div="#drop-down-search" data-speed="fast"></a>
				</nav>
			</div><!-- .c12 -->
		</header><!-- #header.row -->

		<div id="main" class="row">
			<?php
			/* Do not display sidebars if full width option selected on single
			   post/page templates */
			if ( 5 == mb_theme_options( 'layout' ) ) get_sidebar();