<?php
$args = array(
    'post_type' => 'timeline',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        while ( have_rows('timeline') ) : the_row(); ?>
            <li>
                <div class="box-time">
                    <span><?php the_sub_field('time'); ?></span>
                </div>
                <div class="box-txt">
                    <strong><?php the_sub_field('name'); ?></strong>
                    <p><?php the_sub_field('description'); ?></p>
                </div>
            </li>
        <?php
        endwhile;
    }

}
wp_reset_postdata(); ?>