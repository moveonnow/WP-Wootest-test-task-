
<?php /* Template Name: Redirect Page */ 

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php

				$args = array(
					'post_type' => 'product'
				);

				$prefix = 'wootest';

				$query = new WP_Query;
				$films = $query->query($args);

				foreach( $films as $film ){
					

					$film_product = wc_get_product($film);
					$terms = get_the_terms($film->ID, 'product_cat');




					?>

					<div class="item"> 

					<p> <b>thumb:</b> <?php echo get_the_post_thumbnail( $film->ID, 'thumbnail' ); ?></p>
					<p> <b>title:</b> <?php echo $film->post_title; ?></p>
					<p> <b>categories:</b> 

					<?php 

						foreach ($terms as $key => $term) {
							echo $term->name.' '; 
						}

					?>
						
					</p>
					
					<?php

					$subtitle = get_post_meta($film->ID, $prefix.'_subtitle',true);
					if (!empty($subtitle)) {
						?> <p> <b>subtitle:</b> <?php echo $subtitle; ?></p> <?php
					}

					?>
	
					<?php

					$some_test_field = get_post_meta($film->ID, $prefix.'_some_test_field',true);
					if (!empty($some_test_field)) {
						?> <p> <b>some test field:</b> <?php echo $some_test_field; ?></p> <?php
					}

					?>

					<p> <b>price:</b>  <?php echo $film_product->get_price(); ?> </p>
					<b><a style="color:blue;" href="<?php echo get_home_url(); ?>/checkout/?add-to-cart=<?php echo $film->ID; ?>&quantity=1">Add to cart</a></b>

					</div>

					<?php

				}

			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->


<style type="text/css">
	.item{
		width:100%;
		background: #f5f5f5;
		margin-top: 50px;
	}	
</style>

<?php get_footer();
