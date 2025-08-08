<?php


?>
<div class="tabs-container">
    <div class="tabs">
    <?php
    if ( have_rows('tabs') ) : 
        ?>

        <div class="tab-handles">
        <?php
        // loop through the rows of data
        $num = 1;
        while ( have_rows( 'tabs' ) ) : the_row();
            $index = get_row_index();
            $label = get_sub_field('label');
            ?><div class="handle tab-<?php print $index; ?> <?php print ( $index == 1 ? 'active' : '' ); ?>" data-tab="<?php print $index; ?>"><?php print $label; ?></div><?php
            $num++;

        endwhile;
        ?>
        </div>
        <?php

    endif;
       
    // loop through tabs again to output content.
    if ( have_rows('tabs') ) :
        
        ?>
        <div class="tab-contents">
        <?php
        // loop through the rows of data
        $num = 1;
        while ( have_rows( 'tabs' ) ) : the_row();
            $index = get_row_index();

            // if we have components for this page
            if ( have_rows('components') ) :
                ?>
            <div class="content tab-<?php print $index; ?> <?php print ( $index == 1 ? 'active' : '' ); ?>">
                <?php
                // loop through the components
                while ( have_rows('components') ) : the_row();

                    // include the specific layout
                    get_template_part( 'library/component/' . get_row_layout() );

                endwhile;
            ?>
            </div>
            <?php
            endif;

        endwhile; ?>
        </div>

        <?php
    endif;
    ?>
    </div>
</div>
<?php

