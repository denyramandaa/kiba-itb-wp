<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kiba_itb
 */

get_header();
?>

	<!-- start content -->
	<section class="content w-full mt-24 lg:mt-32 max-w-xl mx-auto px-4 mb-32">
		<?php kiba_itb_post_thumbnail(); ?>
		<h2 class="text-4xl font-bold font-title"><?= get_the_title(); ?></h2>
		<div class="content">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();

				// the_post_navigation(
				// 	array(
				// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'kiba_itb' ) . '</span> <span class="nav-title">%title</span>',
				// 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'kiba_itb' ) . '</span> <span class="nav-title">%title</span>',
				// 	)
				// );

			endwhile; // End of the loop.
			?>
		</div>
	</section>

<?php
get_footer();
