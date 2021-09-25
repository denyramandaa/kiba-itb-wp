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
		<!-- start portofolio -->
        <section class="heading w-full mt-24 lg:mt-40">
            <h2 class="font-heading font-bold text-4xl mb-6 text-center">Portofolio Directory</h2>
            <div class="bg-gray-200 w-full">
                <div class="w-full lg:max-w-7xl mx-auto flex justify-between items-center py-2 px-4 flex-wrap relative">
                    <div class="flex rounded-3xl bg-white justify-start lg:absolute top-auto left-auto">
                        <div class="bg-gray-400 text-white py-2 px-6 lg:px-8 rounded-3xl cursor-pointer">Year</div>
                        <div class="py-2 px-6 lg:px-8 rounded-3xl cursor-pointer">Project</div>
                    </div>
                    <div class="flex w-1/2 lg:w-full justify-end lg:justify-center items-center">
                        <div class="font-bold mr-2 hidden lg:block">Filter:</div>
                        <div class="inline-block relative w-24 lg:w-32">
                            <select class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                              <option>All</option>
                              <option>Mina</option>
                              <option>NayeonNayeonNayeon</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end portofolio -->

        <!-- start portofolio -->
        <section class="portofolio w-full lg:max-w-7xl mx-auto pt-16 flex justify-center items-center flex-wrap mb-24">
            <div class="masonry w-full lg:px-6">
                <div class="masonry-item" v-for="i in dummyFoto">
                    <a href="work-detail.html"><img :src="i" :alt="i" class="masonry-content"></a>
                </div>
            </div>
            <button class="font-text text-lg bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-16">
                See More
            </button>
        </section>
        <!-- end portofolio -->
	<?php
 	else :
		get_template_part( 'template-parts/content', 'none' );
	endif; 

get_footer();
