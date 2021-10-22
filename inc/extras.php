<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package spacematerial
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 *
 * @return array
 */
function spacematerial_page_menu_args( $args ) {
	$args['show_home'] = true;

	return $args;
}

add_filter( 'wp_page_menu_args', 'spacematerial_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function spacematerial_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'spacematerial_body_classes' );


// Mark Posts/Pages as Untiled when no title is used
add_filter( 'the_title', 'spacematerial_title' );

function spacematerial_title( $title ) {
	if ( '' == $title ) {
		return 'Untitled';
	} else {
		return $title;
	}
}



// Add Bootstrap classes for table
add_filter( 'the_content', 'spacematerial_add_custom_table_class' );
function spacematerial_add_custom_table_class( $content ) {
	return preg_replace( '/(<table) ?(([^>]*)class="([^"]*)")?/', '$1 $3 class="$4 table table-hover" ', $content );
}


if ( ! function_exists( 'spacematerial_social_icons' ) ) :

	/**
	 * Display social links in footer and widgets
	 *
	 * @package spacematerial
	 */
	function spacematerial_social_icons() {
		if ( has_nav_menu( 'social-menu' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'social-menu',
					'container'       => 'nav',
					'container_id'    => 'menu-social',
					'container_class' => 'social-icons',
					'menu_id'         => 'menu-social-items',
					'menu_class'      => 'social-menu',
					'depth'           => 1,
					'fallback_cb'     => '',
					'link_before'     => '<i class="social_icon"><span>',
					'link_after'      => '</span></i>',
				)
			);
		}
	}
endif;

if ( ! function_exists( 'spacematerial_header_menu' ) ) :
	/**
	 * Header menu (should you choose to use one)
	 */
	function spacematerial_header_menu() {
		// display the WordPress Custom Menu if available
		wp_nav_menu(
			array(
				'menu'            => 'primary',
				'theme_location'  => 'primary',
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
				'menu_class'      => 'nav navbar-nav',
				'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
				'walker'          => new WP_Bootstrap_Navwalker(),
			)
		);
	} /* end header menu */
endif;

if ( ! function_exists( 'spacematerial_footer_links' ) ) :
	/**
	 * Footer menu (should you choose to use one)
	 */
	function spacematerial_footer_links() {
		// display the WordPress Custom Menu if available
		wp_nav_menu(
			array(
				'container'       => '',                              // remove nav container
				'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
				'menu'            => esc_html__( 'Footer Links', 'spacematerial' ),   // nav name
				'menu_class'      => 'nav footer-nav clearfix',      // adding custom nav class
				'theme_location'  => 'footer-links',             // where it's located in the theme
				'before'          => '',                                 // before the menu
				'after'           => '',                                  // after the menu
				'link_before'     => '',                            // before each link
				'link_after'      => '',                             // after each link
				'fallback_cb'     => 'spacematerial_footer_links_fallback', // fallback function
			)
		);
	} /* end spacematerial footer link */
endif;


if ( ! function_exists( 'spacematerial_call_for_action' ) ) :
	/**
	 * Call for action text and button displayed above content
	 */
	function spacematerial_call_for_action() {
		if ( is_front_page() && of_get_option( 'w2f_cfa_text' ) != '' ) {
			echo '<div class="cfa">';
			echo '<div class="container">';
			echo '<div class="col-sm-8">';
			echo '<span class="cfa-text">' . of_get_option( 'w2f_cfa_text' ) . '</span>';
			echo '</div>';
			echo '<div class="col-sm-4">';
			echo '<a class="btn btn-lg cfa-button" href="' . of_get_option( 'w2f_cfa_link' ) . '">' . of_get_option( 'w2f_cfa_button' ) . '</a>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'spacematerial_featured_slider' ) ) :
	/**
	 * Featured image slider, displayed on front page for static page and blog
	 */
	function spacematerial_featured_slider() {
		if ( is_front_page() && of_get_option( 'spacematerial_slider_checkbox' ) == 1 ) {
			echo '<div class="flexslider">';
			echo '<ul class="slides">';

			$count    = of_get_option( 'spacematerial_slide_number' );
			$slidecat = of_get_option( 'spacematerial_slide_categories' );

			$query = new WP_Query(
				array(
					'cat'            => $slidecat,
					'posts_per_page' => $count,
					'meta_query'     => array(
						array(
							'key'     => '_thumbnail_id',
							'compare' => 'EXISTS',
						),
					),
				)
			);
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();

					if ( of_get_option( 'spacematerial_slider_link_checkbox', 1 ) == 1 ) {
						echo '<li><a href="' . get_permalink() . '">';
					} else {
						echo '<li>';
					}

					if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) :
						if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
							$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							$args           = array(
								'resize' => '1920,550',
							);
							$photon_url     = jetpack_photon_url( $feat_image_url[0], $args );
							echo '<img src="' . $photon_url . '">';
						} else {
							echo get_the_post_thumbnail( get_the_ID(), 'activello-slider' );
						}
					endif;

					echo '<div class="flex-caption">';
					if ( get_the_title() != '' ) {
						echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
					}
					if ( get_the_excerpt() != '' ) {
						echo '<div class="excerpt">' . get_the_excerpt() . '</div>';
					}
					echo '</div>';
					echo '</a></li>';
				endwhile;
			endif;
			wp_reset_postdata();
			echo '</ul>';
			echo ' </div>';
		}// End if().
	}
