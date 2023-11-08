<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php the_title( '<h1 class="entery-title">', '</h1>' ) ?>

<?php if( has_post_thumbnail() ): ?>

    <div> <?php the_post_thumbnail( 'thumbnail' ); ?> </div>
    <?php endif; ?>
        <!-- by adding (' ') to the cat function we transform the cat to a line of text
            instead of making it a list that keeps posting text under each other
        -->
    <small><?php the_category(' '); ?> || <?php the_tags(); ?> || <?php edit_post_link(); ?> </small>
    <hr>
    <?php the_content(); ?>


</article>