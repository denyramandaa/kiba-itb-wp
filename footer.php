<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kiba_itb
 */

?>

	<!-- start footer -->
	<footer class="w-full py-12 px-6">
		<div class="w-full lg:max-w-7xl mx-auto flex flex-wrap lg:flex-nowrap">
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
			<div class="listing w-full lg:w-1/3 flex flex-wrap items-center mb-8 lg:mr-6">
				<img class="footer--image" src="<?php the_field('campus_logo'); ?>" alt="logo-itb">
				<p class="font-body font-bold mt-4 lg:mt-8"><?php the_field('campus_info'); ?></p>
			</div>
			<div class="listing w-full lg:w-1/3 flex flex-wrap items-center mb-8 lg:mr-6">
				<img class="footer--image" src="<?php the_field('kiba_logo'); ?>" alt="logo-itb">
				<p class="font-body mt-4 lg:mt-8"><?php the_field('kiba_info'); ?></p>
			</div>
			<div class="listing w-full lg:w-1/3 flex flex-col items-start justify-center">
				<?php foreach( get_field('media_social') as $key => $value ): ?>
				<div class="flex items-center justify-center mb-4 lg:mb-8">
					<img src="<?php echo $value['media_social_icon'] ?>" alt="instagram">
					<p class="font-body font-bold ml-4"><?php echo $value['media_social_name'] ?></p>
				</div>
				<?php endforeach; ?>
			</div>
            <?php endwhile; wp_reset_postdata(); ?>
		</div>
	</footer>
	<!-- end footer -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/vue.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/swiper-bundle.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/app.js"></script>
</body>
</html>
