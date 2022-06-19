<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'sitename' ) ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
<link href="<?php bloginfo( "template_url" ) ?>/css/main.css" rel="stylesheet" type="text/css">

</head>
<body <?php body_class(); ?>>
<div class="container">
<?php if ( !isset( $_REQUEST['notemplate'] ) ) { ?>
<header>

	<div class="wrap">
	
		<div class="logo">
			<?php if ( is_newsletter() ) { ?>
			<a href="/on-the-go" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo-onthego.png" alt="<?php bloginfo( 'name' ); ?>"></a>
			<?php } else { ?>
			<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
			<?php } ?>
		</div>

		<?php if ( is_page_template( 'page-front.php' ) ) { ?>
		<div class="lockup">
			<div class="logo">
				<img src="<?php bloginfo( "template_url" ) ?>/img/logo-solutions.png" alt="GoWest Solutions" />
			</div>
			<div class="logo">
				<img src="<?php bloginfo( "template_url" ) ?>/img/logo-foundation.png" alt="GoWest Foundation" />
			</div>
		</div>
		<?php } ?>

	</div>

	<nav>
		<button class="menu-toggle">Show/hide Menu</button>
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu' ) ); ?>
	</nav>
	
</header>
<?php } ?>
<section class="content">
	<a name="content"></a>
