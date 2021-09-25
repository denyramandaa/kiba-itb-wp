<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kiba_itb
 */

$author = get_field('portfolio_author');
$about_image = get_field('about_image');
$about_description = get_field('about_description');
$about_social_link = get_field('about_social_link');
$project_portfolio = get_field('project_portfolio');
get_header();
?>

	<!-- start heading -->
	<section class="heading w-full mt-24 lg:mt-40">
		<h2 class="font-heading font-bold text-4xl mb-6 text-center px-4"><?= $author ?></h2>
		<div class="bg-gray-200 w-full">
			<div class="w-full lg:max-w-7xl mx-auto flex justify-center items-center py-2 px-4 flex-wrap">
				<div class="flex justify-center rounded-3xl bg-white">
					<div class="py-2 px-6 lg:px-8 rounded-3xl cursor-pointer" :class="{ 'bg-gray-400 text-white' : tabWorkDetail == 0 }" @click="tabWorkDetail = 0">Portofolio</div>
					<div class="py-2 px-6 lg:px-8 rounded-3xl cursor-pointer" :class="{ 'bg-gray-400 text-white' : tabWorkDetail == 1 }" @click="tabWorkDetail = 1">About</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end heading -->

	<!-- start work -->
	<section class="work w-full lg:max-w-7xl mx-auto pt-16 flex justify-center items-center flex-wrap relative px-4 pb-24 lg:pb-40" :class="{'hide':tabWorkDetail == 1}">
		<div class="relative px-4 w-full">
			<div class="swiper">
				<div class="swiper__inner swiper--work">
					<div class="swiper-wrapper">
						<?php foreach( $project_portfolio as $key => $value ): ?>
						<div class="swiper-slide w-full">
							<img src="<?= $value['project_portofolio_image'] ?>" alt="<?= $value['project_portfolio_title'] ?>">
							<div class="relative px-4 w-full">
								<h2 class="font-title font-bold text-2xl mt-8"><?= $value['project_portfolio_title'] ?></h2>
								<p class="font-bold"><?= $value['project_portofolio_year'] ?></p>
								<p class="mt-8"><?= $value['project_portfolio_description'] ?></p>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="swiper-button-next swiper--work--next"></div>
			<div class="swiper-button-prev swiper--work--prev"></div>
		</div>
	</section>
	<!-- end work -->

	<!-- start about -->
	<section class="about w-full lg:max-w-7xl mx-auto pt-16 pb-24 lg:pb-40" :class="{'hide':tabWorkDetail == 0}">
		<div class="relative w-full px-4 flex items-start justify-center flex-wrap lg:flex-nowrap">
			<div class="w-full lg:w-1/2 mb-8 lg:mb-0">
				<div class="box-ratio bg-cover bg-center" style="background-image: url('<?= $about_image ?>')"></div>
			</div>
			<div class="w-full lg:w-1/2 lg:ml-24 flex flex-wrap">
				<p class="font-text leading-relaxed"><?= $about_description ?></p>
				<div class="mt-8 lg:mt-12">
					<?= $about_social_link ?>
				</div>
			</div>
		</div>
	</section>
	<!-- end about -->

<?php
get_footer();
