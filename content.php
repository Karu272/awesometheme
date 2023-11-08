<!-- the_ID() retrieves the unique identifier of the post,
which is then used as part of the id attribute for the div element.
This helps in creating a unique identifier for each post's container. -->

<!-- Post_class(); function is a handy tool used to add CSS classes to the HTML body element of a post or page.
post_class() generates a list of CSS classes based on the post's characteristics. These classes are added to the
class attribute of the div element. For instance, if the post is in the "Category A" and "Tag B", the function
might output classes like category-category-a, tag-tag-b, etc. -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
    <!-- sprintf() function is used to format strings by substituting placeholders with corresponding values.
    It's particularly useful when you want to create a formatted string dynamically, incorporating variables
    or values in specific places within the string. exmple $greeting_message = sprintf("Hello, %s! Today is %s.", $user_name, $current_date); -->

    <!-- The primary purpose of esc_url() is to escape and sanitize the URL to remove any potentially harmful
    characters or code, making sure that the URL is valid and safe for display on a webpage. -->

    <!-- get_permalink() function is used to retrieve the permalink (URL) for a specific post, page, or custom post type.
    Permalink is the permanent URL structure that uniquely identifies a piece of content on your WordPress website. -->
		<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
		<small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>, in <?php the_category(); ?></small>
	</header>

	<div class="row">

		<?php if( has_post_thumbnail() ): ?>

			<div class="col-xs-12 col-sm-4">
				<div class="thumbnail"><?php the_post_thumbnail('medium'); ?></div>
			</div>
			<div class="col-xs-12 col-sm-8">
				<?php the_content(); ?>
			</div>

		<?php else: ?>

			<div class="col-xs-12">
				<?php the_content(); ?>
			</div>

		<?php endif; ?>
	</div>

</article>

<!-- OLD CODE * these functions get the posts like title and the text
  <h3>< php the_title(); ?></h3>
    * Adding the thumbnail to blog post from functions.php
    <div class="thumbnail-img">< php the_post_thumbnail('thumbnail'); ?></div>
        * this functon will display time it was posted and other info
            * F = month, j = day, Y = year
            * g = hour, i = minute, a = am or pm
                <small>Posted on: < php the_time('F j, Y'); ?> at < php the_time('g:i, a'); ?>, in < php the_category(); ?></small>

                <p>< php the_content(); ?></p>

                <hr>
-->