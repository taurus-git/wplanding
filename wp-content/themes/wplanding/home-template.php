<?php
/**
* Template Name: home-template
*/
get_header(); ?>
        <div class="content">
            <h2>What are we going to talk about?</h2>
            <div class="block-text">
                <?php
                $args = array(
                    'posts_per_page' => 2,
                    'category_name'  => 'paragraph',
                    'order'          => 'ASC',
                    'orderby'        => 'name',
                );

                $query = new WP_Query($args);

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        echo '<p>' . the_content() . '</p>';
                    }
                } else {

                }

                wp_reset_postdata();
                ?>
            </div>
            <ul class="list-info">
                <li>
                    <div class="img-box">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/ico-01.svg" alt="image description" width="135" height="131">
                    </div>
                    <span>Key Success Factors for an R&D project.</span>
                </li>
                <li>
                    <div class="img-box">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/ico-02.svg" alt="image description" width="138" height="138">
                    </div>
                    <span>How to Transform Product & Development synergies</span>
                </li>
                <li>
                    <div class="img-box">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/ico-03.svg" alt="image description" width="137" height="140">
                    </div>
                    <span>How to Identify barriers to success and eliminate them on the go.</span>
                </li>
                <li>
                    <div class="img-box">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/ico-04.svg" alt="image description" width="130" height="164">
                    </div>
                    <span>Take your product ownership to the next level with these 3 simple actions</span>
                </li>
            </ul>
        </div>
        <!-- start section speakers -->
        <section class="section-speakers">
            <div class="block-speakers">
                <h2>Speakers</h2>
                <div class="slick-slider slick-speakers">
                    <?php get_template_part('landing-parts/speakers'); ?>
                </div>
            </div>
        </section>
        <!-- end section speakers -->
        <section class="section-holder" id="timeline">
            <div class="section-inform">
                <h3>Timeline</h3>
                <ul class="timeline-list">
                    <?php get_template_part('landing-parts/timeline'); ?>
                </ul>
            </div>
        </section>
<?php get_footer(); ?>
