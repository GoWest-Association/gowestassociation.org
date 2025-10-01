<header>

	<div class="logo left">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php the_sub_field( 'logo' ) ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>

	<div class="account-tools">

		<div class="account-buttons">
			<?php if ( is_foundation() ) { ?>
			<a href="/donate" class="btn fulvous">Donate</a>
			<a href="/friends-of-the-foundation/" class="btn navy">Become a Friend</a>
			<?php } else { 
				account_buttons();
			} ?>
		</div>

		<div class="contact">
			<?php if ( is_foundation() ) { ?>
			<a href="/connect" class="contact-link">Contact Us</a>
			<?php } else { ?>
			<a href="/about-gowest/contact-gowest/" class="contact-link">Contact Us</a>
			<?php } ?>
		</div>

	</div>
	
</header>

<nav class="main-menu-container">
	<button class="menu-toggle">Show/hide Menu</button>
	<?php 
    wp_nav_menu( array(
        'menu' => get_sub_field( 'nav-menu' ), // Replace 'your-menu-slug' with the actual slug of your menu
        'container' => 'nav', // Optional: specify the HTML tag for the menu container (e.g., 'div', 'nav')
        'container_class' => 'main-menu-container', // Optional: add a CSS class to the container
        'menu_class' => 'menu', // Optional: add a CSS class to the ul element
    ) );
    print '<div class="aux-buttons">';
    if ( have_rows( 'buttons' ) ) :
        while ( have_rows( 'buttons' ) ) : the_row( 'buttons' );
            $link = get_sub_field( 'link' );
            $color = get_sub_field( 'color' );
            print '<a href="' . $link['url'] . '" class="' . $color . '"><span>' . $link['title'] . '</span></a>';
        endwhile;
    endif;
    print '</div>';
	?>
</nav>
