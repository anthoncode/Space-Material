<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package space_material
 */

?>
<!--Grid column-->
<div class="col-md-6 text-left mt-3">
		<!--Card-->
	<div class="card" id="post-<?php the_ID(); ?>">
		<!--Card image-->
		<div class="view">
			<?php space_material_post_thumbnail(); ?>
			<a>
				<div class="mask rgba-white-slight waves-effect waves-light"></div>
			</a>
		</div>
			<!--Card content-->
			<div class="card-body">
					<!--Title-->
					<?php
					if ( is_singular() ) :
						the_title( '<h5 class="card-title">', '</h5>' );
					else :
						the_title( '<h5 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-dark">', '</a></h5>' );
					endif;

					if ( 'post' === get_post_type() ) : ?>

				<div class="entry-meta text-muted">
					<?php //space_material_posted_on(); ?>
				</div>
					<?php
					endif; ?>
					<!-- <h4 class="card-title"><strong>Card title</strong></h4>
					<hr> -->
					<!--Text-->
					<p class="card-text mb-3 text-capitalize">
						<div class="entry-content">
						<?php the_excerpt(); ?>
						</div>
					</p>

					<span class="read-more-wrap-span">
						<a class="read-more-wrap" href="<?php echo esc_url( get_permalink() ); ?>">
						<span class="btns btn-read-more">
							<i class="fas fa-angle-right"></i>
							<span><?php esc_html_e( 'Read More', 'space-material' ); ?></span>
						</span>
						</a>
					</span>

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
										echo get_post_views( get_the_ID() );
									}?>			   
								</div>
							</div>
						</div>
					</div>
	
					
			</div><!--/.Card content-->	
	</div><!--/.Card-->

	
</div><!-- #post-<?php the_ID(); ?> -->
		<!--Grid column-->
