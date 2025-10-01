<?php

$quote = get_sub_field( 'quote_content' );
$name = get_sub_field( 'name' );
$title = get_sub_field( 'title' );
$photo = get_sub_field( 'photo' );

if ( !empty( $quote ) && !empty( $name ) && !empty( $photo ) ) :
    ?>
<div class="quote-container">
    <div class="quote-inner">
        <div class="quote">
            <?php print wpautop( $quote ) ?>
        </div>
        <div class="attribution">
            <p><strong><?php print $name ?></strong>
            <?php if ( !empty( $title ) ) print "<br>" . $title; ?></p>
        </div>
    </div>
    <div class="quote-photo">
        <img src="<?php print $photo ?>">
    </div>
</div> 
    <?php
endif;

