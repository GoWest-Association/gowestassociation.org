<?php

$title = get_sub_field( 'title' );
$categories = get_sub_field( 'categories' );
$posts_per_page = get_sub_field( 'posts_per_page' );

if ( !empty( $categories ) ) : ?>
    <div class="page-articles">
        <h2 class="page-articles-title"><?php print $title ?></h2>
        <?php 
        print do_shortcode( '[articles cats="' . implode( ',', $categories ) . '" posts_per_page=' . $posts_per_page . ' /]' );
        if ( is_foundation() && is_front_page() ) { 
            print '<a href="/news" class="btn navy">View All Articles</a>';
        } else if ( get_brand() == 'association' && is_front_page() ) {
            print '<a href="/onthego" class="btn navy">View All Articles</a>';
        }
        ?>
    </div><?php
endif;

