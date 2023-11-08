<!-- Use this if the page is large and call it with a global $column;
    in index.php

    <?php /*
            global $column;
			if($i==0): $column = 12;
			elseif($i > 0 && $i <= 2): $column = 6; $class = ' second-row-padding';
			elseif($i > 2): $column = 4; $class = ' third-row-padding';
        */
	?>

    <?php
        // get_template_part('content','blog');
    ?>
-->

<div class="col-xs-<?php echo $column; ?>">
	<?php if( has_post_thumbnail() ): ?>

		<div class="thumbnail"><?php the_post_thumbnail('thumbnail'); ?></div>

	<?php endif; ?>

	<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>

	<small><?php the_category(' '); ?></small>
</div>