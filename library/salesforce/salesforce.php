<?php


// our function will be executed by wpcron
function salesforce_header_generate() {

    $path_to_script = realpath(dirname(__FILE__));
    $path_to_uploads = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/';

    // get current host so this works in all environments.
    $current_host = 'https://' . $_SERVER['HTTP_HOST'] . '/';

    // get the current version of that host
    $file = file_get_contents( $current_host . '?fakeloggedin' );

    // get the templates we're working with for this.
    $header_template = file_get_contents( $path_to_script . '/template/header.txt' );
    $footer_template = file_get_contents( $path_to_script . '/template/footer.txt' );

    // header start and stop marker strings
    $header_search_start = '<!--- header --->';
    $header_search_stop = '<!--- /header --->';
    $footer_search_start = '<!--- footer --->';
    $footer_search_stop = '<!--- /footer --->';

    // positions of strings in file
    $header_start_pos = strpos( $file, $header_search_start );
    $header_stop_pos = strpos( $file, $header_search_stop );
    $footer_start_pos = strpos( $file, $footer_search_start );
    $footer_stop_pos = strpos( $file, $footer_search_stop );

    // isolate the code between the tags, to get the header and footer
    $header = substr( $file, ( $header_start_pos + strlen( $header_search_start ) ), $header_stop_pos - $header_start_pos - strlen( $header_search_stop ) );
    $footer = substr( $file, ( $footer_start_pos + strlen( $footer_search_start ) ), $footer_stop_pos - $footer_start_pos - strlen( $footer_search_stop ) );

    // replace link hrefs for relative links with full URLs
    $header = str_replace( 'href="/', 'href="' . $current_host, $header );
    $footer = str_replace( 'href="/', 'href="' . $current_host, $footer );

    // replace the [header] and [footer] placeholders with our processed stuff
    $header_final = str_replace( '[header]', $header, $header_template );
    $footer_final = str_replace( '[footer]', $footer, $footer_template );

    // output the final header and footer to their respective files in the uploads folder.
    file_put_contents( $path_to_uploads . 'salesforce/header.php', $header_final );
    file_put_contents( $path_to_uploads . 'salesforce/footer.php', $footer_final );
}


// register the cronjob
add_action( 'salesforce_header_generate', 'salesforce_header_generate' );
if ( ! wp_next_scheduled( 'salesforce_header_generate' ) ) {
    wp_schedule_event( time(), 'hourly', 'salesforce_header_generate' );
}


if ( isset( $_REQUEST['sfgen_manual'] ) ) {
    salesforce_header_generate();
}
