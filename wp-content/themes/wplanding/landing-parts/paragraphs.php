<?php

$args = array(
    'post_type' => 'paragraph',
    'order' => 'ASC'
);

$query = new WP_Query($args);
$i = 0;

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        if ( $i == 0 ){
            echo get_field('text');
        } else {
            echo '<strong>' . get_field('text') . '</strong>';
        } $i++;
    }
}
wp_reset_postdata(); ?>