<?php get_header(); ?>
        <div class="content">
            <h2>What are we going to talk about?</h2>
            <div class="block-text">
                <?php get_template_part('landing-parts/paragraphs'); ?>
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
                    <li>
                        <div class="box-time">
                            <span>18:00</span>
                        </div>
                        <div class="box-txt">
                            <strong>Registration</strong>
                        </div>
                    </li>
                    <li>
                        <div class="box-time">
                            <span>18:30</span>
                        </div>
                        <div class="box-txt">
                            <strong>Stav Zilbershtein</strong>
                            <p>CEO Hyperion Tech “Scaling on R&D effectively – Key practices to increase company Synergy and smash your goals”</p>
                        </div>
                    </li>
                    <li>
                        <div class="box-time">
                            <span>19:10</span>
                        </div>
                        <div class="box-txt">
                            <strong>Q&A</strong>
                        </div>
                    </li>
                    <li>
                        <div class="box-time">
                            <span>19:20</span>
                        </div>
                        <div class="box-txt">
                            <strong>Adam Darmanin</strong>
                            <p>Conference Chair. Good ol' IT professional.</p>
                        </div>
                    </li>
                    <li>
                        <div class="box-time">
                            <span>19:30</span>
                        </div>
                        <div class="box-txt">
                            <strong>Afterparty</strong>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
<?php get_footer(); ?>
