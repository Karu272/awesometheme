<?php get_header(); ?> <!-- every new page most start with the name page-( Slug name ).php and with get_header -->

    <!-- But if you dont know what page the user will create use the page-notitle.php file to create a template -->
    <!-- To avoid error if slug name is change use the page=NUMBER as slug. can be found in edit -->
    <!-- THIS PAGE used to be page-about-me.php but to not crash site if user change name is better to use number slug -->
    <div class="row">
    <div class="col-xs-12 col-sm-8">
    <?php
/*if there are posts in the theme already there they will be displayed with this if loop */
        if( have_posts(  )):
            while( have_posts(  )) : the_post(); ?>

                <p><?php the_content(); ?></p>

                <!-- these functions get the posts like title and the text -->
                <h3><?php the_title(); ?></h3>

                <hr>
                <!-- need to use php tags to close the if and endwhile like foreach in blade pages -->
    <?php
            endwhile;
        endif;
    ?>
</div>

<div class="col-xs-12 col-sm-4">
    <!-- get sidebar from sidebar.php and functions. get_sidebar() is a build in function in WP -->
    <?php get_sidebar(); ?>
</div>

</div> <!-- /.row -->

<?php get_footer(); ?> <!-- every new page most start with get_footer -->