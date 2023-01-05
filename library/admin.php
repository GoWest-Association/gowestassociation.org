<?php


// add a 'theme options' top-level menu item
function theme_options_menu() {
    add_menu_page( 'Site Options', 'Site Options', 'manage_options', 'pure', 'theme_options_page', 'dashicons-admin-tools', 3 );
}
add_action( 'admin_menu', 'theme_options_menu', 1 );



// register our theme options settings
function theme_options_register_settings() {

	// address option
    add_option( 'pure_address', '<strong>Pure Framework</strong><br>Email: <a href="mailto:james@jpederson.com">james@jpederson.com</a>' );
    register_setting( 'pure_options_group', 'pure_address' );

    add_option( 'gw_posts_top', '6' );
    add_option( 'gw_posts_member', '3' );
    add_option( 'gw_posts_compliance', '3' );
    register_setting( 'gwcua_options_group', 'gw_posts_top' );
    register_setting( 'gwcua_options_group', 'gw_posts_member' );
    register_setting( 'gwcua_options_group', 'gw_posts_compliance' );

}
add_action( 'admin_init', 'theme_options_register_settings' );



// the page that on the main 'theme options' admin page.
function theme_options_page() {
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline">Site Options</h1>
		<p>Manage the basic settings for the theme used on <?php bloginfo('name'); ?>.</p>
		<hr>
        <style>.pure-field { padding: 10px; min-width: 280px; width: 100%; }</style>
        <form method="post" action="options.php">
        <?php

        // settings field group
        settings_fields( 'pure_options_group' );

        ?>
        <h3>Address</h3>
        <p><label for="pure_address">Enter the address to show in the footer of the site.</label></p>
        <p><textarea class="pure-field" id="pure_address" name="pure_address" style="height: 100px;"><?php echo get_option( 'pure_address' ); ?></textarea></p>
        <hr>
        <h3>On The Go Newsletter</h3>
        <p>Select the number of posts to display in each of the sections of the On The Go newsletter home page.</p>
        <?php

        // gwcua group
        settings_fields( 'gwcua_options_group' );

        ?>
        <p><label for="gw_posts_top">Top Headlines</label><br>
            <input type="text" class="gw-field" id="gw_posts_top" name="gw_posts_top" value="<?php echo get_option( 'gw_posts_top' ); ?>" /></p>
        <p><label for="gw_posts_member">Member Posts</label><br>
            <input type="text" class="gw-field" id="gw_posts_member" name="gw_posts_member" value="<?php echo get_option( 'gw_posts_member' ); ?>" /></p>
        <p><label for="gw_posts_compliance">Compliance Posts</label><br>
            <input type="text" class="gw-field" id="gw_posts_compliance" name="gw_posts_compliance" value="<?php echo get_option( 'gw_posts_compliance' ); ?>" /></p>
        <?php

        // add the submit button.
        submit_button();

        ?>
        </form>
	</div>
	<?php
}

