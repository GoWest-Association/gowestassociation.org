<?php


// price table
function the_price_table() {

	// get the icons
	$prices = get_cmb_value( 'price-table-rows' );

	if ( !empty( $prices[0]['info'] ) ) {
	// if it's an array, we'll assume it's got content
	?>
    <div class="price-table-container">
		<div class="price-table">
			<?php
			foreach ( $prices as $price ) {
				if ( !empty( $price['info'] ) ) { 
					?>
			<div class="price-row">
                <div class="info">
                    <?php print apply_filters( 'the_content', $price['info'] ); ?>
                </div> 
                <div class="prices">
                    <?php  
                    if ( !empty( $price['price-1-text'] ) && !empty( $price['price-1-value'] ) ) {
                        print '<div class="price one">' . $price['price-1-text'] . '<br><span>' . $price['price-1-value'] . '</span></div>';
                    }
                    if ( !empty( $price['price-2-text'] ) && !empty( $price['price-2-value'] ) ) {
                        print '<div class="price two">' . $price['price-2-text'] . '<br><span>' . $price['price-2-value'] . '</span></div>';
                    }
                    if ( !empty( $price['price-3-text'] ) && !empty( $price['price-3-value'] ) ) {
                        print '<div class="price three">' . $price['price-3-text'] . '<br><span>' . $price['price-3-value'] . '</span></div>';
                    }
                    ?>
                </div>
                <div class="buttons">
                    <?php if ( !empty( $price['button-1-text'] ) && !empty( $price['button-1-link'] ) ) { ?><a href="<?php print $price['button-1-link']; ?>" class="btn <?php print ( !empty( $price['button-1-class'] ) ? ' ' . $price['button-1-class'] : '' ) ?>"><?php print $price['button-1-text']; ?></a><?php } ?>
                    <?php if ( !empty( $price['button-2-text'] ) && !empty( $price['button-2-link'] ) ) { ?><a href="<?php print $price['button-2-link']; ?>" class="btn <?php print ( !empty( $price['button-2-class'] ) ? ' ' . $price['button-2-class'] : '' ) ?>"><?php print $price['button-2-text']; ?></a><?php } ?>
                    <?php if ( !empty( $price['button-3-text'] ) && !empty( $price['button-3-link'] ) ) { ?><a href="<?php print $price['button-3-link']; ?>" class="btn <?php print ( !empty( $price['button-3-class'] ) ? ' ' . $price['button-3-class'] : '' ) ?>"><?php print $price['button-3-text']; ?></a><?php } ?>
                    <?php if ( !empty( $price['button-4-text'] ) && !empty( $price['button-4-link'] ) ) { ?><a href="<?php print $price['button-4-link']; ?>" class="btn <?php print ( !empty( $price['button-4-class'] ) ? ' ' . $price['button-4-class'] : '' ) ?>"><?php print $price['button-4-text']; ?></a><?php } ?>
                </div>
			</div>
					<?php
				}
			}
			?>
		</div>
    </div>
	<?php
	}

}


// add partner metaboxes
function price_table_metabox( $meta_boxes ) {

    // thumb showcase metabox
    $price_table_metabox = new_cmb2_box( array(
        'id' => 'price_table_metabox',
        'title' => 'Price Table',
        'object_types' => array( 'page', 'event' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $price_table_metabox_group = $price_table_metabox->add_field( array(
        'id' => CMB_PREFIX . 'price-table-rows',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Row', 'cmb2'),
            'remove_button' => __('Remove Row', 'cmb2'),
            'group_title'   => __( 'Row {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Option Info',
        'desc' => "Describe the option, including a title and short description of what's included.",
        'id'   => 'info',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 4
        )
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Price 1 Text',
        'id'   => 'price-1-text',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Price 1 Value',
        'id'   => 'price-1-value',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Price 2 Text',
        'id'   => 'price-2-text',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Price 2 Value',
        'id'   => 'price-2-value',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Price 3 Text',
        'id'   => 'price-3-text',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Price 3 Value',
        'id'   => 'price-3-value',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 1 Text',
        'id'   => 'button-1-text',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 1 Link',
        'id'   => 'button-1-link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 1 Class',
        'id'   => 'button-1-class',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 2 Text',
        'id'   => 'button-2-text',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 2 Link',
        'id'   => 'button-2-link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 2 Class',
        'id'   => 'button-2-class',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 3 Text',
        'id'   => 'button-3-text',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 3 Link',
        'id'   => 'button-3-link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 3 Class',
        'id'   => 'button-3-class',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 4 Text',
        'id'   => 'button-4-text',
        'type' => 'text',
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 4 Link',
        'id'   => 'button-4-link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $price_table_metabox->add_group_field( $price_table_metabox_group, array(
        'name' => 'Button 4 Class',
        'id'   => 'button-4-class',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_admin_init', 'price_table_metabox' );


