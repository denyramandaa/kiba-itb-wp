<?php
/*
    Template Name: Home Page
*/

get_header();
$homepage_slider = get_field('homepage_slider');
$post_type_awards = get_post_type_object( 'awards' );
?>

    <!-- start jumbotron -->
    <section class="jumbotron w-full lg:max-w-7xl mx-auto pt-16 lg:pt-40 flex items-center justify-center">
        <div class="relative w-full px-6" @mouseenter="swiperJumbotron.autoplay.stop()" @mouseleave="swiperJumbotron.autoplay.start()">
            <div class="swiper">
                <div class="swiper__inner swiper--jumbotron">
                    <div class="swiper-wrapper">
                        <?php foreach( $homepage_slider as $key => $value ): ?>
                        <div class="swiper-slide w-full flex flex-wrap">
                            <?php if($value['slider_full_banner'] === false) : ?>
                                <div class="w-full lg:w-1/2 pr-8">
                                    <h2 class="font-bold text-4xl mb-4"><?= $value['slider_title'] ?></h2>
                                    <p class="font-bold text-lg mb-4"><?= $value['slider_subtitle'] ?></p>
                                    <p class="text-base">
                                        <?= $value['slider_description'] ?>
                                        <?php if(!empty($value['slider_url'])) : ?>
                                            <a href="<?php echo $value['slider_url'] ?>" target="_blank">Read more</a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="w-full lg:w-1/2">
                                    <img src="<?php echo $value['slider_image'] ?>" alt="image">
                                </div>
                            <?php else : ?>
                            <div class="w-full">
                                <a href="<?php echo $value['full_banner_url'] ?>" target="_blank">
                                    <img src="<?php echo $value['slider_image'] ?>" alt="image">
                                </a>
                            </div>
                            <?php endif; ?>
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
            <div class="masonry-item" v-for="(item, key) in portfolio" :key="key">
                <a :href="item.url"><img :src="item.thumb" :alt="item.author" class="masonry-content"></a>
                <a :href="item.url" class="masonry-desc">{{ item.author }}</a>
            </div>
        </div>
        <a href="<?= get_post_type_archive_link( 'portfolio' ); ?>" class="font-text text-lg mt-16">See Portofolio Directory</a>
    </section>
    <!-- end portofolio -->

    <hr class="my-12 lg:my-16">

    <!-- start class -->
    <section class="class w-full lg:max-w-7xl mx-auto">
        <div class="flex pb-6 justify-between items-center px-4">
            <h3 class="font-heading font-bold"><?= get_cat_name( get_cat_ID( 'class' ) ) ?></h3>
            <a href="<?= get_category_link( get_cat_ID( 'class' ) ) ?>">View All</a>
        </div>
        <div class="flex justify-start items-start flex-wrap lg:flex-nowrap lg:px-4">
            <?php 
                $class = new WP_Query( array ('post_type' => 'post', 'order_by' => 'post_id', 'order' => 'DESC', 'category_name' => 'class', 'posts_per_page' => 4, 'post_status' => 'publish'));
                while($class->have_posts()) : $class->the_post();
            ?>
            <div class="listing w-full lg:w-1/4 mb-4 lg:mb-0 lg:mr-4">
                <a href="<?= get_permalink() ?>" class="block no-underline hover:underline">
                    <div class="w-full horizontal-ratio bg-cover bg-center" style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></div>
                    <p class="font-body font-bold mt-6 text-center px-4 lg:px-0"><?= get_the_title(); ?></p>
                </a>
                <hr class="my-8 mx-4 lg:mx-0">
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <!-- end class -->

    <hr class="my-12 lg:my-16">

    <!-- start articles -->
    <section class="class w-full lg:max-w-7xl mx-auto">
        <div class="flex pb-6 justify-between items-center px-4">
            <h3 class="font-heading font-bold"><?= get_cat_name( get_cat_ID( 'articles' ) ) ?></h3>
            <a href="<?= get_category_link( get_cat_ID( 'articles' ) ) ?>">View All</a>
        </div>
        <div class="flex justify-start items-center flex-wrap lg:flex-nowrap px-4">
            <?php 
            $articles = new WP_Query( array ('post_type' => 'post', 'order_by' => 'post_id', 'order' => 'DESC', 'category_name' => 'articles', 'posts_per_page' => 3, 'post_status' => 'publish'));
            while($articles->have_posts()) : $articles->the_post();
            ?>
            <div class="listing w-full lg:w-1/3 mb-6 lg:mb-0 lg:mr-4">
                <a href="<?= get_permalink() ?>" class="block no-underline">
                    <div class="flex justify-start items-start lg:justify-center lg:items-center">
                        <div class="w-1/2">
                            <div class="w-full box-ratio bg-cover bg-center" style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></div>
                        </div>
                        <div class="w-1/2 flex flex-wrap items-center p-0 lg:p-4 ml-2 lg:ml-0">
                            <p class="font-body font-bold mb-1 w-full"><?= get_the_title(); ?></p>
                            <p class="font-body w-full"><?= get_the_date( 'j M Y' ); ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <!-- end articles -->

    <!-- start awards and research -->
    <section class="awards-and-research w-full lg:max-w-7xl mx-auto pt-12 lg:pt-24 flex flex-wrap px-4">
        <div class="awards w-full lg:w-1/2">
            <?php 
            $awards = new WP_Query( array ('post_type' => 'awards', 'order_by' => 'post_id', 'order' => 'DESC', 'posts_per_page' => 1, 'post_status' => 'publish'));
            while($awards->have_posts()) : $awards->the_post();
            ?>
            <h3 class="font-heading font-bold mb-6"><?= $post_type_awards->labels->name; ?></h3>
            <a href="<?= get_permalink() ?>"><div class="w-full horizontal-ratio bg-cover bg-center" style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></div></a>
            <a href="<?= get_permalink() ?>" class="font-body font-bold mt-4 no-underline block"><?= get_the_title(); ?></a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="research w-full lg:w-1/2 lg:pl-24 mt-12 lg:mt-0">
            <h3 class="font-heading font-bold mb-6"><?= get_cat_name( get_cat_ID( 'research' ) ) ?></h3>
            <div class="flex flex-wrap">
                <?php 
                $research = new WP_Query( array ('post_type' => 'post', 'order_by' => 'post_id', 'order' => 'DESC', 'category_name' => 'research', 'posts_per_page' => 3, 'post_status' => 'publish'));
                while($research->have_posts()) : $research->the_post();
                ?>
                <div class="w-full">
                    <a href="<?= get_permalink() ?>" class="no-underline block hover:underline pb-4 lg:p-4"><?= get_the_title(); ?></a>
                    <hr class="pb-4 lg:pb-0">
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="flex justify-end mt-4 lg:mt-8">
                <a href="<?= get_category_link( get_cat_ID( 'research' ) ) ?>">View All</a>
            </div>
        </div>
    </section>
    <!-- end awards and research -->

    <!-- start partnership -->
    <section class="partnership w-full lg:max-w-7xl mx-auto pt-12 lg:pt-24 px-4 lg:px-0 mb-24">
        <h3 class="font-heading font-bold mb-12 text-center">In Partnership with</h3>
        <div class="flex justify-evenly items-center flex-wrap">
            <?php 
            $partners = new WP_Query( array ('post_type' => 'partnership', 'order_by' => 'post_id', 'order' => 'DESC', 'post_status' => 'publish'));
            while($partners->have_posts()) : $partners->the_post();
            ?>
                <img class="mb-8 mx-4 partnership-img" src="<?php the_field('partnership_image') ?>" alt="<?php the_field('partnership_name') ?>">
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <!-- end partnership -->
	
<?php
get_footer();
