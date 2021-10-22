<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package space_material
 */

?>

<div class="mt-5">

	<?php space_material_post_thumbnail(); ?>
	
	<div class="card post-2 page type-page status-publish has-post-thumbnail hentry" id="post-<?php the_ID(); ?>" <?php post_class( 'card mt-3r' ); ?>>

	
		<div class="card-body">
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title card-title h2">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title card-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-dark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta text-muted">

					<div class="meta-without-thumb entry-meta-visible">
						<div class="meta-content align-items-start flex-column">
							<div class="d-flex d-flex align-items-center spaceblog-single-meta-wrap">
								<div class="meta-author-thumb">
									<?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?>
								</div>

								<div class="entry-meta-wrapper">
									<div class="meta-author-name mb-0">	
										<?php echo esc_html_e('by') ?>
										<?php the_author_link();?>

										<div class="thumbnail-date">
											<?php echo get_the_date('F j, Y'); ?>
										</div>

									</div>
								</div>
								<div class="single-meta-buttons d-flex justify-content-end align-items-center">

								    <div class="comments-wrap">
								        <span class="comments-icon icon-message-circle"></span>
								        <div class="comments-numbers">
								            <?php comments_number('0', '1', '%'); ?>	
								         </div>
								    </div>

									<?php if(function_exists('get_post_views')) {
										echo set_post_views( get_the_ID() ); 
										echo get_post_views( get_the_ID() );
										
									}?>			   
								</div>
							</div>
						</div>
					</div>


				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->


			<?php if( is_singular() || get_theme_mod( 'default_blog_display', 'excerpt' ) === 'full' ) : ?>
				<div class="entry-content">
					<?php
					the_content( sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'space-material' ),
							array(
								'span' => array(
									'class' => array(),
												),
								)
							),
							get_the_title()
						) );

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'space-material' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			<?php else : ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
					<div class="">
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Continue Reading', 'space-material' ); ?> <small class="fa-facebook"></small></a>
					</div>
				</div><!-- .entry-summary -->
			<?php endif; ?>
		</div>	
		<!-- /.card-body -->

		
	</div>	
</div><!-- #post-<?php the_ID(); ?> -->

<?php if ( 'post' === get_post_type() ) : ?>
			<footer class="footer-post">
				<?php space_material_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>



<!--Card-->
<div class="card mb-4">

    <!--Card content-->
    <div class="card-body">
    	<h5 class="title-avatar mb-4"><?php esc_html_e( 'About ', 'space-material' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a></h5>
    	<div class="author-details">
	        	<div class="author-avatar">
	            <?php echo get_avatar( get_the_author_meta( 'ID' ), '80' ); ?>
	           	</div>
	            <div class="author-desc">
		            <div class="text-left text-md-left ml-md-3 ml-0">
		                <?php the_author_meta('description');?>
		                <?php get_the_author_meta('ID', $post->post_author);?>
		            </div>
	            </div>
	        
        </div>
    </div>
</div>
<!--/.Card-->
<?php
//for use in the loop, list 5 post titles related to first tag on current post
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$first_tag = $tags[0]->term_id;
	$args=array(
	'tag__in' => array($first_tag),
	'post__not_in' => array($post->ID),
	'posts_per_page'=>3,
	'caller_get_posts'=>1
	);
	
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {

	echo '<h3 class="mb-3">';
	echo esc_html_e( 'You may also like...', 'space-material' );
	echo '</h3>';

	echo '<div class="row">';
	while ($my_query->have_posts()) : $my_query->the_post(); ?>

	<div class="col-sm-12 col-md-4">
		<div class="card mb-4">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array(
				'class'  => 'card-img-top img-fluid',//estilo para imagenes index
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );  ?>
			</a>
			
			<div class="card-body">
				<div class="post-cards">
					<a class="card-title h6" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php the_title(); ?></a>
				</div>
			</div>
 		</div>
	</div>

	<?php
		endwhile;
	echo '</div>';
	}
	wp_reset_query();
}
?>