endif;

/**
 * function to show the footer info, copyright information
 */
function spacematerial_footer_info() {
	global $spacematerial_footer_info;
	printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'spacematerial' ), '<a href="http://colorlib.com/" target="_blank" rel="nofollow noopener">Colorlib</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>' );
}


if ( ! function_exists( 'get_spacematerial_theme_options' ) ) {
	/**
	 * Get information from Theme Options and add it into wp_head
	 */
	function get_spacematerial_theme_options() {

		echo '<style type="text/css">';

		if ( of_get_option( 'link_color' ) ) {
			echo 'a, #infinite-handle span, #secondary .widget .post-content a, .entry-meta a {color:' . of_get_option( 'link_color' ) . '}';
		}
		if ( of_get_option( 'link_hover_color' ) ) {
			echo 'a:hover, a:focus, a:active, #secondary .widget .post-content a:hover, #secondary .widget .post-content a:focus, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, #secondary .widget a:hover, #secondary .widget a:focus {color: ' . of_get_option( 'link_hover_color' ) . ';}';
		}
		if ( of_get_option( 'element_color' ) ) {
			echo '.btn-default, .label-default, .flex-caption h2, .btn.btn-default.read-more,button,
              .navigation .wp-pagenavi-pagination span.current,.navigation .wp-pagenavi-pagination a:hover,
              .woocommerce a.button, .woocommerce button.button,
              .woocommerce input.button, .woocommerce #respond input#submit.alt,
              .woocommerce a.button, .woocommerce button.button,
              .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: ' . of_get_option( 'element_color' ) . '; border-color: ' . of_get_option( 'element_color' ) . ';}';

			echo '.site-main [class*="navigation"] a, .more-link, .pagination>li>a, .pagination>li>span, .cfa-button { color: ' . of_get_option( 'element_color' ) . '}';
			echo '.cfa-button {border-color: ' . of_get_option( 'element_color' ) . ';}';
		}

		if ( of_get_option( 'element_color_hover' ) ) {
			echo '.btn-default:hover, .btn-default:focus,.label-default[href]:hover, .label-default[href]:focus, .tagcloud a:hover, .tagcloud a:focus, button, .main-content [class*="navigation"] a:hover, .main-content [class*="navigation"] a:focus, #infinite-handle span:hover, #infinite-handle span:focus-within, .btn.btn-default.read-more:hover, .btn.btn-default.read-more:focus, .btn-default:hover, .btn-default:focus, .scroll-to-top:hover, .scroll-to-top:focus, .btn-default:active, .btn-default.active, .site-main [class*="navigation"] a:hover, .site-main [class*="navigation"] a:focus, .more-link:hover, .more-link:focus, #image-navigation .nav-previous a:hover, #image-navigation .nav-previous a:focus, #image-navigation .nav-next a:hover, #image-navigation .nav-next a:focus, .cfa-button:hover, .cfa-button:focus, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce #respond input#submit.alt:focus, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce input.button.alt:hover, .woocommerce input.button.alt:focus, a:hover .flex-caption h2 { background-color: ' . of_get_option( 'element_color_hover' ) . '; border-color: ' . of_get_option( 'element_color_hover' ) . '; }';
		}
		if ( of_get_option( 'element_color_hover' ) ) {
			echo '.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus-within, .pagination>li>span:hover {color: ' . of_get_option( 'element_color_hover' ) . ';}';
		}
		if ( of_get_option( 'cfa_bg_color' ) ) {
			echo '.cfa { background-color: ' . of_get_option( 'cfa_bg_color' ) . '; } .cfa-button:hover a {color: ' . of_get_option( 'cfa_bg_color' ) . ';}';
		}
		if ( of_get_option( 'cfa_color' ) ) {
			echo '.cfa-text { color: ' . of_get_option( 'cfa_color' ) . ';}';
		}
		if ( of_get_option( 'cfa_btn_color' ) || of_get_option( 'cfa_btn_txt_color' ) ) {
			echo '.cfa-button {border-color: ' . of_get_option( 'cfa_btn_color' ) . '; color: ' . of_get_option( 'cfa_btn_txt_color' ) . ';}';
		}
		if ( of_get_option( 'heading_color' ) ) {
			echo 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .entry-title, .entry-title a {color: ' . of_get_option( 'heading_color' ) . ';}';
		}
		if ( of_get_option( 'nav_bg_color' ) ) {
			echo '.navbar.navbar-default, .navbar-default .navbar-nav .open .dropdown-menu > li > a {background-color: ' . of_get_option( 'nav_bg_color' ) . ';}';
		}
		if ( of_get_option( 'nav_link_color' ) ) {
			echo '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav.spacematerial-mobile-menu > li:hover > a, .navbar-default .navbar-nav.spacematerial-mobile-menu > li:hover > .caret, .navbar-default .navbar-nav > li, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus { color: ' . of_get_option( 'nav_link_color' ) . ';}';
			echo '@media (max-width: 767px){ .navbar-default .navbar-nav > li:hover > a, .navbar-default .navbar-nav > li:hover > .caret{ color: ' . of_get_option( 'nav_link_color' ) . '!important ;} }';
		}
		if ( of_get_option( 'nav_item_hover_color' ) ) {
			echo '.navbar-default .navbar-nav > li:hover > a, .navbar-default .navbar-nav > li:focus-within > a, .navbar-nav > li:hover > .caret, .navbar-nav > li:focus-within > .caret, .navbar-default .navbar-nav.spacematerial-mobile-menu > li.open > a, .navbar-default .navbar-nav.spacematerial-mobile-menu > li.open > .caret, .navbar-default .navbar-nav > li:hover, .navbar-default .navbar-nav > li:focus-within, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > .caret, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {color: ' . of_get_option( 'nav_item_hover_color' ) . ';}';
			echo '@media (max-width: 767px){ .navbar-default .navbar-nav > li.open > a, .navbar-default .navbar-nav > li.open > .caret { color: ' . of_get_option( 'nav_item_hover_color' ) . ' !important; } }';
		}
		if ( of_get_option( 'nav_dropdown_bg' ) ) {
			echo '.dropdown-menu {background-color: ' . of_get_option( 'nav_dropdown_bg' ) . ';}';
		}
		if ( of_get_option( 'nav_dropdown_item' ) ) {
			echo '.navbar-default .navbar-nav .open .dropdown-menu > li > a, .dropdown-menu > li > a, .dropdown-menu > li > .caret { color: ' . of_get_option( 'nav_dropdown_item' ) . ';}';
		}

		if ( of_get_option( 'nav_dropdown_bg_hover' ) ) {
			echo '.navbar-default .navbar-nav .dropdown-menu > li:hover, .navbar-default .navbar-nav .dropdown-menu > li:focus-within, .dropdown-menu > .active {background-color: ' . of_get_option( 'nav_dropdown_bg_hover' ) . ';}';
			echo '@media (max-width: 767px) {.navbar-default .navbar-nav .dropdown-menu > li:hover, .navbar-default .navbar-nav .dropdown-menu > li:focus, .dropdown-menu > .active {background: transparent;} }';
		}
		if ( of_get_option( 'nav_dropdown_item_hover' ) ) {
			echo '.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>.caret, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .dropdown-menu>li:hover>a, .dropdown-menu>li:hover>.caret {color:' . of_get_option( 'nav_dropdown_item_hover' ) . ';}';
			echo '@media (max-width: 767px) {.navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .dropdown-menu > li.active > .caret, .navbar-default .navbar-nav .dropdown-menu > li.open > a, .navbar-default .navbar-nav li.open > a, .navbar-default .navbar-nav li.open > .caret {color:' . of_get_option( 'nav_dropdown_item_hover' ) . ';} }';
		}

		if ( of_get_option( 'nav_dropdown_item_hover' ) ) {
			echo '.navbar-default .navbar-nav .current-menu-ancestor a.dropdown-toggle { color: ' . of_get_option( 'nav_dropdown_item_hover' ) . ';}';
		}
		if ( of_get_option( 'footer_bg_color' ) ) {
			echo '#colophon {background-color: ' . of_get_option( 'footer_bg_color' ) . ';}';
		}
		if ( of_get_option( 'footer_text_color' ) ) {
			echo '#footer-area, .site-info, .site-info caption, #footer-area caption {color: ' . of_get_option( 'footer_text_color' ) . ';}';
		}
		if ( of_get_option( 'footer_widget_bg_color' ) ) {
			echo '#footer-area {background-color: ' . of_get_option( 'footer_widget_bg_color' ) . ';}';
		}
		if ( of_get_option( 'footer_link_color' ) ) {
			echo '.site-info a, #footer-area a {color: ' . of_get_option( 'footer_link_color' ) . ';}';
		}
		if ( of_get_option( 'social_color' ) ) {
			echo '.social-icons li a {background-color: ' . of_get_option( 'social_color' ) . ' !important ;}';
		}
		if ( of_get_option( 'social_footer_color' ) ) {
			echo '#footer-area .social-icons li a {background-color: ' . of_get_option( 'social_footer_color' ) . ' !important ;}';
		}
		global $typography_options;
		$typography = of_get_option( 'main_body_typography' );
		if ( $typography ) {
			if ( isset( $typography['color'] ) ) {
				echo 'body, .entry-content {color:' . $typography['color'] . '}';
			}
			if ( isset( $typography['face'] ) && isset( $typography_options['faces'][ $typography['face'] ] ) ) {
				echo '.entry-content {font-family: ' . $typography_options['faces'][ $typography['face'] ] . ';}';
			}
			if ( isset( $typography['size'] ) ) {
				echo '.entry-content {font-size:' . $typography['size'] . '}';
			}
			if ( isset( $typography['style'] ) ) {
				echo '.entry-content {font-weight:' . $typography['style'] . '}';
			}
		}
		if ( of_get_option( 'custom_css' ) ) {
			echo html_entity_decode( of_get_option( 'custom_css', 'no entry' ) );
		}
		echo '</style>';
	}
}// End if().
add_action( 'wp_head', 'get_spacematerial_theme_options', 10 );



