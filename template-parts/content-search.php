<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package space_material
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mt-3r' ); ?>>
	<div class="card-body">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title card-title"><a href="%s" rel="bookmark" class="text-dark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta text-muted">
				<?php space_material_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php space_material_post_thumbnail(); ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>
	<!-- /.card-body -->

	<?php if ( 'post' === get_post_type() ) : ?>
		<footer class="entry-footer card-footer text-muted">
			<?php space_material_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
