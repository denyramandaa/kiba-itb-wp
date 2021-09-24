<?php
/*
    Template Name: About Page
*/

get_header();
$about_title = get_field('about_title');
$about_subtitle = get_field('about_subtitle');
$about_descriptions = get_field('about_descriptions');
$about_image = get_field('about_image');
?>
<!-- start about -->
<section class="about w-full lg:max-w-7xl mx-auto pt-16 lg:pt-40 pb-24 lg:pb-40">
    <div class="relative w-full px-4 flex items-center justify-center flex-wrap lg:flex-nowrap">
        <div class="w-full lg:w-1/2 mb-8 lg:mb-0">
            <div class="horizontal-ratio bg-cover bg-center" style="background-image: url('<?= $about_image ?>')"></div>
        </div>
        <div class="w-full lg:w-1/2 lg:ml-24">
            <h2 class="font-heading font-bold text-4xl mb-4 lg:mb-6"><?= $about_title ?></h2>
            <p class="font-text font-bold text-lg mb-4 lg:mb-6"><?= $about_subtitle ?></p>
            <p class="font-text leading-relaxed"><?= $about_descriptions ?></p>
        </div>
    </div>
</section>
<!-- end about -->
<?php
get_footer();
