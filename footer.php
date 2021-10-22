<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package space_material
 */

?>
	<div id="scrolltop"> 
		<a class="top-button icon-arrow-up" href="#top"></a>
	</div>
	<footer  class="page-footer font-small pt-4 mt-5">
		<section id="footer-area" class="footer-widgets text-left">
			<div class="container">
				<div class="row">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<div class="col-md-6 col-sm-12">
							<aside class="widget-area footer-1-area mb-2">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<div class="col-md-6 col-sm-12">
							<aside class="widget-area footer-2-area mb-2">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<div class="col-md-6">
							<aside class="widget-area footer-3-area mb-2">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<div class="col-md-6">
							<aside class="widget-area footer-4-area mb-2">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</aside>
						</div>
					<?php endif; ?>
				</div>
				<!-- /.row -->
			</div>
		</section>

		<div id="colophon" class="footer-copyright text-center py-3">

			<div class="container">
				<div class="site-info">
					<?php echo of_get_option( 'custom_footer_text', 'Blog' ); ?>
					Copyright © <?php echo date("Y") ?>
					<span class="sep"> | </span>
					<a href="https://anthoncode.com/en"><?php printf( esc_html__( 'Theme: %1$s', 'space-material' ), 'Space Material' );?></a>
				</div><!-- .site-info -->
			</div>

		</div>
		<!-- /.container -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->



<?php wp_footer(); ?>

<script type="text/javascript">
	var myCarousel = document.querySelector('#myCarousel')
	var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 6000,
  wrap: false
})
</script>

</body>
</html>
