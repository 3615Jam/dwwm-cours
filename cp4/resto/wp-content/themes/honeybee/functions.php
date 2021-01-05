<?php
// Global variables define
define('HONEYBEE_PARENT_TEMPLATE_DIR_URI', get_template_directory_uri());
define('HONEYBEE_TEMPLATE_DIR_URI', get_stylesheet_directory_uri());
define('HONEYBEE_CHILD_TEMPLATE_DIR', trailingslashit(get_stylesheet_directory()));

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }

}
add_action('after_setup_theme', 'honeybee_setup');

function honeybee_sanitize_checkbox($checked) {
    // Boolean check.
    return ( ( isset($checked) && true == $checked ) ? true : false );
}

function honeybee_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function honeybee_setup() {
    load_theme_textdomain('honeybee', HONEYBEE_CHILD_TEMPLATE_DIR . '/languages');

    require( HONEYBEE_CHILD_TEMPLATE_DIR . '/inc/customizer/footer-options.php');
    require( HONEYBEE_CHILD_TEMPLATE_DIR . '/inc/customizer/customizer_theme_style.php');
    require( HONEYBEE_CHILD_TEMPLATE_DIR . '/functions/widgets/sidebars.php');
    require( HONEYBEE_CHILD_TEMPLATE_DIR . '/functions/widgets/wdl_social_icon.php');
    require( HONEYBEE_CHILD_TEMPLATE_DIR . '/functions/widgets/wdl_topbar_info.php');

    if (is_admin()) {
        require get_stylesheet_directory() . '/admin/admin-init.php';
    }
    $args = array(
    'default-image' => HONEYBEE_TEMPLATE_DIR_URI. '/assets/images/bg-img4.png',
    );
    add_theme_support( 'custom-background', $args );

}

add_action('wp_enqueue_scripts', 'honeybee_enqueue_styles');

function honeybee_enqueue_styles() {
    if (get_theme_mod('custom_color_enable') == true) {
        honeybee_custom_light();
    }
    wp_enqueue_style('honeybee-parent-style', HONEYBEE_PARENT_TEMPLATE_DIR_URI . '/style.css', array('bootstrap'));
    wp_style_add_data('honeybee-parent-style', 'rtl', 'replace' );
    wp_enqueue_style('honeybee-style', get_stylesheet_uri() );    
    wp_style_add_data('honeybee-style', 'rtl', 'replace' );
    wp_enqueue_style('honeybee-default-style', HONEYBEE_TEMPLATE_DIR_URI . '/assets/css/default.css');
}

function honeybee_custom_light() {
    $honeybee_link_color = get_theme_mod('link_color');
    list($r, $g, $b) = sscanf($honeybee_link_color, "#%02x%02x%02x");
    $r = $r - 50;
    $g = $g - 25;
    $b = $b - 40;

    if ($honeybee_link_color != '#ff0000') :
        ?>
        <style type="text/css">
            .header-sidebar {
                background: <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            .navbar5.navbar .nav .nav-item:hover .nav-link, .navbar5.navbar .nav .nav-item.active .nav-link {
                background: <?php echo esc_html($honeybee_link_color); ?> !important;
                color:#fff!important;
            }
            .services4 .post {
                background:  <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            .services4 .entry-header .entry-title a:hover{
                color:#061018!important;  
            }
            #testimonial-carousel2 .testmonial-block:before {
                border-top: 25px solid <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            #testimonial-carousel2 .testmonial-block {
                border-left: 4px solid <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            @media (min-width: 992px){
                body .navbar .nav .dropdown-menu {
                    border-bottom: 3px solid <?php echo esc_html($honeybee_link_color); ?>;}
            }

            .nav .dropdown-item:focus, .nav .dropdown-item:hover {
                color: <?php echo esc_html($honeybee_link_color); ?>;
            }
            .site-title a:hover {
                color: <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            .services7 .post-thumbnail i.fa ,
                .services7 .post-thumbnail img {background: <?php echo esc_html($honeybee_link_color); ?> !important;}
            .services7 .post:hover {background-color: <?php echo esc_html($honeybee_link_color); ?> !important;}
            .services7 .post:hover .post-thumbnail i.fa {color: <?php echo esc_html($honeybee_link_color); ?> !important;
                background-color: #ffffff !important;}
            .search-form input[type="submit"] {
                border: 1px solid <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            .woocommerce-widget-layered-nav li span:after, .widget_product_categories li a:after {
                color: <?php echo esc_html($honeybee_link_color); ?> !important;
            }
            .services7 .post-thumbnail i.fa, .services7 .post-thumbnail img {
                border: 5px solid <?php echo esc_html($honeybee_link_color); ?> !important;
            }
        </style>
        <?php
    endif;
}

function honeybee_footer_section_hook() {
    ?>
    <footer class="site-footer">  
        <div class="container">
            <?php if (is_active_sidebar('footer-sidebar-1') || is_active_sidebar('footer-sidebar-2') || is_active_sidebar('footer-sidebar-3')): ?>
                <div class="seprator-line"></div>   
                <?php
                get_template_part('sidebar', 'footer');
            endif;
            ?>  
        </div>
            <?php if (get_theme_mod('footer_enable', true) == true): ?>
            <div class="site-info text-center">
                <?php $honeybee_footer_copyright = get_theme_mod('footer_copyright', '<p>' . __('Proudly powered by <a href="https://wordpress.org"> WordPress</a> | Theme: <a href="https://spicethemes.com" rel="nofollow">HoneyBee</a> by SpiceThemes', 'honeybee') . '</p>'); ?>  
            <?php echo wp_kses_post($honeybee_footer_copyright); ?> 
            </div>
    <?php endif; ?>
    </footer>
    <?php
}

add_action('honeybee_footer_section_hook', 'honeybee_footer_section_hook');

function honeybee_custom_logo_setup() {
 $defaults = array(
		   	'height'      => 100,
		   	'width'       => 400,
		   	'flex-height' => true,
            'flex-width'  => true,
		   	'header-text' => array( 'site-title', 'site-description' ),
			);
 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'honeybee_custom_logo_setup' ,11);
function honeybee_customizer_styles() { ?>
    <style>
        .customize-control-widget_form .widget-control-save {
            display: block!important;
        }
    </style>
    <?php
}
add_action( 'customize_controls_print_styles', 'honeybee_customizer_styles',11);