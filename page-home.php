<?php get_header(); ?>
<hr>
<div class="row">
<!-- to get last blogpost shown at homepage we create a new file instead of bulk index.php -->
<!-- as before WP will read "page- " and match it with our navigation tag = understand this is home -->

    <div class="col-xs-12">

            <div id="awesome-carousel" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

<?php
                            // THIS METHOD DISPLAY LAST POST IN EACH CATEGORY
    // if someone change the post aka edit it to a different name and category the page will display it still.
    // to avoid that we reverse the loop and loop through the categories before loop the posts.
    $args_cat = array(
        // in this case we use string
        // get the id=??? inside the URL of the categories
        'include' => '7, 8, 9'
    );

        $categories = get_categories( $args_cat );
        //var_dump($categories);

        $count = 0;
        $bullets = '';

            foreach($categories as $category):

            // to pick the options/element in admin panel in WP we call the pre coded options/element with string or array
            // &posts_per_page=1 set of numbers of posts that will be seen at home
            // $lastBlog = new WP_Query('type=post&posts_per_page=1');
            // array is better to use
            $args = array(
                'type' => 'post',
                'posts_per_page' => 1,
                // to pick ONLY latest post from each category add this(yes, use dubble _ )
                // open an new array and add the id from the catagories you want to be displayed
                'category__in' => $category->term_id,
                // add this to strictly allow only cat 7 to 9 to be shown
                'category__not_in' => array( 10 ),
            );

            $lastBlog = new WP_Query($args);


            if ($lastBlog->have_posts()):

                while ($lastBlog->have_posts()): $lastBlog->the_post(); ?>

                    <div class="item <?php if($count == 0): echo 'active'; endif; ?>">
						<?php the_post_thumbnail('full'); ?>
						    <div class="carousel-caption">
						        <?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>

						        <small><?php the_category(' '); ?></small>
				            </div>
					</div>

                    <?php $bullets .= '<li data-target="#awesome-carousel" data-slide-to=" '.$count.' " class=" ' ; ?>
						    <?php if($count == 0): $bullets .='active'; endif; ?>

						    <?php  $bullets .= '"></li>'; ?>


                    <!-- old code BEFORE CARUSEL
                     fetch code from content-featured.php file
                         put it in bootstrap col-xs

                    <div class="col-xs-12 col-sm-4">
                        <?php // get_template_part('content', 'featured'); ?>
                    </div>

                    EVEN OLDER CODE
                     instead of use formats image, aside etc we force the look with featured -->
                    <?php //get_template_part('content', get_post_format()); ?>

    <?php
                endwhile;
            endif;

            // when using WP_Query() always use this to close the function
            // it will reset the variable if we want to use it elsewhere so editing wont effetct future querypost
            wp_reset_postdata();

        $count++;

            endforeach;
    ?>

            <!-- Indicators -->
            <ol class="carousel-indicators">
			    <?php echo $bullets; ?>
			</ol>

		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#awesome-carousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#awesome-carousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

	</div>

</div>

<div class="row">

    <div class="col-xs-12 col-sm-8">

        <?php
        /*if there are posts in the theme already there they will be displayed with this if loop */
        if (have_posts()):
            /* get post format is from add_theme_support in functions.php */
            while (have_posts()):
                the_post(); ?>
                <!-- Get the content from content.php -->
                <!-- fetching the format option as second parameter -->
                <?php get_template_part('content', get_post_format()); ?>

                <!-- need to use php tags to close the if and endwhile like foreach in blade pages -->
            <?php endwhile;
        endif;









/*
                            // if and while code taken from index.php from the beginning

            // PRINST OTHER 2  POSTS NOT THE FIRST ONE

            // 2&offset=1 skip 1 one show 2 after latest post only
            // $lastBlog = new WP_Query('type=post&posts_per_page=2&offset=1');
        <?php
            if ($lastBlog->have_posts()):

                    while ($lastBlog->have_posts()): $lastBlog->the_post();
        ?>

                    <?php get_template_part('content', get_post_format()); ?>

            <?php
                 endwhile;
                endif;

            wp_reset_postdata();

            ?>

// second method to do it

        <?php

            // PRINT ONLY TUTORIALS CATEGORY FROM CATEGORIES
            // to set cat write -1&cat= and from the category page in admin click the category and look at the URL for &tag_ID=9
            $lastBlog = new WP_Query('type=post&posts_per_page=-1&cat=9');

            if ($lastBlog->have_posts()):

                while ($lastBlog->have_posts()): $lastBlog->the_post();
        ?>

                    <?php get_template_part('content', get_post_format()); ?>
        <?php
                endwhile;
            endif;

            wp_reset_postdata();

        ?>
*/
?>
    </div>

    <div class="col-xs-12 col-sm-4">
        <!-- get sidebar from sidebar.php and functions. get_sidebar() is a build in function in WP -->
        <?php get_sidebar(); ?>
    </div>

</div> <!-- /.row -->

<?php get_footer(); ?>