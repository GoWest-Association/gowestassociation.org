<?php


// function loops through the components and includes the template parts for it.
function the_components() {

    // if we have components for this page
    if( have_rows('components') ) :

        // loop through the components
        while ( have_rows('components') ) : the_row();

            // include the template for this row layout
            get_template_part( 'library/component/' . get_row_layout() );

        endwhile;

    endif;

}


// dynamically populate 'nav-menu' select fields with a list of menus
add_filter( 'acf/load_field/name=nav-menu', 'nav_menus_load' );
function nav_menus_load( $field ) {
    $menus = wp_get_nav_menus();
    $field['choices'][0] = '- no menu -';
    if ( ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            $field['choices'][ $menu->slug ] = $menu->name;
        }
    }
    return $field;
}



// dynamically populate 'nav-menu' select fields with a list of menus
add_filter( 'acf/load_field/name=core_color', 'colors_load' );
function colors_load( $field ) {
    global $colors;
    if ( ! empty( $colors ) ) {
        foreach ( $colors as $color_key => $color ) {
            $field['choices'][ $color_key ] = $color;
        }
    }
    return $field;
}



