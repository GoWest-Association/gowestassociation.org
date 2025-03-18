<?php

$title = get_sub_field( 'title' );
$more_link = get_sub_field( 'more-link' );
$categories = get_sub_field( 'categories' );

$cat_array = array();
foreach ( $categories as $cat ) {
    $cat_array[] = $cat->slug;
}
$cats = implode( ',', $cat_array );


if ( !empty( $categories ) ) :
    ?>
    <div class="page-events">
        <h3 class="page-events-title"><?php print $title ?></h3>
        <a href="<?php print $more_link ?>" class="all-events">More Events</a>
        <?php print do_shortcode( '[events limit=4 category="' . $cats . '" /]' ); ?>
    </div>
    <?php
endif;
