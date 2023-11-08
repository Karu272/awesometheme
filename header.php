<!DOCTYPE html>
<html <?php language_attributes(); ?> >
		<!-- language_atr bloginfo is all WP functions to make it dynamic.
		 wp_title follow the name of the theme and the title of the blogpost around -->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
            <title><?php bloginfo('name'); ?><?php wp_title('|'); ?> </title>
			<meta name="description" content="<?php bloginfo('description'); ?>">
        <?php wp_head(); ?>
    </head>

    <!-- if we wanna use specific tag for each page an array works but then it will be global -->
    <!-- this IF loop will check which page we are on and just use the tag for specific page -->

    <?php

        if( is_front_page(  ) ):
            $awesome_classes = array( 'awesome-class', 'my-class' );
        else:
            $awesome_classes = array( 'no-awesome-class');
        endif;

	?>

	<!-- body_class function display different tag for each page so they can be styled individually -->
	<body <?php body_class( $awesome_classes ); ?>>

		<div class="container">

			<div class="row">

				<div class="col-xs-12">

					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					      <a class="navbar-brand" href="#">Awesome Theme</a>
					    </div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!-- call the a menu from functions.php. in this case "primary" secondary will be in the footer etc -->
							<?php
								wp_nav_menu(array(
									'theme_location' => 'primary',
									'container' => false,
									'menu_class' => 'nav navbar-nav navbar-right',
									'walker' => new Walker_Nav_Primary()
									)
								);
							?>
						</div>
					  </div><!-- /.container-fluid -->
					</nav>

				</div>
				<div class="col-xs-12">
					<div class="search-form-container">
						<div class="container">
						 	<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			</div>
<!-- To show the custom Header from functions.php this line of code is needed -->
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />