<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package space_material
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mt-3r' ); ?>>
	<div class="card-body">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title h2">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<?php space_material_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'space-material' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	<!-- /.card-body -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer card-footer text-muted">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'space-material' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
