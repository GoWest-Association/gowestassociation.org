<?php

$style = get_sub_field( 'style' );

if ( have_rows( 'single_components' ) ) : ?>
<div class="content-wide <?php print ( !empty( $style ) ? $style : 'bg-gw' ) ?>">
    <?php
    while ( have_rows( 'single_components' ) ) : the_row();
        get_template_part( 'library/component/' . get_row_layout() );
    endwhile;
    ?>
</div>
    <?php 
endif;

