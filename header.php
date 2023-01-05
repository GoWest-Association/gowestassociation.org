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
<link href="<?php bloginfo( "template_url" ) ?>/css/main.css?v=33" rel="stylesheet" type="text/css">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J4GTY9QELN"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-J4GTY9QELN');
</script>

</head>
<body <?php body_class(); ?>>
<div class="container <?php print ( isset( $_REQUEST['notemplate'] ) ? 'notemplate' : '' ); ?>">
<?php if ( !isset( $_REQUEST['notemplate'] ) ) { ?>
<header<?php print ( is_newsletter() ? ' class="newsletter"' : '' ); ?>>

	<?php if ( is_newsletter() ) { ?>
	<div class="logo left">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<div class="logo right">
		<a href="/onthego" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo-onthego.png?v=1" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<?php } else if ( is_solutions() ) { ?>
	<div class="logo left">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo-solutions-large.png" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<?php } else if ( is_foundation() ) { ?>
	<div class="logo left">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo-foundation-large.png" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<?php } else { ?>
	<div class="logo left">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<?php } ?>

	<div class="account-tools">

		<div class="search">
			<form role="search" method="get" id="searchform" class="searchform" action="/" _lpchecked="1">
				<label for="s">Search our site:</label>
				<input type="text" value="" name="s" id="s" placeholder="Search" title="Search our site.">
				<input type="submit" id="searchsubmit" value="Search">
			</form>
		</div>

		<div class="account-buttons">
			<a href="/account/login" class="btn green">Member Login</a>
			<a href="/account/new" class="btn navy">First Time User</a>
		</div>

		<div class="contact">
			<a href="/contact" class="contact-link">Contact Us</a>
		</div>

	</div>
	
</header>

<nav class="main-menu-container">
	<button class="menu-toggle">Show/hide Menu</button>
	<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu' ) ); ?>
</nav>

<?php } ?>
<section class="content">
	<a name="content"></a>
