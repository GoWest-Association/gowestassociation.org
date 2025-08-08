<?php

$alignment = get_sub_field( 'alignment' );

if ( have_rows( 'buttons' ) ) :
    ?><div class="cta-buttons <?php print $alignment; ?>"><?php while ( have_rows( 'buttons' ) ) : the_row(); ?><a href="<?php print get_sub_field( 'link' ); ?>" class="btn <?php print get_sub_field( 'color' ); ?>"<?php print ( get_sub_field( 'new-tab' ) ? ' target="_blank"' : '' ) ?>><?php print get_sub_field( 'label' ); ?></a><?php endwhile; ?></div><?php
endif;

