<?php

$image = get_sub_field( 'image' );
$title = get_sub_field( 'title' );
$color = get_sub_field( 'color' );
$content = get_sub_field( 'content' );

if ( !empty( $image ) && !empty( $title ) && !empty( $content ) ) :
    ?>
<div class="content-feature">
    <div class="image" style="background-image: url(<?php print $image; ?>)";></div>
    <div class="content-feature-inner">
        <h2><?php print $title ?></h2>
        <div class="separator <?php print $color ?>"></div>
        <?php print $content ?>
    </div>
</div>
    <?php
endif;

?>