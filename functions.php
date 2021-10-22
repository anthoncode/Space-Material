<?php
/**
 * Space Material functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package space_material
 */

if ( ! function_exists( 'space_material_setup' ) ) :
	function space_material_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'space-material', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Enable Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'status', 'quote', 'link' ) );

		// Enable support for woocommerce.
		add_theme_support( 'woocommerce' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'space-material' ),
		) );

		// Switch default core markup for search form, comment form, and comments
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'space_material_custom_background_args', array(
			'default-color' => 'f8f9fa',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'space_material_setup' );


/*function Space_register_custom_widgets() {
    register_widget( 'Space_Widget_Recent_Posts' );
	}
	add_action( 'widgets_init', 'Space_register_custom_widgets' );*/

function Space_widget_recent_posts () {
	register_widget( 'Space_Themes_Widget_Recent_Posts' );

}
add_action( 'widgets_init', 'Space_widget_recent_posts' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function space_material_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'space_material_content_width', 800 );
}
add_action( 'after_setup_theme', 'space_material_content_width', 0 );


// Typography Options
global $typography_options;
$typography_options = array(
	'sizes'  => array(
		'6px'  => '6px',
		'10px' => '10px',
		'12px' => '12px',
		'14px' => '14px',
		'15px' => '15px',
		'16px' => '16px',
		'18px' => '18px',
		'20px' => '20px',
		'24px' => '24px',
		'28px' => '28px',
		'32px' => '32px',
		'36px' => '36px',
		'42px' => '42px',
		'48px' => '48px', 
	),
	/*'faces'  => array(
		'arial'         => 'Arial',
		'verdana'       => 'Verdana, Geneva',
		'segoe'       	=> 'Segoe UI',
		'roboto'       	=> 'Roboto',
		'noto'			=> 'Noto Sans',
		'lato'			=> 'Lato',
		'noto'			=> 'Noto Sans',
		'poppins'		=> 'Poppins',
	),*/
	'styles' => array(
		'normal' => 'Normal',
		'bold'   => 'Bold',
	),
	'color'  => true,
);


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function space_material_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'space-material' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'space-material' ),
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title h5">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'space-material' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'space-material' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6 text-warning">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'space-material' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'space-material' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6 text-warning">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'space-material' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'space-material' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6 text-warning">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'space-material' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'space-material' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'space_material_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function space_material_scripts() {

	wp_enqueue_style( 'space', get_template_directory_uri() . '/assets/css/space-material.min.css', array(), 'v1.1', 'all' );

	/*wp_enqueue_style( 'space-material-style', get_stylesheet_uri(), array(), '1.0.2', 'all' );*/

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'space_material_scripts' );

/**
 * Scripts JS footer.
 */
function space_material_js() {
	wp_enqueue_script( 'space-all', get_template_directory_uri() . '/assets/js/space-material-all.min.js', array(), '1.1', true );
}
add_action('wp_enqueue_scripts','space_material_js');

/**
 * Registers an editor stylesheet for the theme.
 */
function space_material_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'space_material_add_editor_styles' );


// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

// Implement the Custom Comment feature.
require get_template_directory() . '/inc/custom-comment.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Custom Navbar
require get_template_directory() . '/inc/custom-navbar.php';

// Customizer additions.
require get_template_directory() . '/inc/tgmpa/tgmpa-init.php';

// Use Kirki for customizer API
require get_template_directory() . '/inc/theme-options/add-settings.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';


require get_template_directory() . '/inc/extras.php';



// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

//customize theme
if ( ! function_exists( 'of_get_option' ) ) :
	function of_get_option( $name, $default = false ) {

		$option_name = '';
		// Get option settings from database
		$options = get_option( 'spacematerial' );

		// Return specific option
		if ( isset( $options[ $name ] ) ) {
			return $options[ $name ];
		}

		return $default;
	}
endif;

