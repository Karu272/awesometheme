<?php get_header(); ?>
<hr>
<div class="row">

	<div class="col-xs-12 col-sm-8">

		<div class="row">

		<?php

		if( have_posts() ):

			while( have_posts() ): the_post(); ?>

                <?php get_template_part('content', 'search'); ?>

		<?php
            endwhile;

		endif;

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