/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function spacematerial_caption( $output, $attr, $content ) {
	if ( is_feed() ) {
		return $output;
	}

	$defaults = array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
	);

	$attr = shortcode_atts( $defaults, $attr );

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ( $attr['width'] < 1 || empty( $attr['caption'] ) ) {
		return $content;
	}

	// Set up the attributes for the caption <figure>
	$attributes  = ( ! empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="thumbnail wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . ( esc_attr( $attr['width'] ) + 10 ) . 'px"';

	$output  = '<figure' . $attributes . '>';
	$output .= do_shortcode( $content );
	$output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}

add_filter( 'img_caption_shortcode', 'spacematerial_caption', 10, 3 );

/**
 * Skype URI support for social media icons
 */
function spacematerial_allow_skype_protocol( $protocols ) {
	$protocols[] = 'skype';

	return $protocols;
}

add_filter( 'kses_allowed_protocols', 'spacematerial_allow_skype_protocol' );



/**
 * Adds the URL to the top level navigation menu item
 */
function spacematerial_add_top_level_menu_url( $atts, $item, $args ) {
	if ( ! wp_is_mobile() && isset( $args->has_children ) && $args->has_children ) {
		$atts['href'] = ! empty( $item->url ) ? $item->url : '';
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'spacematerial_add_top_level_menu_url', 99, 3 );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function _s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}

add_action( 'wp_head', '_s_pingback_header' );
