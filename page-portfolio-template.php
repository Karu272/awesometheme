<?php

/*
    Template Name: Portfolio Template
*/

get_header(); ?>
    <!-- to not keep making a custome page for each custome link that will bloat the WP
    we create a template that will be used dynamicly -->
    <?php
        // post_type look for a custome name 'portfolio' that we use as slug.
        $args = array('post_type' => 'portfolio', 'posts_per_page' => 3 );
        // store the data args so we can push it onto the if loop
        $loop = new WP_Query( $args );

        if( $loop->have_posts(  )):
                while( $loop->have_posts(  )) : $loop->the_post(); ?>

                    <?php get_template_part('content', 'archive' ); ?>

        <?php endwhile;
        endif;
        ?>

<?php get_footer(); ?>

<!-- Now we can go to PAGES->WORK or the page we want to add the template to -->