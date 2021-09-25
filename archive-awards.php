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
		<section class="work w-full lg:max-w-7xl mx-auto pt-12 flex justify-center items-center flex-wrap relative px-4 pb-24 lg:pb-40">
			<div class="w-full flex justify-start items-center flex-wrap">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					<!-- start work -->
						<div class="w:full lg:w-1/3 pb-6 lg:pr-6 listing-card">
							<a href="<?= get_permalink() ?>" class="no-underline">
								<div class="flex items-center justify-center">
									<div class="w-1/2">
										<div class="w-full box-ratio bg-cover bg-center" style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></div>
									</div>
									<div class="w-1/2 bg-white p-4">
										<h4 class="font-text font-bold"><?= get_the_title(); ?></h4>
										<p class="mt-2"><?= get_the_date( 'j M Y' ); ?></p>
									</div>
								</div>
							</a>
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
