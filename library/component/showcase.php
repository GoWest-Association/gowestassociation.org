<?php

if ( have_rows( 'slides' ) ) {
    ?>
    <div class="showcase">
    <?php
    $count = 0;
    while ( have_rows( 'slides' ) ) : the_row();
        
        // populate the slide array to fit with old showcase code.
        $slide = array();
        $slide['link'] = get_sub_field( 'link' );
        $slide['image'] = get_sub_field( 'image' );
        $slide['video'] = get_sub_field( 'video' );
        $slide['content'] = get_sub_field( 'content' );
        $key = get_row_index();

        // if we have an image
        if ( !empty( $slide['image'] ) ) :
            
            // store the title and subtitle
            $link = ( isset( $slide["link"] ) ? $slide["link"] : '' );
            $content = ( isset( $slide['content'] ) ? $slide["content"] : "" );
            $image = $slide["image"];
            $video = ( isset( $slide['video'] ) ? $slide['video'] : '' );

            ?>
        <div class="slide<?php print ( $key == 1 ? ' visible' : '' ); print ( stristr( $link, 'youtube' ) || stristr( $link, 'vimeo' ) ? ' lightbox-video' : '' ); print ( !empty( $link ) ? ' has-link' : '' ) ?>" <?php print ( !empty( $link ) ? 'data-href="' . $link . '"' : '' ); ?> style="background-image: url(<?php print $image ?>);">
            
            <?php if ( stristr( $video, '.webm' ) ) { ?>
            <video class="slide-video" autoplay muted loop>
                <source src="<?php print $video; ?>" type="video/webm">
            </video>
            <?php } ?>

            <?php if ( !empty( $content ) ) { ?>
            <div class="slide-content">
                <?php if ( !empty( $content ) ) { print apply_filters( 'the_content', $content ); } ?>
            </div>
            <?php } ?>
        </div>
            <?php
            $count++;
        endif;
    endwhile;

    if ( $count > 1 ) { 
        ?>
        <div class="showcase-nav">
            <a class="previous">Previous</a>
            <a class="next">Next</a>
        </div>
        <?php
    }
    ?>
    </div>
    <?php
}

