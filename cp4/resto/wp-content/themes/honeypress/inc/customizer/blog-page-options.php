<?php
/**
 * Single Blog Options Customizer
 *
 * @package Honeypress
 */
function honeypress_blog_page_options_customizer ( $wp_customize )
{
$wp_customize->add_section('honeypress_blog_page_options',
	array(
		'title' => esc_html__('Blog Page Option', 'honeypress'),
		'panel' => 'honeypress_theme_panel',
		'priority' => 1
	));


		// News section title
		$wp_customize->add_setting( 'blog_page_title_option',array(
		'capability'     => 'edit_theme_options',
		'default' => esc_html__('Home','honeypress'),
		'sanitize_callback' => 'honeypress_sanitize_text',
		));	
		$wp_customize->add_control( 'blog_page_title_option',array(
		'label'   => esc_html__('Main Title','honeypress'),
		'section' => 'honeypress_blog_page_options',
		'type' => 'text',
		));

}
add_action( 'customize_register', 'honeypress_blog_page_options_customizer' );