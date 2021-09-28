<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kiba_itb
 */

get_header();
?>
	<?php if ( have_posts() ) : ?>
		<!-- start heading -->
		<section class="heading w-full mt-24 lg:mt-40">
			<h2 class="font-heading font-bold text-4xl mb-6 text-center px-4"><?= str_replace("Archives: ", "", get_the_archive_title()); ?></h2>
		</section>
		<!-- end heading -->

        <!-- start link -->
        <section class="link w-full pt-12 flex items-center justify-center">
			<?php 
				$loop = new WP_Query( array (
					'post_type' => 'footer_setting', 
					'order_by' => 'post_id', 
					'order' => 'DESC', 
					'posts_per_page' => 1,
					'post_status' => 'publish'
				));
				while($loop->have_posts()) : $loop->the_post();
			?>
            <a href="<?php the_field('link_shop') ?>" class="no-underline bg-gray-200 rounded-xl font-bold py-2 px-12" target="_blank"><?php the_field('label_shop') ?></a>
			<?php endwhile; wp_reset_postdata(); ?>
        </section>
        <!-- end link -->
		<section class="work w-full lg:max-w-7xl mx-auto pt-12 flex justify-center items-center flex-wrap relative px-4 pb-24 lg:pb-40">
			<div class="w-full flex justify-start items-center flex-wrap">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					<!-- start work -->
						<div class="w:full lg:w-1/2 pb-8 lg:px-3 listing-card">
							<div class="no-underline">
								<div class="flex justify-center">
									<div class="w-1/2">
										<div class="w-full box-ratio bg-cover bg-center" style="background-image: url('<?= the_field('product_image') ?>')"></div>
									</div>
									<div class="w-1/2 bg-white p-4 content-between flex flex-wrap h-auto">
										<div>
											<h4 class="font-text font-bold"><?= the_field('product_name') ?></h4>
											<p class="mt-2"><?= the_field('product_description') ?></p>
										</div>
										<p>{{ convertToRupiah(<?= the_field('product_price') ?>) }}</p>
									</div>
								</div>
							</div>
						</div>
					<!-- end work -->
				<?php endwhile; ?>
			</div>
			<div class="navigation--post w-full flex mt-12 lg:mt-16 items-center justify-center">
				<?php
				the_posts_pagination( array(
					'mid_size'=>3,
					'prev_text' => _( '<'),
					'next_text' => _( '>'),
				) );
			?>
			</div>
		</section>
	<?php
 	else :
		get_template_part( 'template-parts/content', 'none' );
	endif; 

get_footer();
