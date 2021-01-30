<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

if ( ! function_exists( 'colormag_below_header_bar_display' ) ) :

	/**
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_below_header_bar_display() {

		$random_post_icon = get_theme_mod( 'colormag_random_post_in_menu', 0 );
		$search_icon      = get_theme_mod( 'colormag_search_icon_in_menu', 0 );
		?>

		<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
			<div class="inner-wrap clearfix">
				<?php
				if ( 1 == get_theme_mod( 'colormag_home_icon_display', 0 ) ) {
					$home_icon_class = 'home-icon';
					if ( is_front_page() ) {
						$home_icon_class = 'home-icon front_page_on';
					}
					?>

					<div class="<?php echo esc_attr( $home_icon_class ); ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						>
							<i class="fa fa-home"></i>
						</a>
					</div>
				<?php } ?>

				<?php if ( 1 == $random_post_icon || 1 == $search_icon ) { ?>
					<div class="search-random-icons-container">
						<?php
						// Displays the random post.
						if ( 1 == $random_post_icon ) {
							colormag_random_post();
						}

						// Displays the search icon.
						if ( 1 == $search_icon ) {
							?>
							<div class="top-search-wrap">
								<i class="fa fa-search search-top"></i>
								<div class="search-form-top">
									<?php get_search_form(); ?>
								</div>
							</div>
							<?php 
							    // according to the documentation, the functions existance has to be checked here since otherwise the site will badly break with a fatal error at next Polylang update (as WordPress deletes the plugin when updtating it)
								if(function_exists( 'pll_the_languages')) :
									pll_the_languages(array('show_flags' => 1, 'show_names' => 1, 'hide_current' => 1 ) ); 
								endif;
							?>
						<?php } ?>
					</div>
				<?php } ?>

				<p class="menu-toggle"></p>
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'menu-primary-container',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
				} else {
					wp_page_menu();
				}
				?>

			</div>
		</nav>

		<?php

	}

endif;
