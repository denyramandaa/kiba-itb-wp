<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kiba_itb
 */
$taxonomy = get_queried_object();
get_header();
?>
	<?php if ( have_posts() ) : ?>
		<!-- start portofolio -->
        <section class="heading w-full mt-24 lg:mt-40">
            <h2 class="font-heading font-bold text-4xl mb-6 text-center"><?= $taxonomy->name ?></h2>
        </section>
        <!-- end portofolio -->
        
        <input type="text" value="<?= $taxonomy->name ?>" ref="authorName" hidden>

        <!-- start portofolio -->
        <section class="portofolio w-full lg:max-w-7xl mx-auto pt-16 flex justify-center items-center flex-wrap mb-24">
            <div class="masonry w-full lg:px-6">
                <div class="masonry-item" v-for="(item, key) in portofolioByAuthor" :key="key">
                    <a :href="item.url"><img :src="item.thumb" :alt="item.author" class="masonry-content"></a>
                    <a :href="item.url" class="masonry-desc">{{ item.author }}</a>
                </div>
            </div>
            <button v-if="seeMoreIdxAuthor !== pageLengthAuthor-1" class="font-text text-lg bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-16" @click="seeMoreAuthorPost()">
                See More
            </button>
        </section>
        <!-- end portofolio -->
	<?php
 	else :
		get_template_part( 'template-parts/content', 'none' );
	endif; 

get_footer();
