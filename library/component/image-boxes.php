<?php




// if it's an array
if ( have_rows( 'box' ) ) :
    ?>
    <div class="image-boxes">
    <?php
    // if it's an array, we'll assume it's got content
    while ( have_rows( 'box' ) ) : the_row( 'box');
        $image = get_sub_field( 'image' );
        $title = get_sub_field( 'title' );
        $link = get_sub_field( 'link' );
        $color = get_sub_field( 'color' );
        if ( !empty( $link ) && !empty( $image ) && !empty( $title ) ) { 
            $title = str_replace( '|', '<br>', $title );
            ?>
    <div data-href="<?php print $link; ?>" class="image-box <?php print $color ?>" style="background-image: url(<?php print $image; ?>);">
        <a href="<?php print $link; ?>"><?php print $title; ?></a>
    </div>
            <?php
        } 

    endwhile;
    ?>
    </div>
    <?php
endif
?>