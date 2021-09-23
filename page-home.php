<?php
/*
    Template Name: Home Page
*/

get_header();
$homepage_slider = get_field('homepage_slider');
?>

    <!-- start jumbotron -->
    <section class="jumbotron w-full lg:max-w-7xl mx-auto pt-16 lg:pt-40 flex items-center justify-center">
        <div class="relative w-full px-6" @mouseenter="swiperJumbotron.autoplay.stop()" @mouseleave="swiperJumbotron.autoplay.start()">
            <div class="swiper">
                <div class="swiper__inner swiper--jumbotron">
                    <div class="swiper-wrapper">
                        <?php foreach( $homepage_slider as $key => $value ): ?>
                        <div class="swiper-slide w-full flex flex-wrap">
                            <div class="w-full lg:w-1/2 pr-8">
                                <h2 class="font-bold text-4xl mb-4"><?= $value['slider_title'] ?></h2>
                                <p class="font-bold text-lg mb-4"><?= $value['slider_subtitle'] ?></p>
                                <p class="text-base">
                                    <?= $value['slider_description'] ?>
                                    <?php if(!empty($value['slider_url'])) : ?>
                                        <a href="<?php echo $value['slider_url'] ?>">Read more</a>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="w-full lg:w-1/2">
                                <img src="<?php echo $value['slider_image'] ?>" alt="image">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next swiper--jumbotron--next"></div>
            <div class="swiper-button-prev swiper--jumbotron--prev"></div>
            <div class="mt-4 flex items-center justify-center swiper--jumbotron--pagination"></div>
        </div>
    </section>
    <!-- end jumbotron -->

    <!-- start portofolio -->
    <section class="portofolio w-full lg:max-w-7xl mx-auto pt-16 flex justify-center items-center flex-wrap">
        <div class="masonry w-full lg:px-6">
            <div class="masonry-item" v-for="i in dummyFoto">
                <a href="#"><img :src="i" :alt="i" class="masonry-content"></a>
            </div>
        </div>
        <a href="#" class="font-text text-lg mt-16">See Portofolio Directory</a>
    </section>
    <!-- end portofolio -->

    <hr class="my-12 lg:my-16">

    <!-- start class -->
    <section class="class w-full lg:max-w-7xl mx-auto">
        <div class="flex pb-6 justify-between items-center px-4">
            <h3 class="font-heading font-bold">Class</h3>
            <a href="#">View All</a>
        </div>
        <div class="flex justify-center items-center flex-wrap lg:flex-nowrap lg:px-4">
            <div class="listing w-full lg:w-1/4 mb-4 lg:mb-0 lg:mr-4" v-for="i in 4">
                <a href="#" class="block no-underline hover:underline">
                    <div class="w-full horizontal-ratio bg-cover bg-center" :style="{ 'background-image': 'url(' + 'https://unsplash.it/700/480?image='+i + ')' }"></div>
                    <p class="font-body font-bold mt-6 text-center px-4 lg:px-0">Judul Class 90 Huruf Lorem Ipsum Dolor sit Amet Consectetur Adipiscing Elit Maecenas Sempe</p>
                </a>
                <hr class="my-8 mx-4 lg:mx-0">
            </div>
        </div>
    </section>
    <!-- end class -->

    <hr class="my-12 lg:my-16">

    <!-- start articles -->
    <section class="class w-full lg:max-w-7xl mx-auto">
        <div class="flex pb-6 justify-between items-center px-4">
            <h3 class="font-heading font-bold">Articles</h3>
            <a href="<?php echo get_category_link( get_cat_ID( 'articles' ) ) ?>">View All</a>
        </div>
        <div class="flex justify-start items-center flex-wrap lg:flex-nowrap px-4">
            <?php 
            $articles = new WP_Query( array ('post_type' => 'post', 'order_by' => 'post_id', 'order' => 'DESC', 'category_name' => 'articles'));
            while($articles->have_posts()) : $articles->the_post();
            ?>
            <div class="listing w-full lg:w-1/3 mb-6 lg:mb-0 lg:mr-4">
                <a href="<?php echo get_permalink() ?>" class="block no-underline">
                    <div class="flex justify-start items-start lg:justify-center lg:items-center">
                        <div class="w-1/2">
                            <div class="w-full box-ratio bg-cover bg-center" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')"></div>
                        </div>
                        <div class="w-1/2 flex flex-wrap items-center p-0 lg:p-4 ml-2 lg:ml-0">
                            <p class="font-body font-bold mb-1"><?php echo get_the_title(); ?></p>
                            <p class="font-body"><?php echo get_the_date( 'j M Y' ); ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <!-- end articles -->

    <!-- start awards and research -->
    <section class="awards-and-research w-full lg:max-w-7xl mx-auto pt-12 lg:pt-24 flex flex-wrap px-4">
        <div class="awards w-full lg:w-1/2">
            <h3 class="font-heading font-bold mb-6">Awards</h3>
            <div class="w-full horizontal-ratio bg-cover bg-center" :style="{ 'background-image': 'url(' + 'https://unsplash.it/700/480?image='+1 + ')' }"></div>
            <a href="#" class="font-body font-bold mt-4 no-underline block">IMAJINESIA: Judul Awards 150 Huruf Lorem Ipsum Dolor sit Amet Consectetur Adipiscing Elit Maecen Convallis Cursus Eros, vulputate Quismaxim Vivamusian</a>
        </div>
        <div class="research w-full lg:w-1/2 lg:pl-24 mt-12 lg:mt-0">
            <h3 class="font-heading font-bold mb-6">Research</h3>
            <div class="flex flex-wrap">
                <div class="w-full" v-for="i in 3">
                    <a href="#" class="no-underline block hover:underline pb-4 lg:p-4">Judul Research 195 Huruf Lorem Ipsum Dolor sit Amet Consectetur Adipiscing Elit Maecen Convallis Cursus Eros, vulputate Quismaxim Vivamus placerat lectus pellentesque, cursus urna scelerisque qua</a>
                    <hr class="pb-4 lg:pb-0">
                </div>
            </div>
            <div class="flex justify-end mt-4 lg:mt-8">
                <a href="#">View All</a>
            </div>
        </div>
    </section>
    <!-- end awards and research -->

    <!-- start partnership -->
    <section class="partnership w-full lg:max-w-7xl mx-auto pt-12 lg:pt-24 px-4 lg:px-0 mb-24">
        <h3 class="font-heading font-bold mb-12 text-center">In Partnership with</h3>
        <div class="flex justify-evenly items-center flex-wrap">
            <?php 
            $partners = new WP_Query( array ('post_type' => 'partnership', 'order_by' => 'post_id', 'order' => 'DESC'));
            while($partners->have_posts()) : $partners->the_post();
            ?>
                <img class="mb-8 mx-4 partnership-img" src="<?php the_field('partnership_image') ?>" alt="<?php the_field('partnership_name') ?>">
            <?php endwhile; ?>
        </div>
    </section>
    <!-- end partnership -->
	
<?php
get_footer();
