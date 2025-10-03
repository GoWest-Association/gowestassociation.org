<?php




// if it's an array
if ( have_rows( 'box' ) ) :
    ?>
<div class="image-boxes-container">
    <div class="image-boxes">
    <?php
    // if it's an array, we'll assume it's got content
    while ( have_rows( 'box' ) ) : the_row( 'box');
        $image = get_sub_field( 'image' );
        $title = get_sub_field( 'title' );
        $link = get_sub_field( 'link' );
        $color = get_sub_field( 'color' );
        $class = get_sub_field( 'class' );
        if ( !empty( $link ) && !empty( $image ) && !empty( $title ) ) { 
            $title = str_replace( '|', '<br>', $title );
            ?>
    <a href="<?php print $link; ?>" 
        class="image-box <?php print $color ?> <?php print $class ?>" 
        style="background-image: url(<?php print $image; ?>);">
        <span><?php print $title; ?></span>
    </a>
            <?php
        } 

    endwhile;
    ?>
    </div>
</div>
    <?php
endif
?>