<?php


function the_faqs() {

    // if we have components for this page
    if( have_rows('faqs') ):

        $i = 0;

        // loop through the components
        while ( have_rows( 'faqs' ) ) : the_row(); $i++;

            // layout switch
            if ( get_row_layout() == 'section_title' ):

                // get fields
                $title = get_sub_field('title');
                $description = get_sub_field('description');

                ?>
                <div class="faq-section">
                    <h2><?php print $title; ?></h2>
                    <?php if ( !empty( $description ) ) { print $description; } ?>
                </div>
                <?php

            elseif ( get_row_layout() == 'question' ): 

                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
                $color = get_sub_field('color');
                $open = get_sub_field('open');
                
                ?>
                <a name="faq-<?php print $i; ?>"></a>
                <div class="accordion<?php print ( $open ? " open" : "" ); ?> <?php print $color ?>">
                    <div class="accordion-handle"><h3><?php print $question ?></h3></div>
                    <div class="accordion-content">
                        <?php print $answer; ?>
                    </div>
                </div>
                <?php

            endif;

        // End loop.
        endwhile;

    endif;

}