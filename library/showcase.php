<?php


// function to use on front-end templates to output the showcase.
function the_showcase() {

	// get the slides
	$slides = get_post_meta( get_the_ID(), "showcase", 1 );

	if ( !empty( $slides ) ) {
		?>
		<div class="showcase">
		<?php
		$count = 0;
		foreach ( $slides as $key => $slide ) {
			if ( !empty( $slide["image"] ) ) {

				// store the title and subtitle
				$link = ( isset( $slide["link"] ) ? $slide["link"] : '' );
				$alt = ( isset( $slide['alt-text'] ) ? $slide["alt-text"] : "Link to " . $link );
				$content = ( isset( $slide['content'] ) ? $slide["content"] : "" );

				// it's an image, so resize it and generate an img tag.
				$image = $slide["image"];

				?>
			<div class="slide <?php print ( $key == 0 ? 'visible' : '' ); ?> <?php print ( !empty( $link ) ? 'has-link' : '' ) ?>" <?php if ( !empty( $link ) ) { print 'data-href="' . $link . '"'; } ?> style="background-image: url(<?php print $image ?>);">
				<?php if ( !empty( $content ) ) { ?>
				<div class="slide-content">
					<?php if ( !empty( $content ) ) { print apply_filters( 'the_content', $content ); } ?>
				</div>
				<?php } ?>
			</div>
				<?php
				$count++;
			}
		}

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
}



// add the showcase metabox
function showcase_metabox( $meta_boxes ) {

    $showcase_metabox = new_cmb2_box( array(
        'id' => 'showcase_metabox',
        'title' => 'Showcase',
        'object_types' => array( 'page', 'event' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $showcase_metabox_group = $showcase_metabox->add_field( array(
        'id' => 'showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Slide', 'cmb2'),
            'remove_button' => __('Remove Slide', 'cmb2'),
            'group_title'   => __( 'Slide {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Background Image',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Content',
        'desc' => 'Fill in the content for this slide.',
        'id'   => 'content',
        'type' => 'wysiwyg',
        'options' => array(
        	'textarea_rows' => 6
        )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Link',
        'id'   => 'link',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_init', 'showcase_metabox' );

