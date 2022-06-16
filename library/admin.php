<?php


// add a 'theme options' top-level menu item
function theme_options_menu() {
    add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'pure', 'theme_options_page', 'dashicons-admin-tools', 3 );
}
add_action( 'admin_menu', 'theme_options_menu', 1 );



// register our theme options settings
function theme_options_register_settings() {

	// address option
    add_option( 'pure_address', '<strong>Pure Framework</strong><br>Email: <a href="mailto:james@jpederson.com">james@jpederson.com</a>' );
    register_setting( 'pure_options_group', 'pure_address' );

}
add_action( 'admin_init', 'theme_options_register_settings' );



// the page that on the main 'theme options' admin page.
function theme_options_page() {
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline">Theme Options</h1>
		<p>Manage the basic settings for the theme used on <?php bloginfo('name'); ?>.</p>
		<hr>
        <style>.pure-field { padding: 10px; min-width: 280px; width: 100%; }</style>
        <form method="post" action="options.php">
        <?php

        // settings field group
        settings_fields( 'pure_options_group' );

        ?>
        <p><label for="pure_address">Address</label><br>
            <textarea class="pure-field" id="pure_address" name="pure_address" style="height: 100px;"><?php echo get_option( 'pure_address' ); ?></textarea></p>
        <?php

        // add the submit button.
        submit_button();

        ?>
        </form>
	</div>
	<?php
}

