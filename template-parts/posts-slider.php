<?php

$featured_post_ids = get_theme_mod( 'featured_ids' );
$featured_count = get_theme_mod( 'featured_count', 5 );

if( $featured_post_ids && $featured_post_ids[0]!= '' ) {
	$args = array( 'post_type' => array('post'), 'post__in' => $featured_post_ids, 'showposts' => $featured_count, 'orderby' => 'post__in', 'ignore_sticky_posts' => true );
} else {
	$args = array( 'post_type' => array('post'), 'showposts' => $featured_count, 'ignore_sticky_posts' => true );
}

$featured_query = new WP_Query( $args );

?>

<?php if ( $featured_query->have_posts() ) : ?>
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
       
        <div class="carousel-indicators">
            <?php $post_counter = 0; ?>
            <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
           
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo esc_attr( $post_counter ); ?>" class="<?php if ( $post_counter === 0 ) : echo "active"; endif; ?>" aria-current="true" aria-label="Slide 1">
                </button>
            
            <?php $post_counter++; ?>
            <?php endwhile; ?>
        </div>


        <div class="carousel-inner">
            <div class="overlay"></div>
                <?php $post_counter = 0; ?>
                <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                    <?php
                        $feat_image = get_template_directory_uri() . '/assets/images/default.jpg';
                        $feat_img_alt = '';
                        if( has_post_thumbnail() ) {
                            $get_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                            $feat_image = $get_feat_image[0];
                            $feat_img_alt = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
                        }
                        if ( $feat_img_alt === '' ) {
                            $feat_img_alt = get_the_title();
                        }
                    ?>
                <div class="carousel-item <?php if ( $post_counter === 0 ) : echo "active"; endif; ?> ">
                     <div class="overlay"></div>
                    <img class="d-block w-100 rounded" src="<?php echo esc_url( $feat_image ); ?>" alt="<?php echo esc_attr( $feat_img_alt ); ?>">
                    <div class="carousel-caption d-none d-md-flex align-items-end">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php the_title(); ?></h5>
                            <p><?php echo esc_html( space_material_get_short_excerpt( 20 ) ); ?></p>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-warning btn-sm"><?php esc_html_e( 'Continue Reading', 'space-material' ); ?> <small class="fas fa-angle-right"></small></a>
                        </div>
                    </div>
                </div>
                    <?php $post_counter++; ?>
                <?php endwhile; ?>
        </div>  


        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php esc_html_e( 'Previous', 'space-material' ); ?></span>
        </button>
          
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php esc_html_e( 'Next', 'space-material' ); ?></span>
        </button>
    </div>
<?php endif; ?>
