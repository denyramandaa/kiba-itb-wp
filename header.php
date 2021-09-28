<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kiba_itb
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'kiba_itb' ); ?></a>


	<!-- start header -->
	<header class="header fixed top-0 left-0 w-full flex justify-center bg-white z-30">
		<div class="header__inner flex justify-between lg:justify-start w-full lg:max-w-7xl mx-auto px-4">
			<div class="header--logo relative">
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
				<h1><a href="<?= home_url() ?>"><img src="<?php the_field('kiba_logo'); ?>" alt="Kiba ITB logo"></a></h1>
				<?php endwhile; ?>
			</div>
			<?php
				wp_nav_menu( array(
					'theme_location'	=> 'primary',
					'container'			=> 'div',
					'container_class'	=> 'header__menu hidden lg:flex justify-center items-center lg:ml-8',
					'menu_class'		=> 'header__menu--list flex'
				) );
			?>
			<div class="header__burger flex justify-center items-center cursor-pointer lg:hidden relative">
				<img v-if="!sideMenuOpen" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/burger.png" alt="burger-icon" @click="sideMenuOpen = true">
				<img v-else src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/close.png" alt="close-icon" @click="sideMenuOpen = false">
			</div>
		</div>
	</header>
	<div class="header__side fixed flex justify-end min-h-screen lg:hidden w-full z-20" :class="{ show : sideMenuOpen }">
		<div class="header__side--overlay absolute w-full h-full" :class="{ show : sideMenuOpen }" @click="sideMenuOpen = false"></div>
		<div class="flex-col w-2/3 bg-white pt-16 relative">
			<?php
				wp_nav_menu( array(
					'theme_location'	=> 'primary',
					'container'			=> 'nav',
					'container_class'	=> 'header__menu flex justify-center items-center flex-col',
					'menu_class'		=> 'header__menu--list w-2/3 text-center relative flex flex-wrap'
				) );
			?>
		</div>
	</div>
	<!-- end header -->
