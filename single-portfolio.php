<?php get_header(); ?>
<!-- Single.php gives by defult of WP the blogpost its single page
    all the elements that the post needs is in this file. title, category, text etc
-->
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <?php

            if( have_posts(  ) ):

                while( have_posts() ): the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php the_title( '<h1 class="entery-title">', '</h1>' ) ?>

                    <?php if( has_post_thumbnail() ): ?>

                        <div class="pull-right"> <?php the_post_thumbnail( 'thumbnail' ); ?> </div>
                        <?php endif; ?>
                            <!-- by adding (' ') to the cat function we transform the cat to a line of text
                                instead of making it a list that keeps posting text under each other
                            -->
                            <!-- In PHP we cant just print an array we need to loop it so we will store
                             data in $terms_list and loop it then print it out -->
                        <small>
                        <?php
                           echo $terms_list = awesome_get_terms($post->ID, 'field');

                        /* old code
                        $terms_list = wp_get_post_terms($post->ID, 'field');

                        $i = 0;
                            foreach($terms_list as $term){
                                $i++;
                                if($i > 1 ) { echo ', '; }
                                // to put a space and a , after each tag in taxonomy
                                echo $term->name;
                            }
                        */
                        ?> ||
                        <?php
                            echo $terms_list = awesome_get_terms($post->ID, 'software');
                        /* old code
                         $next_terms_list = wp_get_post_terms($post->ID, 'software');

                         $i = 0;
                             foreach($next_terms_list as $term){
                                 $i++;
                                 if($i > 1 ) { echo ', '; }
                                 // to put a space and a , after each tag in taxonomy. look in functions.php
                                 echo $term->name;
                             }
                        */
                        ?>
                        <?php
                        if( current_user_can('manage_options')) {
                            echo '|| '; edit_post_link();
                        }
                        ?>
                        </small>

                        <hr>
                        <?php the_content(); ?>

                        <hr>

                        <!-- put to next/previous post nav in each blogpost
                            post_link SINGULAR not like in index.php
                        -->
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <?php previous_post_link(); ?>
                            </div>
                            <div class="col-xs-6 text-right">
                                <?php next_post_link(); ?>
                            </div>
                        </div>

                    </article>
                <?php endwhile;
                    endif;
                ?>
    </div>


    <div class="col-xs-12 col-sm-4">
        <!-- get sidebar from sidebar.php and functions. get_sidebar() is a build in function in WP -->
        <?php get_sidebar(); ?>
    </div>

</div><!-- /.row -->

<?php get_footer(); ?> <!-- every new page most start with get_footer -->