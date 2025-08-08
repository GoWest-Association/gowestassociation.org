<?php

if ( have_rows( 'single_components' ) ) : ?>
<div class="content-wide bg-gw">
    <?php
    while ( have_rows( 'single_components' ) ) : the_row();
        get_template_part( 'library/component/' . get_row_layout() );
    endwhile;
    ?>
</div>
    <?php 
endif;

