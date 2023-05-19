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
<link href="<?php bloginfo( "template_url" ) ?>/css/main.css?v=75" rel="stylesheet" type="text/css">


<?php if ( is_foundation() ) { ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3DSHTX2Q9Y"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-3DSHTX2Q9Y');
</script>
<?php } else { ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J4GTY9QELN"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-J4GTY9QELN');
</script>
<?php } ?>

</head>
<body <?php body_class(); ?>>
<div class="container <?php print ( isset( $_REQUEST['notemplate'] ) ? 'notemplate' : '' ); ?>">
<header class="microsite">
	<img src="<?php show_cmb_value('microsite-logo') ?>" alt="<?php the_title(); ?>">
</header>

<section class="content">
	<a name="content"></a>
