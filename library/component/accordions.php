<?php


if ( have_rows( 'accordions' ) ) :
    $uniqid = uniqid();

    ?>
    <div class="accordions">
    <?php
    while( have_rows( 'accordions' ) ) : the_row();

        // store the title and subtitle
        $title = get_sub_field( 'title' );
        $content = get_sub_field( 'content' );
        $color = get_sub_field( 'color' );
        $open = get_sub_field( 'open' );
        $key = $uniqid . '-' . get_row_index();

        if ( !empty( $title ) ) :

            ?>
    <a name="accordion-<?php print $key; ?>"></a>
    <div class="accordion<?php print ( $open ? " open" : "" ); ?> <?php print $color ?>">
        <div class="accordion-handle"><h3><?php print $title ?></h3></div>
        <div class="accordion-content">
            <?php print $content; ?>
        </div>
    </div>
            <?php
        endif;
    endwhile;
    ?>
    </div>
    <?php
endif;
