<?php get_header(); ?>
<hr>
<div class="row">

	<div class="col-xs-12 col-sm-8">

		<div class="row text-center">

		<?php
		// this will overwrite the value in settings->reading pages
		//     IF    TRUE     USE THIS   ELSE    THIS
		// ( fun())   ?        funk()     :        1;        is a dumb IF loop
		$currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array('posts_per_page' => 3, 'paged' => $currentPage);
		query_posts( $args );

		if( have_posts() ): $i = 0;

			while( have_posts() ): the_post(); ?>
                <!-- Live session 10a
                    Looping blogpost in different sizes
                -->
				<?php
					$class = ''; // Initialize $class
                    // setting up 1, 2 and 3 row with sizes and CSS configs
					if($i==0): $column = 12;
					elseif($i > 0 && $i <= 2) : $column = 6; $class = ' second-row-padding';
					elseif($i > 2) : $column = 4; $class = ' third-row-padding';
					endif;
				?>
                    <!-- calling out the php if loop to the HTML column and class -->
					<div class="col-xs-<?php echo $column; echo $class; ?> blog-item">
						<?php if( has_post_thumbnail() ):
                            // getting the thumbnail, getting the URL, put it as background img with $urlImg
							$urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						endif; ?>
                        <!-- call it here as echo $urlImg -->
						<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);">
                            <!-- get title of the blogpost as usual -->
							<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
                            <!-- get the category name of the blogpost -->
							<small><?php the_category(' '); ?></small>
						</div>
					</div>

			<?php $i++; endwhile; ?>
			<!-- in setting reading you have to change the number of post to something lesser because speed/readability/relevans etc
			 but if you do so the rest of the older post will disappear. to work around this you add this codde
			THIS can be forced with the code at the second < ?php opening tag and refresed/resetted at endif tag
			-->

				<div class="col-xs-6 text-left">
						<?php next_posts_link('<< Older Posts'); ?>
				</div>
				<div class="col-xs-6 text-right">
						<?php previous_posts_link('Older Newer >>'); ?>
				</div>
			<!-- Yes the functions are backwards becasue array increase after each input -->
		<?php
		endif;
			wp_reset_query();
		?>
		</div>

	</div>

	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>

<!-- OBS! to make home page shown and not the latest post
go to settings in WP, locate READING. under "Front page display" change options.
add BLOG or new page to one or more of the menus under Apper->MENUS in WP -->