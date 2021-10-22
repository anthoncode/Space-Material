<?php
/**
 * spacematerial Theme Customizer
 *
 * @package spacematerial
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function spacematerial_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register', 'spacematerial_customize_register' );

/**
 * Options for spacematerial Theme Customizer.
 */
function spacematerial_customizer( $wp_customize ) {

    /* Main option Settings Panel */
    $wp_customize->add_panel(
        'spacematerial_main_options', array(
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Space Material Options *', 'spacematerial' ),
            'description'    => __( 'Panel to update spacematerial theme options', 'spacematerial' ),
            // Include html tags such as <p>.
            'priority'       => 10,
        // Mixed with top-level-section hierarchy.
        )
    );

    // add "Content Options" section
    $wp_customize->add_section(
        'spacematerial_content_section', array(
            'title'    => esc_html__( 'Content Options', 'spacematerial' ),
            'priority' => 50,
            'panel'    => 'spacematerial_main_options',
        )
    );
    // add setting for excerpts/full posts toggle
    $wp_customize->add_setting(
        'spacematerial_excerpts', array(
            'default'           => 0,
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );
    // add checkbox control for excerpts/full posts toggle
    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial_excerpts', array(
                'label'    => esc_html__( 'Show post excerpts?', 'spacematerial' ),
                'section'  => 'spacematerial_content_section',
                'priority' => 10,
                'type'     => 'epsilon-toggle',
            )
        )
    );*/

    $wp_customize->add_setting(
        'spacematerial_page_comments', array(
            'default'           => 1,
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );
    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial_page_comments', array(
                'label'    => esc_html__( 'Display Comments on Static Pages?', 'spacematerial' ),
                'section'  => 'spacematerial_content_section',
                'priority' => 20,
                'type'     => 'epsilon-toggle',
            )
        )
    );*/

    /* spacematerial Main Options */
    /*$wp_customize->add_section(
        'spacematerial_slider_options', array(
            'title'    => __( 'Slider Options', 'spacematerial' ),
            'priority' => 31,
            'panel'    => 'spacematerial_main_options',
        )
    );
    $wp_customize->add_setting(
        'spacematerial[spacematerial_slider_checkbox]', array(
            'default'           => 0,
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );*/
    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial[spacematerial_slider_checkbox]', array(
                'label'    => esc_html__( 'Check if you want to enable slider', 'spacematerial' ),
                'section'  => 'spacematerial_slider_options',
                'priority' => 5,
                'type'     => 'epsilon-toggle',
            )
        )
    );*/
    $wp_customize->add_setting(
        'spacematerial[spacematerial_slider_link_checkbox]', array(
            'default'           => 1,
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );
    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial[spacematerial_slider_link_checkbox]', array(
                'label'    => esc_html__( 'Uncheck this option to remove the link from the slides', 'spacematerial' ),
                'section'  => 'spacematerial_slider_options',
                'priority' => 6,
                'type'     => 'epsilon-toggle',
            )
        )
    );*/

    // Pull all the categories into an array
    global $options_categories;
    $wp_customize->add_setting(
        'spacematerial[spacematerial_slide_categories]', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'spacematerial_sanitize_slidecat',
        )
    );
    $wp_customize->add_control(
        'spacematerial[spacematerial_slide_categories]', array(
            'label'       => __( 'Slider Category', 'spacematerial' ),
            'section'     => 'spacematerial_slider_options',
            'type'        => 'select',
            'description' => __( 'Select a category for the featured post slider', 'spacematerial' ),
            'choices'     => $options_categories,
        )
    );

    $wp_customize->add_setting(
        'spacematerial[spacematerial_slide_number]', array(
            'default'           => 3,
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'spacematerial[spacematerial_slide_number]', array(
            'label'       => __( 'Number of slide items', 'spacematerial' ),
            'section'     => 'spacematerial_slider_options',
            'description' => __( 'Enter the number of slide items', 'spacematerial' ),
            'type'        => 'text',
        )
    );

    /*$wp_customize->add_section(
        'spacematerial_layout_options', array(
            'title'    => __( 'Layout Options', 'spacematerial' ),
            'priority' => 31,
            'panel'    => 'spacematerial_main_options',
        )
    );
*/

    // Layout options
    /*global $site_layout;
    $wp_customize->add_setting(
        'spacematerial[site_layout]', array(
            'default'           => 'side-pull-left',
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_layout',
        )
    );
    $wp_customize->add_control(
        'spacematerial[site_layout]', array(
            'label'       => __( 'Website Layout Options', 'spacematerial' ),
            'section'     => 'spacematerial_layout_options',
            'type'        => 'select',
            'description' => __( 'Choose between different layout options to be used as default', 'spacematerial' ),
            'choices'     => $site_layout,
        )
    );

    if ( class_exists( 'WooCommerce' ) ) {
        $wp_customize->add_setting(
            'spacematerial[woo_site_layout]', array(
                'default'           => 'full-width',
                'type'              => 'option',
                'sanitize_callback' => 'spacematerial_sanitize_layout',
            )
        );
        $wp_customize->add_control(
            'spacematerial[woo_site_layout]', array(
                'label'       => __( 'WooCommerce Page Layout Options', 'spacematerial' ),
                'section'     => 'spacematerial_layout_options',
                'type'        => 'select',
                'description' => __( 'Choose between different layout options to be used as default for all woocommerce pages', 'spacematerial' ),
                'choices'     => $site_layout,
            )
        );
    }
*/
    $wp_customize->add_setting(
        'spacematerial[element_color]', array(
            'default'           => sanitize_hex_color( '#DA4453' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[element_color]', array(
                'label'       => __( 'Element Color', 'spacematerial' ),
                'description' => __( 'Default used if no color is selected', 'spacematerial' ),
                'section'     => 'spacematerial_layout_options',
                'settings'    => 'spacematerial[element_color]',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[element_color_hover]', array(
            'default'           => sanitize_hex_color( '#ff4c68' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[element_color_hover]', array(
                'label'       => __( 'Element color on hover', 'spacematerial' ),
                'description' => __( 'Default used if no color is selected', 'spacematerial' ),
                'section'     => 'spacematerial_layout_options',
                'settings'    => 'spacematerial[element_color_hover]',
            )
        )
    );


    /* spacematerial Typography Options */
    $wp_customize->add_section(
        'spacematerial_typography_options', array(
            'title'    => __( 'Typography', 'spacematerial' ),
            'priority' => 31,
            'panel'    => 'spacematerial_main_options',
        )
    );
    // Typography Defaults
    $typography_defaults = array(
        'size'  => '14px',
        'face'  => 'Open Sans',
        'style' => 'normal',
        'color' => '#6B6B6B',
    );

    // Typography Options
    global $typography_options;
    $wp_customize->add_setting(
        'spacematerial[main_body_typography][size]', array(
            'default'           => $typography_defaults['size'],
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_typo_size',
        )
    );
    $wp_customize->add_control(
        'spacematerial[main_body_typography][size]', array(
            'label'       => __( 'Main Body Text', 'spacematerial' ),
            'description' => __( 'Used in p tags', 'spacematerial' ),
            'section'     => 'spacematerial_typography_options',
            'type'        => 'select',
            'choices'     => $typography_options['sizes'],
        )
    );
    /*$wp_customize->add_setting(
        'spacematerial[main_body_typography][face]', array(
            'default'           => $typography_defaults['face'],
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_typo_face',
        )
    );
    $wp_customize->add_control(
        'spacematerial[main_body_typography][face]', array(
            'section' => 'spacematerial_typography_options',
            'type'    => 'select',
            'choices' => $typography_options['faces'],
        )
    );*/
    $wp_customize->add_setting(
        'spacematerial[main_body_typography][style]', array(
            'default'           => $typography_defaults['style'],
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_typo_style',
        )
    );
    $wp_customize->add_control(
        'spacematerial[main_body_typography][style]', array(
            'section' => 'spacematerial_typography_options',
            'type'    => 'select',
            'choices' => $typography_options['styles'],
        )
    );
    $wp_customize->add_setting(
        'spacematerial[main_body_typography][color]', array(
            'default'           => sanitize_hex_color( '#6B6B6B' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[main_body_typography][color]', array(
                'section' => 'spacematerial_typography_options',
            )
        )
    );
    /*$wp_customize->add_setting(
        'spacematerial[main_body_typography][subset]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );
    $wp_customize->add_control(
        'spacematerial[main_body_typography][subset]', array(
            'label'       => __( 'Font Subset', 'spacematerial' ),
            'section'     => 'spacematerial_typography_options',
            'description' => __( 'Enter the Google fonts subset', 'spacematerial' ),
            'type'        => 'text',
        )
    );*/

    $wp_customize->add_setting(
        'spacematerial[heading_color]', array(
            'default'           => sanitize_hex_color( '#444' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[heading_color]', array(
                'label'       => __( 'Heading Color', 'spacematerial' ),
                'description' => __( 'Color for all headings (h1-h6)', 'spacematerial' ),
                'section'     => 'spacematerial_typography_options',
            )
        )
    );
    $wp_customize->add_setting(
        'spacematerial[link_color]', array(
            'default'           => sanitize_hex_color( '#DA4453' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[link_color]', array(
                'label'       => __( 'Link Color', 'spacematerial' ),
                'description' => __( 'Default used if no color is selected', 'spacematerial' ),
                'section'     => 'spacematerial_typography_options',
            )
        )
    );
    $wp_customize->add_setting(
        'spacematerial[link_hover_color]', array(
            'default'           => sanitize_hex_color( '#f8f9fa' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[link_hover_color]', array(
                'label'       => __( 'Link:hover Color', 'spacematerial' ),
                'description' => __( 'Default used if no color is selected', 'spacematerial' ),
                'section'     => 'spacematerial_typography_options',
            )
        )
    );

    /* spacematerial Header Options */
    $wp_customize->add_section(
        'spacematerial_header_options', array(
            'title'    => __( 'Header', 'spacematerial' ),
            'priority' => 31,
            'panel'    => 'spacematerial_main_options',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[sticky_header]', array(
            'default'           => 0,
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );
    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial[sticky_header]', array(
                'label'       => __( 'Sticky Header', 'spacematerial' ),
                'description' => sprintf( __( 'Check to show fixed header', 'spacematerial' ) ),
                'section'     => 'spacematerial_header_options',
                'type'        => 'epsilon-toggle',
            )
        )
    );*/

    $wp_customize->add_setting(
        'spacematerial[nav_bg_color]', array(
            'default'           => sanitize_hex_color( '#ff4c68' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_bg_color]', array(
                'label'       => __( 'Top nav background color', 'spacematerial' ),
                'description' => __( 'Default used if no color is selected', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );
    $wp_customize->add_setting(
        'spacematerial[nav_link_color]', array(
            'default'           => sanitize_hex_color( '#F5F7FA' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_link_color]', array(
                'label'       => __( 'Top nav item color', 'spacematerial' ),
                'description' => __( 'Link color', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[nav_item_hover_color]', array(
            'default'           => sanitize_hex_color( '#DA4453' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_item_hover_color]', array(
                'label'       => __( 'Top nav item hover color', 'spacematerial' ),
                'description' => __( 'Link:hover color', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[nav_dropdown_bg]', array(
            'default'           => sanitize_hex_color( '#da4453' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_dropdown_bg]', array(
                'label'       => __( 'Top nav dropdown background color', 'spacematerial' ),
                'description' => __( 'Background of dropdown item hover color', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[nav_dropdown_item]', array(
            'default'           => sanitize_hex_color( '#636467' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_dropdown_item]', array(
                'label'       => __( 'Top nav dropdown item color', 'spacematerial' ),
                'description' => __( 'Dropdown item color', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[nav_dropdown_item_hover]', array(
            'default'           => sanitize_hex_color( '#FFF' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_dropdown_item_hover]', array(
                'label'       => __( 'Top nav dropdown item hover color', 'spacematerial' ),
                'description' => __( 'Dropdown item hover color', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[nav_dropdown_bg_hover]', array(
            'default'           => sanitize_hex_color( '#DA4453' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[nav_dropdown_bg_hover]', array(
                'label'       => __( 'Top nav dropdown item background hover color', 'spacematerial' ),
                'description' => __( 'Background of dropdown item hover color', 'spacematerial' ),
                'section'     => 'spacematerial_header_options',
            )
        )
    );

    /* spacematerial Footer Options */
    $wp_customize->add_section(
        'spacematerial_footer_options', array(
            'title'    => __( 'Footer', 'spacematerial' ),
            'priority' => 31,
            'panel'    => 'spacematerial_main_options',
        )
    );
    $wp_customize->add_setting(
        'spacematerial[footer_widget_bg_color]', array(
            'default'           => sanitize_hex_color( '#1b2c51' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[footer_widget_bg_color]', array(
                'label'   => __( 'Footer widget area background color', 'spacematerial' ),
                'section' => 'spacematerial_footer_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[footer_bg_color]', array(
            'default'           => sanitize_hex_color( '#333' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[footer_bg_color]', array(
                'label'   => __( 'Footer background color', 'spacematerial' ),
                'section' => 'spacematerial_footer_options',
            )
        )
    );





/*    $wp_customize->add_setting(
        'spacematerial[footer_bg_color]', array(
            'default'           => sanitize_hex_color( '#1b2c51' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );


*/



    $wp_customize->add_setting(
        'spacematerial[footer_text_color]', array(
            'default'           => sanitize_hex_color( '#cfced6' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[footer_text_color]', array(
                'label'   => __( 'Footer text color', 'spacematerial' ),
                'section' => 'spacematerial_footer_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[footer_link_color]', array(
            'default'           => sanitize_hex_color( '#ff4c68' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[footer_link_color]', array(
                'label'   => __( 'Footer link color', 'spacematerial' ),
                'section' => 'spacematerial_footer_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[custom_footer_text]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_strip_slashes',
        )
    );
    $wp_customize->add_control(
        'spacematerial[custom_footer_text]', array(
            'label'       => __( 'Footer information', 'spacematerial' ),
            'description' => sprintf( __( 'Copyright text in footer', 'spacematerial' ) ),
            'section'     => 'spacematerial_footer_options',
            'type'        => 'textarea',
        )
    );

    /* spacematerial Social Options */
    $wp_customize->add_section(
        'spacematerial_social_options', array(
            'title'    => __( 'Social', 'spacematerial' ),
            'priority' => 31,
            'panel'    => 'spacematerial_main_options',
        )
    );
    /*$wp_customize->add_setting(
        'spacematerial[social_color]', array(
            'default'           => sanitize_hex_color( '#f8f9fa' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[social_color]', array(
                'label'       => __( 'Social icon color', 'spacematerial' ),
                'description' => sprintf( __( 'Default used if no color is selected', 'spacematerial' ) ),
                'section'     => 'spacematerial_social_options',
            )
        )
    );*/

    /*$wp_customize->add_setting(
        'spacematerial[social_footer_color]', array(
            'default'           => sanitize_hex_color( '#ff4c68' ),
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_hexcolor',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'spacematerial[social_footer_color]', array(
                'label'       => __( 'Footer social icon color', 'spacematerial' ),
                'description' => sprintf( __( 'Default used if no color is selected', 'spacematerial' ) ),
                'section'     => 'spacematerial_social_options',
            )
        )
    );

    $wp_customize->add_setting(
        'spacematerial[footer_social]', array(
            'default'           => 0,
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );*/
    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial[footer_social]', array(
                'label'       => __( 'Footer Social Icons', 'spacematerial' ),
                'description' => sprintf( __( 'Check to show social icons in footer', 'spacematerial' ) ),
                'section'     => 'spacematerial_social_options',
                'type'        => 'epsilon-toggle',
            )
        )
    );*/

    /* Academicons */
    $wp_customize->add_setting(
        'spacematerial[academicons]', array(
            'default'           => 0,
            'type'              => 'option',
            'sanitize_callback' => 'spacematerial_sanitize_checkbox',
        )
    );

    /*$wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize, 'spacematerial[academicons]', array(
                'label'       => __( 'Enable Academicons', 'spacematerial' ),
                'description' => sprintf( __( 'Toggle this to ON to enable the usage of Academicons', 'spacematerial' ) ),
                'section'     => 'spacematerial_social_options',
                'type'        => 'epsilon-toggle',
            )
        )
    );*/

    /* Archive pages settings */
    /*$wp_customize->add_section(
            'spacematerial_archive_section', array(
            'title'    => esc_html__( 'Archive Pages', 'spacematerial' ),
            'priority' => 50,
            'panel'    => 'spacematerial_main_options',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[tag_title]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        'spacematerial[tag_title]', array(
            'label'       => __( 'Tag Page Title', 'spacematerial' ),
            'section'     => 'spacematerial_archive_section',
            'description' => __( 'The headline for your tag pages. You can use %s as a placeholder for the tag. Leave empty for default.', 'spacematerial' ),
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[category_title]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        'spacematerial[category_title]', array(
            'label'       => __( 'Category Page Title', 'spacematerial' ),
            'section'     => 'spacematerial_archive_section',
            'description' => __( 'The headline for your category pages. You can use %s as a placeholder for the category. Leave empty for default.', 'spacematerial' ),
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[author_title]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        'spacematerial[author_title]', array(
            'label'       => __( 'Author Page Title', 'spacematerial' ),
            'section'     => 'spacematerial_archive_section',
            'description' => __( 'The headline for your author pages. You can use %s as a placeholder for the author\'s name. Leave empty for default.', 'spacematerial' ),
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[year_title]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        'spacematerial[year_title]', array(
            'label'       => __( 'Year Page Title', 'spacematerial' ),
            'section'     => 'spacematerial_archive_section',
            'description' => __( 'The headline for your year pages. You can use %s as a placeholder for the year. Leave empty for default.', 'spacematerial' ),
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[month_title]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        'spacematerial[month_title]', array(
            'label'       => __( 'Month Page Title', 'spacematerial' ),
            'section'     => 'spacematerial_archive_section',
            'description' => __( 'The headline for your month pages. You can use %s as a placeholder for the month. Leave empty for default.', 'spacematerial' ),
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting(
        'spacematerial[day_title]', array(
            'default'           => '',
            'type'              => 'option',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        'spacematerial[day_title]', array(
            'label'       => __( 'Day Page Title', 'spacematerial' ),
            'section'     => 'spacematerial_archive_section',
            'description' => __( 'The headline for your day pages. You can use %s as a placeholder for the day. Leave empty for default.', 'spacematerial' ),
            'type'        => 'text',
        )
    );*/
}

add_action( 'customize_register', 'spacematerial_customizer' );


/**
 * Sanitzie checkbox for WordPress customizer
 */
function spacematerial_sanitize_checkbox( $input ) {
    if ( 1 == $input ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: colors
 * @package spacematerial
 */
function spacematerial_sanitize_hexcolor( $color ) {
    $unhashed = sanitize_hex_color_no_hash( $color );
    if ( $unhashed ) {
        return '#' . $unhashed;
    }

    return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package spacematerial
 */
function spacematerial_sanitize_nohtml( $input ) {
    return wp_filter_nohtml_kses( $input );
}

/**
 * Adds sanitization callback function: Number
 * @package spacematerial
 */
function spacematerial_sanitize_number( $input ) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package spacematerial
 */
function spacematerial_sanitize_strip_slashes( $input ) {
    return wp_kses_stripslashes( $input );
}

/**
 * Adds sanitization callback function: Sanitize Text area
 * @package spacematerial
 */
function spacematerial_sanitize_textarea( $input ) {
    return sanitize_text_field( $input );
}

/**
 * Adds sanitization callback function: Slider Category
 * @package spacematerial
 */
function spacematerial_sanitize_slidecat( $input ) {
    global $options_categories;
    if ( array_key_exists( $input, $options_categories ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package spacematerial
 */
function spacematerial_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Typography Size
 * @package spacematerial
 */
function spacematerial_sanitize_typo_size( $input ) {
    global $typography_options, $typography_defaults;
    if ( array_key_exists( $input, $typography_options['sizes'] ) ) {
        return $input;
    } else {
        return $typography_defaults['size'];
    }
}

/**
 * Adds sanitization callback function: Typography Face
 * @package spacematerial
 */
function spacematerial_sanitize_typo_face( $input ) {
    global $typography_options, $typography_defaults;
    if ( array_key_exists( $input, $typography_options['faces'] ) ) {
        return $input;
    } else {
        return $typography_defaults['face'];
    }
}

/**
 * Adds sanitization callback function: Typography Style
 * @package spacematerial
 */
function spacematerial_sanitize_typo_style( $input ) {
    global $typography_options, $typography_defaults;
    if ( array_key_exists( $input, $typography_options['styles'] ) ) {
        return $input;
    } else {
        return $typography_defaults['style'];
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function spacematerial_customize_preview_js() {
    wp_enqueue_script( 'spacematerial_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20140317', true );
}

add_action( 'customize_preview_init', 'spacematerial_customize_preview_js' );

/**
 * Add CSS for custom controls
 */
function spacematerial_customizer_custom_control_css() {
    ?>
    <style>
        #customize-control-spacematerial-main_body_typography-size select, #customize-control-spacematerial-main_body_typography-face select, #customize-control-spacematerial-main_body_typography-style select {
            width: 60%;
        }
    </style>
    <?php
}

add_action( 'customize_controls_print_styles', 'spacematerial_customizer_custom_control_css' );

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );

function customizer_custom_scripts() {
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function () {
        /* This one shows/hides the an option when a checkbox is clicked. */
        jQuery('#customize-control-spacematerial-spacematerial_slide_categories, #customize-control-spacematerial-spacematerial_slide_number').hide()
        jQuery('#customize-control-spacematerial-spacematerial_slider_checkbox input').click(function () {
          jQuery('#customize-control-spacematerial-spacematerial_slide_categories, #customize-control-spacematerial-spacematerial_slide_number').fadeToggle(400)
        })

        if (jQuery('#customize-control-spacematerial-spacematerial_slider_checkbox input:checked').val() !== undefined) {
          jQuery('#customize-control-spacematerial-spacematerial_slide_categories, #customize-control-spacematerial-spacematerial_slide_number').show()
        }
      })
    </script>
    <style>
        li#accordion-section-spacematerial_important_links h3.accordion-section-title, li#accordion-section-spacematerial_important_links h3.accordion-section-title:focus {
            background-color: #00cc00 !important;
            color: #fff !important;
        }

        li#accordion-section-spacematerial_important_links h3.accordion-section-title:hover {
            background-color: #00b200 !important;
            color: #fff !important;
        }

        li#accordion-section-spacematerial_important_links h3.accordion-section-title:after {
            color: #fff !important;
        }
    </style>
    <?php
}