// reducir parrafos
function custom_excerpt_length( $length ) {
	return 20;
	}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//post relation
 function b_after_content($content) { 
    
    if ( !is_singular('post') ) return $content;	
	
	$cad			= "";
	$template_li 	= '<div class="col">
							<div class="card mb-4">
								<a class="thumb_rel" href="{url}">{thumb}</a>
								<div class="card-body">
									
									<a class="card-title h6" href="{url}">{title}</a>
								</div>
							</div>
						</div>';

	$template_rel	= '<div class="row">
							{list}
						</div>';

	$terms = get_the_terms( get_the_ID(), 'post_tag');
    $categ = array();
    
    if ( $terms )
    {
    	foreach ($terms as $term) 
    	{
    		$categ[] = $term->term_id;
    	}
    }
    else{
    	return $content;
    }

     $loop   = new WP_QUERY(array(
                    'tag__in'           => $tags,
                    'posts_per_page'    => 2,
                    'post__not_in'      =>array(get_the_ID()),
                    'orderby'           =>'asc'
                    ));

    if ( $loop->have_posts() )
    {

    	while ( $loop->have_posts() )
    	{
    		$loop->the_post();

    		$search	 = Array('{url}','{thumb}','{title}');
	  		$replace = Array(get_permalink(),get_the_post_thumbnail(),get_the_title());
    	
    		$cad .= str_replace($search,$replace, $template_li);
    	}

    	if ( $cad ) 
    	{
		  	$content .= str_replace('{list}', $cad, $template_rel);
    	}

    }
   	wp_reset_query();

    return $content;
}


//post views
function get_post_views($postID, $only_number = false, $only_text = false) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        if($only_number == true && $only_text == false){
            return "0";
        } else if($only_number == false && $only_text == true){
            return "0 ".__( 'View', 'space-material' );
        } else { // with html
            return '<div class="views-wrap">
                <span class="views-icon icon-eye"></span>
                <span class="views-label">0</span>
            </div>';
        }
    }

    if($only_number == true && $only_text == false){
        return $count; 
    } else if($only_number == false && $only_text == true){
        return $count.' '.__( 'Views', 'space-material' ); 
    } else { // with html
        return '<div class="views-wrap align-self-center">
            <span class="views-icon icon-eye"></span>
            <span class="views-label">'.$count.'</span>
        </div>';
    }
}

function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
































