<?php

$color = get_sub_field( 'color' );
$style = get_sub_field( 'style' );
$background = get_sub_field( 'background' );

?>
<div class="page-title <?php print $color ?> <?php print $style ?>"<?php print ( $style == 'tall' ? ' style="background-image: url(' . $background . ');"' : '' ); ?>>
	<h1><?php the_sub_field( 'title' ); ?></h1>
</div>
