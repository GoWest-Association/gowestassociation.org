<?php

$icons_per_row = get_sub_field( 'icons_per_row' );

// default for posts where it's not set
if ( empty( $icons_per_row ) ) $icons_per_row = 'all';

// if it's an array
if ( have_rows( 'icons' ) ) :
    ?>
    <div class="icons <?php print $icons_per_row ?>">
    <?php
    while ( have_rows( 'icons' ) ) : the_row();

        $title = get_sub_field( 'title' );
        $title_alt = str_replace( '|', ' ', $title );
        $title = str_replace( '|', '<br>', $title );
        $link = get_sub_field( 'link' );
        $class = get_sub_field( 'class' );
        $image = get_sub_field( 'image' );
        $color = get_sub_field( 'core_color' );
        if ( empty( $color ) ) $color = 'blue';

        if ( !empty( $link ) && !empty( $image ) && !empty( $title ) ) : ?>
        <a href="<?php print $link; ?>" class="icon <?php print $color . ' ' . $class; ?>">
            <div class="icon-image"><img src="<?php print $image; ?>" alt="<?php print $title_alt; ?>"></div>
            <h3><?php print $title; ?></h3>
        </a>
        <?php endif; 
    endwhile;
    ?>
    </div>
    <?php
endif;
