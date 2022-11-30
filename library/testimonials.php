<?php



// accordion output function
function the_testimonials() {

	// get the slides
	$testimonials = get_post_meta( get_the_ID(), "testimonials", 1 );

	if ( !empty( $testimonials ) ) {
		?>
		<div class="testimonials">
			<?php
			foreach ( $testimonials as $testimonial ) {
				if ( !empty( $testimonial["content"] ) ) {

					// store the title and subtitle
					$by = ( isset( $testimonial["by"] ) ? $testimonial["by"] : '' );
                    $content = ( isset( $testimonial["content"] ) ? $testimonial["content"] : '' );

					?>
			<div class="testimonial">
				<div class="quote">
					<?php print $content; ?>
				</div>
                <div class="by">
                    <?php print $by; ?>
                </div>
			</div>
					<?php
				}
			}
			?>

            <a class="control prev">&lt;</a>
            <a class="control next">&gt;</a>
		</div>
		<?php
	}
}



// testimonial metabox
function testimonial_metaboxes() {

    global $colors;

    // area of interest information
    $testimonial_metabox = new_cmb2_box( array(
        'id' => 'testimonials',
        'title' => 'Testimonials',
        'object_types' => array( 'page', 'event' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $testimonial_metabox_group = $testimonial_metabox->add_field( array(
        'id' => 'testimonials',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Testimonial', 'cmb'),
            'remove_button' => __('Remove Testimonial', 'cmb'),
            'group_title'   => __( 'Testimonial {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $testimonial_metabox->add_group_field( $testimonial_metabox_group, array(
        'name' => 'Content',
        'id'   => 'content',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 5,
        ),
    ) );

    $testimonial_metabox->add_group_field( $testimonial_metabox_group, array(
        'name' => 'By Line',
        'id'   => 'by',
        'type' => 'text',
    ) );

}
add_action( 'cmb2_admin_init', 'testimonial_metaboxes' );


