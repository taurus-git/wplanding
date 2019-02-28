<?php
$args = array(
    'post_type' => 'speaker',
    'order' => 'ASC'
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        //vars for image
        $photo = get_field('photo');
        $url = $photo['url'];
        $alt = $photo['alt'];
        ?>
            <div class="box-speaker">
                <div class="box-img">
                    <img width="160" height="160" alt="<?php echo $alt;?>" src="<?php echo $url; ?>">
                </div>
                <div class="box-txt">
                    <h3><?php the_field('name') ?> </h3>
                    <span><?php the_field('position') ?></span>
                    <p><?php the_field('theme') ?></p>
                </div>
            </div>
        <?php
    }

}
wp_reset_postdata(); ?>

