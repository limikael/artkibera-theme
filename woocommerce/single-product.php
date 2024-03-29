<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Nisarg
 */

get_header(); ?>

<div class="container">
    <div class="row">
		<div id="primary" class="col-md-9 content-area">
			<main id="main" class="site-main" role="main">
				<?php woocommerce_content(); ?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar('sidebar-1'); ?>		
	</div> <!--.row-->            
</div><!--.container-->
<?php get_footer(); ?>
