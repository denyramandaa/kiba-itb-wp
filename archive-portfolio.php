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
                <div class="w-full lg:max-w-7xl mx-auto flex justify-center lg:justify-between items-center py-2 px-4 flex-wrap relative">
                    <div class="flex rounded-3xl justify-center items-center lg:items-start lg:justify-start lg:absolute top-auto left-auto">
                        <div class="flex">
                            <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="filterType" value="year" v-model="filterType">
                            <span class="ml-2">Year</span>
                            </label>
                            <label class="inline-flex items-center m-2 lg:ml-6">
                            <input type="radio" class="form-radio" name="filterType" value="project" v-model="filterType">
                            <span class="ml-2">Project</span>
                            </label>
                            <label class="inline-flex items-center m-2 lg:ml-6">
                            <input type="radio" class="form-radio" name="filterType" value="alphabet" v-model="filterType">
                            <span class="ml-2">Alphabetically</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex w-full justify-center items-center mt-2 lg:mt-0">
                        <div class="font-bold mr-2 hidden lg:block">Filter:</div>
                        <div class="inline-block relative w-24 lg:w-32" v-if="filterType === 'year' || filterType === 'project'">
                            <select v-if="filterType === 'year'" class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-model="filterByYear">
                              <option>All</option>
                              <option v-for="(item, idx) in categoriesByYear">{{ item }}</option>
                            </select>
                            <select v-if="filterType === 'project'" class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-model="filterByProject">
                              <option>All</option>
                              <option v-for="(item, idx) in categoriesByProject">{{ item }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <div v-else class="inline-block relative w-24 lg:w-32">
                            <div class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline uppercase relative alpha  cursor-pointer" @click="showAlphaFilter = !showAlphaFilter">{{ pickedAlpha }}</div>
                            <div class="modal-alpha flex flex-wrap p-2" v-if="showAlphaFilter">
                                <div class="flex justify-center items-center w-1/5 uppercase p-2 cursor-pointer alpha-array leading-none" v-for="(alphabet, id) in alphabets" @click="pickAlpha(alphabet)" :class="{ 'active' : alphabet === pickedAlpha }">{{ alphabet }}</div>
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
                <div class="masonry-item" v-for="(item, key) in portfolio" :key="key">
                    <a :href="item.url"><img :src="item.thumb" :alt="item.author" class="masonry-content"></a>
                    <a :href="item.url" class="masonry-desc">{{ item.author }}</a>
                </div>
            </div>
            <button v-if="seeMoreIdx !== pageLength-1" class="font-text text-lg bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-16" @click="seeMore()">
                See More
            </button>
        </section>
        <!-- end portofolio -->
	<?php
 	else :
		get_template_part( 'template-parts/content', 'none' );
	endif; 

get_footer();
