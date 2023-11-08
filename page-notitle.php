<!-- This page is only for developers and wont be shown in wp or effect it -->
<!-- This template will be shown in edit page, settings(right icon), Template -->
<!-- either the use create its own page or use the template -->
<?php

/*
    Template Name: Page No Title
*/

get_header(); ?>

    <?php
/*if there are posts in the theme already there they will be displayed with this if loop */
        if( have_posts(  )):
            while( have_posts(  )) : the_post(); ?>

                <h1>This is my static title</h1>
                <!-- this functon will display time it was posted and other info -->
                            <!-- F = month, j = day, Y = year -->
                            <!-- g = hour, i = minute, a = am or pm -->
                <small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i, a'); ?>, in <?php the_category(); ?></small>

                <p><?php the_content(); ?></p>

                <hr>
                <!-- need to use php tags to close the if and endwhile like foreach in blade pages -->
    <?php
            endwhile;
        endif;
    ?>


<?php get_footer(); ?> <!-- every new page most start with get_footer and get_header -->