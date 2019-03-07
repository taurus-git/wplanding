<?php
/**Plugin Name: Shortcode Plugin */
//shortcode for make text bolder
add_shortcode( 'strong', 'make_text_bolder' );
function make_text_bolder( $atts, $content, $tag ){
    return '<strong>' . $content . '</strong>';
}
//shortcode for showing speakers
add_shortcode( 'speakers', 'show_speakers' );
function show_speakers( $atts, $content, $tag ){

     $atts = shortcode_atts( [
        'background-color' => '#d3d3d3',
        'count' => wp_count_posts( 'speaker' )->publish,
     ], $atts, 'speakers' );

    ob_start();

    $args = array(
        'post_type' => 'speaker',
        'order' => 'ASC',
        'posts_per_page' => $atts['count'],
    );

    $query = new WP_Query($args);?>

    <section class="section-speakers">
        <div class="block-speakers" style="background-color: <?php echo esc_attr( $atts['background-color'] );?>">
            <h2>Speakers</h2>
            <div class="slick-slider slick-speakers">
            <?php
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
                            <img width="160" height="160" alt="<?php echo esc_attr($alt); ?>" src="<?php echo esc_attr($url); ?>">
                        </div>
                        <div class="box-txt">
                            <h3><?php the_field('name'); ?></h3>
                            <span><?php the_field('position'); ?></span>
                            <p><?php the_field('theme'); ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
            wp_reset_postdata();?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}