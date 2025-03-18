<?php

// if it's an array
if ( have_rows( 'box' ) ) { ?>
	<div class="link-boxes-container">
		<div class="link-boxes">
		<?php while ( have_rows( 'box' ) ) : the_row();
			$background = get_sub_field( 'background' );
			$text = get_sub_field( 'text' );
			$link = get_sub_field( 'link' );
			if ( !empty( $background ) && !empty( $text ) && !empty( $link ) ) : ?>
            <div class="link-box" style="background-image: url(<?php print $background; ?>);">
                <a href="<?php print $link; ?>"><?php print $text; ?></a>
            </div><?php
			endif;
		endwhile; ?>
		</div>
	</div><?php
}
