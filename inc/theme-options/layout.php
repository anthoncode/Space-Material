<?php

space_material_Kirki::add_section( 'wp_bp_layout', array(
    'title'          => esc_html__( 'Layout Settings', 'space-material' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'container_width',
	'label'    => esc_html__( 'Container Max Width (in px)', 'space-material' ),
	'section'  => 'wp_bp_layout',
	'type'     => 'slider',
    'default'  => 1140,
	'choices'  => array(
		'min'  => '1080',
		'max'  => '1400',
		'step' => '10',
	),
    'output' => array(
		array(
			'element'  => '.container',
			'property' => 'max-width',
			'units'    => 'px',
		),
        array(
			'element'  => '.elementor-section.elementor-section-boxed>.elementor-container',
			'property' => 'max-width',
			'units'    => 'px',
		),
	),
) );

// Header Content Width
space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'header_within_container',
	'label'    => esc_html__( 'Header Content Within Container', 'space-material' ),
	'section'  => 'wp_bp_layout',
	'type'     => 'checkbox',
    'default'  => 0,
) );

// Sticky header
space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'sticky_header',
	'label'    => esc_html__( 'Sticky Header', 'space-material' ),
	'section'  => 'wp_bp_layout',
	'type'     => 'checkbox',
    'default'  => 0,
    'tooltip'  => esc_html__( 'Some browsers may be outdated to support this feature.', 'space-material' ),
) );

// Default Sidebar Position
space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'default_sidebar_position',
	'label'    => esc_html__( 'Default Sidebar Position', 'space-material' ),
    'tooltip'  => esc_html__( 'This can be overwritten on the particular page by using a page template.', 'space-material' ),
	'section'  => 'wp_bp_layout',
	'type'     => 'radio',
    'default'  => 'right',
    'choices'  => array(
        'right' => esc_html__( 'Right', 'space-material' ),
        'left'  => esc_html__( 'Left', 'space-material' ),
        'no'    => esc_html__( 'No Sidebar', 'space-material' ),
    )
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'hide_sidebar_on_mobile',
	'label'    => esc_html__( 'Hide Sidebar On Mobile', 'space-material' ),
	'section'  => 'wp_bp_layout',
	'type'     => 'radio',
    'default'  => 'no',
    'choices' => array(
        'no'  => esc_html__( 'No.', 'space-material' ),
        'yes'  => esc_html__( 'Yes, hide sidebar on small devices.', 'space-material' ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'default_sidebar_position',
            'operator' => '!==',
            'value'    => 'no',
        ),
    ),
) );

// Blog Display
space_material_Kirki::add_field( 'space_material_theme', array(
	'settings'    => 'default_blog_display',
	'label'       => esc_html__( 'Blog Display', 'space-material' ),
    'description' => esc_html__( 'Choose between a full post or an excerpt for the blog and archive pages.', 'space-material' ),
	'section'     => 'wp_bp_layout',
	'type'        => 'radio',
    'default'     => 'excerpt',
    'choices'     => array(
        'excerpt' => esc_html__( 'Post excerpt', 'space-material' ),
        'full'    => esc_html__( 'Full Post', 'space-material' ),
    )
) );
