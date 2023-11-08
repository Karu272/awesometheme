<?php

    class Walker_Nav_Primary extends Walker_Nav_menu{

        function start_lvl( &$output, $depth = 0, $args = null ){ //ul

            $indent = str_repeat("\t",$depth);

            $submenu = ($depth > 0) ? ' sub-menu' : '';

            $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
        }

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // 1. li a span

            $indent = ($depth) ? str_repeat("\t",$depth) : '';

            $li_attributes = '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $classes[] = ($args->walker->has_children) ? 'dropdown' : '';

            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';

            $classes[] = 'menu-item-' . $item->ID;

            if( $depth && $args->walker->has_children ){
                $classes[] = 'dropdown-submenu';
            }

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            $class_names = ' class="' . esc_attr($class_names) . '"';


            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->object_id, $args);

            $id = strlen($id) ? ' id="' . esc_attr($id) . '" ' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';


            $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';

            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';

            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

            $attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

            $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';

                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                $item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        }

    }
/*

    <?php get_header(); ?>

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
                            
                        <small>
                        <?php
                           echo $terms_list = awesome_get_terms($post->ID, 'field');

                        
                        ?> ||
                        <?php
                            echo $terms_list = awesome_get_terms($post->ID, 'software');
                       
                        ?>
                        <?php
                        if( current_user_can('manage_options')) {
                            echo '|| '; edit_post_link();
                        }
                        ?> </small>

                        <hr>
                        <?php the_content(); ?>

                        <hr>

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
      
        <?php get_sidebar(); ?>
    </div>

</div><!-- /.row -->

<?php get_footer(); ?> 

*/