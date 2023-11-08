<?php get_header(); ?>

<div id="primary" class="container">
    <main id="main" class="site-main" role="main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title">
                    Page not found! What the hell are you doing here!?
                </h1>
            </header>
            <div class="page-content">
                <h2>It looks like nothing was found at this location. Maybe try one of the links below or a seach?</h2>
                <?php get_search_form(); ?>
                <?php
                    the_widget( 'WP_Widget_Recent_Posts' );
                ?>

                    <div class="widget widget_catagories">
                        <h3>Check the most used categories</h3>
                        <ul>
                            <?php
                                wp_list_categories( array(
                                    'orderby' => 'count',
                                    'order' => 'DESC',  // SQL argument needs to be CAP
                                    'show_count' => 1, // boolen argument 0 is false, 1 is true. same with 'dropdown'
                                    'title_li' => '', // dont want a title on each
                                    'number' => 3, // how many to be shown
                                ));
                            ?>
                        </ul>
                    </div>

                    <?php
                        the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
                    ?>
            </div>
        </section>

    </main>
</div>

<?php get_footer(); ?>