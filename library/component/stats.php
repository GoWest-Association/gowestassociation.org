<?php

if ( have_rows( 'point' ) ) :
    ?>
<div class="stats-container new">
    <?php 
    while ( have_rows( 'point' ) ) : the_row();
        ?>
    <div class="stat <?php the_sub_field( 'color' ); ?>">
        <div class="stat-number"><span><?php the_sub_field( 'data_point' ); ?></span></div>
        <div class="stat-description"><?php the_sub_field( 'description' ); ?></div>
    </div><?php
    endwhile;
    ?>
</div>
    <?php
endif;

