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
<link href="<?php bloginfo( "template_url" ) ?>/css/main.css?v=48" rel="stylesheet" type="text/css">

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
<?php the_notice_bar(); ?>
<header>

	<?php if ( is_newsletter() ) { ?>
	<div class="logo left">
		<a href="/onthego" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo-newsletter.png" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<?php } else if ( is_solutions() ) { ?>
	<div class="logo left">
		<a href="/solutions" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( "template_url" ) ?>/img/logo-solutions-large.png" alt="<?php bloginfo( 'name' ); ?>"></a>
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
			<?php if ( is_foundation() ) { ?>
			<a href="/donate" class="btn fulvous">Donate</a>
			<a href="/friends-of-the-foundation/" class="btn navy">Become a Friend</a>
			<?php } else { ?>
			<?php account_button(); ?>
			<a href="https://members.gowest.org/s/login/SelfRegister" class="btn navy">First Time User</a>
			<!-- https://members.gowest.org/s/login/SelfRegister?startURL=%2Fs%2Fredirect-with-url-params%3Furl%3Dhttps%253A%252F%252Fbrvw5a2d.gowestassociation.org%252Fsolutions%252F -->
			<?php } ?>
		</div>

		<div class="contact">
			<?php if ( is_foundation() ) { ?>
			<a href="/connect-with-us" class="contact-link">Contact Us</a>
			<?php } else { ?>
			<a href="/about-gowest/contact-gowest/" class="contact-link">Contact Us</a>
			<?php } ?>
		</div>

	</div>
	
</header>

<nav class="main-menu-container">
	<button class="menu-toggle">Show/hide Menu</button>
	<?php 
	if ( is_solutions() ) {
		print do_shortcode( get_snippet( "header-menu-solutions", 0 ) ); 
		print '<div class="aux-buttons">';
		print '<a href="https://gowestassociation.org" class="association"><span>Association</span></a>';
		print '</div>';
	} else if ( is_foundation() ) {
		print do_shortcode( get_snippet( "header-menu", 0 ) ); 
		print '<div class="aux-buttons">';
		print '<a href="https://gowestassociation.org" class="association"><span>Association</span></a>';
		print '</div>';
	} else if ( is_newsletter() ) {
		print do_shortcode( get_snippet( "header-menu", 0 ) ); 
		print '<div class="aux-buttons">';
		print '<a href="https://gowestassociation.org" class="association"><span>Association</span></a>';
		print '</div>';
	} else {
		print do_shortcode( get_snippet( "header-menu", 0 ) ); 
		print '<div class="aux-buttons">';
		print '<a href="https://gowestassociation.org/solutions" class="solutions"><span>Solutions</span></a>';
		print '<a href="https://gowestfoundation.org" class="foundation"><span>Foundation</span></a>';
		print '</div>';
	}
	?>
</nav>

<?php } ?>
<section class="content">
	<a name="content"></a>
