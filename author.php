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

	$authorId=$author;
	if (!$authorId)
		exit("Author not found!");

	$authorUser=get_userdata($authorId);
	if (!$authorUser || !$authorUser->ID)
		exit("Author not found!");

	get_header();
?>

<div class="container">
    <div class="row">
		<div id="primary" class="col-md-9 content-area">
			<main id="main" class="site-main" role="main">

				<article id="author-<?php echo $authorId; ?>"
						class="post-content author-page">
					<header class="entry-header">
						<h1 class="entry-title">
							<?php echo $authorUser->display_name; ?>							
						</h1>

						<div class="entry-meta"></div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php echo get_avatar($authorUser->ID,150); ?>
						<p>
							<?php echo $authorUser->description; ?>
						</p>
					</div>

					<header class="entry-header">
						<h3 class="entry-title">
							Art by <?php echo $authorUser->display_name; ?>
						</h3>
						<div class="entry-meta"></div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							$query=new WP_Query(array(
								"post_type"=>"product",
								"meta_key"=>"creator",
								"meta_value"=>$authorId
							));

							$posts=$query->get_posts();
							$ids=array();

							foreach ($posts as $post)
								$ids[]=$post->ID;

							$commaIds=join(",",$ids);
						?>

						<?php if (sizeof($ids)) { ?>
							<?php echo do_shortcode("[products ids='$commaIds']"); ?>
						<?php } ?>
					</div>

				</article>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar('sidebar-1'); ?>		

	</div> <!--.row-->            
</div><!--.container-->
<?php get_footer(); ?>
