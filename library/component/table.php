<?php

$title = get_sub_field( 'title' );
$widths = get_sub_field( 'widths' );
$columns = get_sub_field( 'columns' );

if ( have_rows( 'row' ) ) :
    ?>
    <div class="table">
        <table cellspacing=0 cellpadding=0>
    <?php
    if ( !empty( $title ) ) {
        ?>
            <tr>
                <th colspan="<?php print $columns ?>"><?php print $title; ?></th>
            </tr>
        <?php
    }

    foreach ( array( 'one', 'two', 'three', 'four' ) as $col ) :
        if ( !empty( $widths[$col] ) ) {
            $widths[$col] = ' width="' . $widths[$col] . '%"';
        } 
    endforeach;

    while ( have_rows( 'row' ) ) : the_row();
        ?>
            <tr>
                <td class="label"<?php print $widths['one'] ?>><?php the_sub_field( 'label' ); ?></td>
                <td<?php print $widths['two'] ?>><?php the_sub_field( 'two' ); ?></td>
                <?php if ( $columns >= 3 ) : ?><td<?php print $widths['three'] ?>><?php the_sub_field( 'three' ); ?></td><?php endif; ?>
                <?php if ( $columns == 4 ) : ?><td<?php print $widths['four'] ?>><?php the_sub_field( 'four' ); ?></td><?php endif; ?>
            </tr>
        <?php
    endwhile;
    ?>
        </table>
    </div>
    <?php
endif;


