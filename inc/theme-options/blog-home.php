<?php

space_material_Kirki::add_section( 'blog_home', array(
    'title'          => esc_html__( 'Blog Homepage', 'space-material' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'blog_home_title_1',
	'section'  => 'blog_home',
	'type'     => 'custom',
    'default'  => '<h2 class="wp-bp-region-title first-region-title">' . esc_html__( 'Cover Section', 'space-material' ) . '</h2>',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'blog_display_cover_section',
	'label'    => esc_html__( 'Display Cover Section', 'space-material' ),
	'section'  => 'blog_home',
	'type'     => 'checkbox',
    'default'  => 1,
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings'          => 'blog_cover_title',
	'label'             => esc_html__( 'Cover Title', 'space-material' ),
	'section'           => 'blog_home',
	'type'              => 'text',
    'sanitize_callback' => 'wp_kses_post',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings'          => 'blog_cover_lead',
	'label'             => esc_html__( 'Cover Lead Text', 'space-material' ),
	'section'           => 'blog_home',
	'type'              => 'text',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings'          => 'blog_cover_btn_text',
	'label'             => esc_html__( 'Cover Button Text', 'space-material' ),
	'section'           => 'blog_home',
	'type'              => 'text',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings'          => 'blog_cover_btn_link',
	'label'             => esc_html__( 'Cover Button Link', 'space-material' ),
	'section'           => 'blog_home',
	'type'              => 'text',
) );


space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'blog_home_title_2',
	'section'  => 'blog_home',
	'type'     => 'custom',
    'default'  => '<h2 class="wp-bp-region-title">' . esc_html__( 'Featured Posts Slider', 'space-material' ) . '</h2>',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'blog_display_posts_slider',
	'label'    => esc_html__( 'Display Posts Slider', 'space-material' ),
	'section'  => 'blog_home',
	'type'     => 'checkbox',
    'default'  => 1,
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'featured_count',
	'label'    => esc_html__( 'Number of Posts In Slider', 'space-material' ),
	'section'  => 'blog_home',
	'type'     => 'number',
    'default'  => '5',
    'choices'  => array(
		'min'  => 1,
		'max'  => 10,
		'step' => 1,
	),
) );

if( class_exists( 'Kirki_Helper' ) ) {
    space_material_Kirki::add_field( 'space_material_theme', array(
    	'settings'    => 'featured_ids',
    	'label'       => esc_html__( 'Select Posts', 'space-material' ),
    	'section'     => 'blog_home',
    	'type'        => 'select',
        'multiple'    => 10,
        'choices'     => Kirki_Helper::get_posts( array( 'posts_per_page' => 100, 'post_type' => 'post' ) ),
    ) );
}
