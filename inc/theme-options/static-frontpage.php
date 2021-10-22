<?php

space_material_Kirki::add_section( 'wp_bp_frontpage', array(
    'title'          => esc_html__( 'Static Frontpage', 'space-material' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

if( class_exists( 'Kirki' ) ) {
    function space_material_move_header_bg_image( $wp_customize ) {
        $wp_customize->get_control( 'header_image' )->section = 'wp_bp_frontpage';
    }
    add_action( 'customize_register', 'space_material_move_header_bg_image' );
}


space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'front_cover_title',
	'label'    => esc_html__( 'Cover Title', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'text',
    'default'  => get_bloginfo( 'name' ),
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'front_cover_lead',
	'label'    => esc_html__( 'Cover Lead', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'text',
    'default'  => get_bloginfo( 'description' ),
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'front_cover_btn_text',
	'label'    => esc_html__( 'Cover Button Text', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'text',
    'default'  => '',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'front_cover_btn_link',
	'label'    => esc_html__( 'Cover Button Link', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'text',
    'default'  => '',
) );


space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'featured_page_1',
	'label'    => esc_html__( '1st Featured Page', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'dropdown-pages',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'featured_page_2',
	'label'    => esc_html__( '2nd Featured Page', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'dropdown-pages',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'featured_page_3',
	'label'    => esc_html__( '3rd Featured Page', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'dropdown-pages',
) );


space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'show_main_content',
	'label'    => esc_html__( 'Show Main Content', 'space-material' ),
	'section'  => 'wp_bp_frontpage',
	'type'     => 'checkbox',
    'default'  => 1
) );
