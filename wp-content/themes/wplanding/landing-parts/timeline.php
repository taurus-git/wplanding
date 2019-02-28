<?php
$args = array(
    'post_type' => 'timeline',
    'order' => 'ASC'
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        ?>
        <li>
            <div class="box-time">
                <span><?php the_field('time'); ?></span>
            </div>
            <div class="box-txt">
                <strong><?php the_field('name'); ?></strong>
                <p><?php the_field('description'); ?></p>
            </div>
        </li>
        <?php
    }

}
wp_reset_postdata(); ?>