// Updated Recent Posts Widget with Thumbnails
class Space_Themes_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_recent_entries_thumbs spacematerial-recent-posts-widget',
			'description'                 => __( 'Your site&#8217;s most recent Posts with Thumbnails.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'Space_Themes_Widget_Recent_Posts', __( 'Recent Posts - Space Material' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries_thumbs';

		$this->defaults[ 'plugin_slug' ]		= 'widget_recent_entries_thumbs';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}


		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$show_recent = isset( $instance['show_recent'] ) ? $instance['show_recent'] : false;
		$show_popular = isset( $instance['show_popular'] ) ? $instance['show_popular'] : false;
		$show_comments = isset( $instance['show_comments'] ) ? $instance['show_comments'] : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$no_posts = 0;
		$disabled_posts = 0;
		$active_toggle_recent = "";
		$active_toggle_popular = "";
		$active_toggle_comment = "";

		$active_tab_recent = "";
		$active_tab_popular = "";
		$active_tab_comment = "";

		if($show_recent == true){

			$r = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'order' 			  => 'DESC',
					'orderby' 			  => 'date'
				)
			);
			if ( ! $r->have_posts() ) {
				$no_posts++;
			} else {
				$active_toggle_recent = "active";
				$active_tab_recent = " active show";
			}
		} else {
			$disabled_posts++;
		}

		if($show_popular == true){

			$p = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'order' 			  => 'DESC',
					'orderby' 			  => 'meta_value_num',
					'meta_query'          => array(
                		'relation' => 'OR', 
	                    array(
	                        'key' => 'post_views_count',
	                        'compare' => 'NOT EXISTS',
	                    ),
	                    array(
	                        'key' => 'post_views_count',
	                        'compare' => 'EXISTS',
	                    ),
	                )
				)
			);

			if ( ! $p->have_posts() ) {
				$no_posts++;
			} else {
				if($active_toggle_recent == ""){
					$active_toggle_popular = "active";
					$active_tab_popular = " active show";
				}
			}
		} else {
			$disabled_posts++;
		}

		if($show_comments == true){
			$args_c = array(
				'status' => 'approve',
				'number' => $number,
				'order'  => 'DESC',
				'orderby' => 'date'
			);
			$c = get_comments($args_c);

			if ( count($c) != 0 && !empty($c)) {
				if($active_toggle_recent == "" && $active_toggle_popular == ""){
					$active_toggle_comment = "active";
					$active_tab_comment = "active show";
				}
			} else {
				$no_posts++;
			}
		} else {
			$disabled_posts++;
		}

		if($no_posts == 3){
			return;
		}
		if($disabled_posts == 3){
			return;
		}
		?>


		<?php echo $args['before_widget']; ?>

		<?php 
		if(function_exists('spaceblog_get_option')){
			$spaceblog_example_content = spaceblog_get_option('spaceblog_example_content'); 
		} else{
			$spaceblog_example_content = false;
		}	
		?>

		<?php
		?>
		<!-- spacematerial-recent-posts-wrap -->
		<div class="spacematerial-recent-posts-wrap">
			<?php
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			?>

			<?php if($no_posts == 2 || $disabled_posts == 2){ ?>

			<?php } else { ?>

				<ul class="nav nav-tabs nav-feed-sort lavalamp-wrap spacematerial-recent-posts-ul-toggle">
					<?php if($show_recent == true){ ?>
						<li class=" spacematerial-tab <?php echo $active_toggle_recent; ?>"><a data-toggle="tab" href="#recent-<?php echo $args['widget_id']; ?>"><?php _e('Recent','spacematerial'); ?></a></li>
					<?php } ?>
					<?php //if($show_popular == true){ ?>
						<!-- <li class=" spacematerial-tab <?php //echo $active_toggle_popular; ?>"><a data-toggle="tab" href="#popular-<?php //echo $args['widget_id']; ?>"><?php //_e('Popular','spacematerial'); ?></a></li> -->
					<?php //} ?>
					<?php //if($show_comments == true){ ?>
						<!-- <li class=" spacematerial-tab <?php //echo $active_toggle_comment; ?>"><a data-toggle="tab" href="#comments-<?php //echo $args['widget_id']; ?>"><?php //_e('Comments','spacematerial'); ?></a></li> -->
					<?php //} ?>
				</ul>

			<?php } ?>

			<!-- spacematerial-recent-posts-ul-tabs -->
			<div class="tab-content spacematerial-recent-posts-ul-tabs">

				<?php if($show_recent == true){ ?>
					<div id="recent-<?php echo $args['widget_id']; ?>" class="spacematerial-recent-posts-ul-wrap <?php if($disabled_posts != 2){ ?>tab-pane fade <?php echo $active_tab_recent; ?><?php } ?>">
						<?php if($r->have_posts()){ ?>
							<ul class="spacematerial-recent-posts-ul-inner">
								<?php foreach ( $r->posts as $recent_post ) : ?>
									<?php
									$post_title = get_the_title( $recent_post->ID );
									$post_thumb = get_the_post_thumbnail_url($recent_post->ID);
									$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );

									?>
									<li class="spacematerial-recent-posts-li">

										<?php if(has_post_thumbnail($recent_post->ID)) { ?>
					                        <a href="<?php the_permalink($recent_post->ID); ?>">
					                        	<div class="spacematerial-widget-thumb">
					                        		<!-- recent posts -->
						                        	<?php if($show_thumbnail){ ?>
							                        	<?php echo get_the_post_thumbnail($recent_post->ID, 'thumbnail', array( 'alt' => $title) ); ?>
							                        <?php } ?>
						                        </div>
						                        <div class="spacematerial-widget-content">
					                        	<div class="spacematerial-recent-posts-title"><h6 class="entry-title"><?php echo $title; ?></h6></div>
					                        	<?php if ( $show_date ) { ?>
													<span class="spacematerial-recent-posts-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
												<?php } ?>
												</div>
					                        </a>
					                    <?php } else if($spaceblog_example_content == 1) { ?>
					                        <a href="<?php the_permalink($recent_post->ID); ?>">
					                        	<div class="spacematerial-widget-thumb">
						                        	<?php if($show_thumbnail){ ?>
						                        		<img src="<?php echo esc_url(spaceblog_thumbnails('spaceblog-square')) ?>" alt="<?php the_title_attribute($recent_post->ID) ?>" class="" />
						                        	<?php } ?>
					                        	</div>
					                        	<div class="spacematerial-widget-content">
						                        	<div class="spacematerial-recent-posts-title"><h6 class="entry-title"><?php echo $title; ?></h6></div>
						                        	<?php if ( $show_date ) { ?>
														<span class="spacematerial-recent-posts-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
													<?php } ?>
												</div>
					                        </a>
					                    <?php } else { ?>
					                    	<a href="<?php the_permalink($recent_post->ID); ?>">
						                    	<div class="spacematerial-recent-posts-title"><?php echo $title; ?></div>
						                    	<?php if ( $show_date ) { ?>
													<span class="spacematerial-recent-posts-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
												<?php } ?>
											</a>
					                    <?php } ?>

										

									</li>
								<?php endforeach; ?>
							</ul>
						<?php } else { ?>
							<h6 class=""><?php _e('Not found', 'spacematerial') ?></h6>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if($show_popular == true){ ?>
					<div id="popular-<?php echo $args['widget_id']; ?>" class="spacematerial-recent-posts-ul-wrap <?php if($disabled_posts != 2){ ?>tab-pane fade <?php echo $active_tab_popular; ?><?php } ?>">
						<?php if($p->have_posts()){ ?>
							<ul class="spacematerial-recent-posts-ul-inner">
								<?php foreach ( $p->posts as $recent_post ) : ?>
									<?php
									$post_title = get_the_title( $recent_post->ID );
									$post_thumb = get_the_post_thumbnail_url($recent_post->ID);
									$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );

									?>
									<li class="spacematerial-recent-posts-li">

										<?php if(has_post_thumbnail($recent_post->ID)) { ?>
			                                          <a href="<?php the_permalink($recent_post->ID); ?>">
					                        	<div class="spacematerial-widget-thumb">
						                        	<?php if($show_thumbnail){ ?>
							                        	<?php echo get_the_post_thumbnail($recent_post->ID, 'thumbnail', array( 'alt' => $title) ); ?>
							                        <?php } ?><!-- img popular -->
						                        </div>
						                        <div class="spacematerial-widget-content">
					                        	<div class="spacematerial-recent-posts-title"><h6 class="entry-title"><?php echo $title; ?></h6></div>
					                        	<?php if ( $show_date ) { ?>
													<span class="spacematerial-recent-posts-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
												<?php } ?>
												</div>
					                        </a>
					                    <?php } else if($spaceblog_example_content == 1) { ?>
					                        <a href="<?php the_permalink($recent_post->ID); ?>">
					      						<div class="spacematerial-widget-thumb">
						                        	<?php if($show_thumbnail){ ?>
						                        		<img src="<?php echo esc_url(spaceblog_thumbnails('spaceblog-square')) ?>" alt="<?php the_title_attribute($recent_post->ID) ?>" class="" />
						                        	<?php } ?>
					                        	</div>
					                        	<div class="spacematerial-widget-content">
						                        	<div class="spacematerial-recent-posts-title"><h6 class="entry-title"><?php echo $title; ?></h6></div>
						                        	<?php if ( $show_date ) { ?>
														<span class="spacematerial-recent-posts-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
													<?php } ?>
												</div>
					                        </a>
					                    <?php } else { ?>
					                    	<a href="<?php the_permalink($recent_post->ID); ?>">
						                    	<div class="spacematerial-recent-posts-title"><?php echo $title; ?></div>
						                    	<?php if ( $show_date ) { ?>
													<span class="spacematerial-recent-posts-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
												<?php } ?>
											</a>
					                    <?php } ?>

										

									</li>
								<?php endforeach; ?>
							</ul>
						<?php } else { ?>
							<h6 class=""><?php _e('Not found', 'spacematerial') ?></h6>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if($show_comments == true){ ?>
					<div id="comments-<?php echo $args['widget_id']; ?>" class="spacematerial-recent-posts-ul-wrap <?php if($disabled_posts != 2){ ?>tab-pane fade <?php echo $active_tab_comment; ?><?php } ?>">
						<?php if(count($c) != 0 && !empty($c)){ ?>
							<ul class="spacematerial-recent-posts-ul-inner">
								<?php foreach ( $c as $comment){ ?>

									<?php
									$post_title = $comment->comment_author;
									$post_content = $comment->comment_content;
									$post_thumb = "";
									$author_id = "";
									if(isset($comment->user_id) && !empty($comment->user_id)){
										$post_thumb = get_avatar_url($comment->user_id);
									} else {
										$post_thumb = get_avatar_url($comment->comment_author_email);
									} 

									$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );

									?>
									<li class="spacematerial-recent-posts-li commments-tab">

										<?php if($post_thumb) { ?>
											<?php if($show_thumbnail){ ?>
											<div class="spacematerial-widget-thumb">
					                        	<img src="<?php echo $post_thumb; ?>" alt="<?php echo $post_title; ?>" class="" />
					                        </div><?php } ?>
					                        <div class="spacematerial-widget-content">
					                        	<div class="spacematerial-recent-posts-title"><h6 class="entry-title"><?php the_author_link(); ?></h6></div>
					                        	<div class="spacematerial-recent-posts-content"><?php echo  $post_content; ?></div>
					                        	<?php if ( $show_date ) { ?>
													<span class="spacematerial-recent-posts-date"><?php echo get_comment_date( '', $comment->comment_ID ); ?></span>
												<?php } ?>
					                        </div>
					                    <?php } else { ?>
					                    	<div class="spacematerial-recent-posts-title"><h6 class="entry-title"><?php the_author_link(); ?></h6></div>
					                    	<div class="spacematerial-recent-posts-content"><?php echo  $post_content; ?></div>
					                    	<?php if ( $show_date ) { ?>
												<span class="spacematerial-recent-posts-date"><?php echo get_comment_date( '', $comment->comment_ID ); ?></span>
											<?php } ?>
					                    <?php } ?>

										

									</li>
								<?php } ?>
							</ul>
						<?php } else { ?>	
							<h6 class=""><?php _e('Not found', 'spacematerial') ?></h6>
						<?php } ?>
					</div>
				<?php } ?>

			</div>
			<!-- /spacematerial-recent-posts-ul-tabs -->
		</div>
		<!-- /spacematerial-recent-posts-wrap -->

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_recent'] = isset( $new_instance['show_recent'] ) ? (bool) $new_instance['show_recent'] : false;
		$instance['show_popular'] = isset( $new_instance['show_popular'] ) ? (bool) $new_instance['show_popular'] : false;
		$instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : false;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_recent  = isset( $instance['show_recent'] ) ? (bool) $instance['show_recent'] : true;
		$show_popular = isset( $instance['show_popular'] ) ? (bool) $instance['show_popular'] : false;
		$show_comments = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : false;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_recent ); ?> id="<?php echo $this->get_field_id( 'show_recent' ); ?>" name="<?php echo $this->get_field_name( 'show_recent' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_recent' ); ?>"><?php _e( 'Display post "Recent Posts"?' ); ?></label>
		</p>
		<!-- <p>
			<input class="checkbox" type="checkbox"<?php //checked( $show_popular ); ?> id="<?php //echo $this->get_field_id( 'show_popular' ); ?>" name="<?php //echo $this->get_field_name( 'show_popular' ); ?>" />
			<label for="<?php //echo $this->get_field_id( 'show_popular' ); ?>">
				<?php //_e( 'Display post "Popular Posts"?' ); ?>
			</label>
		</p> -->
		<!-- <p>
			<input class="checkbox" type="checkbox"<?php //checked( $show_comments ); ?> id="<?php //echo $this->get_field_id( 'show_comments' ); ?>" name="<?php //echo $this->get_field_name( 'show_comments' ); ?>" />
			<label for="<?php //echo $this->get_field_id( 'show_comments' ); ?>">
				<?php //_e( 'Display post "Recent Comments"?' ); ?>
			</label>
		</p> -->

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
				<?php _e( 'Display post date?' ); ?>
			</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>">
				<?php _e( 'Display post thumbnail?' ); ?>
			</label>
		</p>

		
		<?php
	}



















}

/**
 * Register widget on init
 */
