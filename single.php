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
                        <small><?php the_category(' '); ?> || <?php the_tags(); ?> || <?php edit_post_link(); ?> </small>
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

                        <!-- turn on off the comments in blog post edit section -->
                        <?php if( comments_open() ) {
                            comments_template();
                        }else{
                            echo '<h5 class="text-center">SOrry; Comments are BANNED!</h5>';
                        }

                        ?>

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