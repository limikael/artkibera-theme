<article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
	<header class="entry-header">
		<span class="screen-reader-text"><?php the_title();?></span>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta"></div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			/**
			 * woocommerce_before_single_product hook.
			 *
			 * @hooked wc_print_notices - 10
			 */
			 do_action( 'woocommerce_before_single_product' );
		?>

		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
			<div class="summary entry-summary">
				<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */

					remove_all_actions('woocommerce_single_product_summary');

					add_action('woocommerce_single_product_summary',
						'woocommerce_template_single_excerpt');

					add_action('woocommerce_single_product_summary',
						'woocommerce_template_single_price');

					add_action('woocommerce_single_product_summary',
						'woocommerce_template_single_add_to_cart');

					add_action('woocommerce_single_product_summary',
						'woocommerce_template_single_sharing');

					do_action( 'woocommerce_single_product_summary' );
				?>
			</div><!-- .summary -->

			<?php
				/**
				 * woocommerce_after_single_product_summary hook.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				//do_action( 'woocommerce_after_single_product_summary' );
			?>

			<meta itemprop="url" content="<?php the_permalink(); ?>" />

		</div><!-- #product-<?php the_ID(); ?> -->
	</div>

	<?php
		$authorId=get_post_meta(get_the_ID(),"creator",TRUE);
		$authorUser=get_userdata($authorId);
		if (!$authorUser || !$authorUser->ID)
			echo "Author not found!";
	?>

	<?php if ($authorUser) { ?>
		<header class="entry-header">
			<h3 class="entry-title">
				By <?php echo $authorUser->display_name; ?>
			</h3>
			<div class="entry-meta"></div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content product-author-info">
			<a href="<?php echo get_author_posts_url($authorId); ?>">
				<?php echo get_avatar($authorUser->ID,100); ?>
			</a>
			<p>
				<?php echo $authorUser->description; ?>
			</p>
		</div>
	<?php } ?>

	<?php do_action( 'woocommerce_after_single_product' ); ?>
</article>
