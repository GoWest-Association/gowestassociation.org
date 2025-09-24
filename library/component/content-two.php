<?php  

$style = get_sub_field( 'style' );
$align = get_sub_field( 'align' );

?>
<div class="content-wide <?php print ( !empty( $style ) ? $style : 'bg-gw' ) ?>">
    <div class="columns <?php print $align ?>">
        <?php if ( have_rows( 'left_components' ) ) { ?>
        <div class="column left">
            <?php while ( have_rows( 'left_components' ) ) : the_row();
                // include the specific layout
                get_template_part( 'library/component/' . get_row_layout() );
            endwhile; ?>
        </div>
        <?php } ?>
        <?php if ( have_rows( 'right_components' ) ) { ?>
        <div class="column right">
            <?php while ( have_rows( 'right_components' ) ) : the_row();
                // include the specific layout
                get_template_part( 'library/component/' . get_row_layout() );
            endwhile; ?>
        </div>
        <?php } ?>
    </div>
</div>
