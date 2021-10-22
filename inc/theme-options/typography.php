<?php

space_material_Kirki::add_section( 'wp_bp_typography', array(
    'title'          => esc_html__( 'Typography', 'space-material' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'wp_bp_body_typo',
	'section'  => 'wp_bp_typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Body Typography', 'space-material' ),
    'default'     => array(
		'font-family'    => "-apple-system, BlinkMacSystemFont, 'Ubuntu', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif",
		'variant'        => '',
		'line-height'    => '',
		'letter-spacing' => '',
	),
    'output'      => array(
		array(
			'element' => array( 'body', 'button', 'input', 'optgroup', 'select', 'textarea' ),
		),
	),
) );

space_material_Kirki::add_field( 'space_material_theme', array(
	'settings' => 'wp_bp_heading_typo',
	'section'  => 'wp_bp_typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Heading Typography', 'space-material' ),
    'default'     => array(
		'font-family'    => "-apple-system, BlinkMacSystemFont, 'Ubuntu', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif",
		'variant'        => '500',
		'line-height'    => '',
		'letter-spacing' => '',
	),
    'output'      => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
) );
