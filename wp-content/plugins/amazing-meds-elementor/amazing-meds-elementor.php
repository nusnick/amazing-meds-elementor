<?php
/**
 * Plugin Name: Amazing Meds Elementor Widgets
 * Description: Custom Elementor widgets for Amazing Meds design system.
 * Version: 1.0.0
 * Author: Antigravity
 * Text Domain: amazing-meds-elementor
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main Amazing Meds Elementor Class
 */
final class Amazing_Meds_Elementor
{

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
    const MINIMUM_PHP_VERSION = '7.0';

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init()
    {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            return;
        }

        // Enqueue global assets
        add_action('elementor/frontend/after_register_styles', [$this, 'register_frontend_styles']);

        // Register Widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Register Categories
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);
    }

    public function register_frontend_styles()
    {
        // Google Fonts
        wp_enqueue_style('am-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@400;500;600&display=swap', [], null);
    }

    public function register_widgets($widgets_manager)
    {
        require_once(__DIR__ . '/widgets/hair-hero.php');
        require_once(__DIR__ . '/widgets/hair-comparison-grid.php');
        require_once(__DIR__ . '/widgets/hair-how-it-works.php');
        require_once(__DIR__ . '/widgets/hair-ingredients.php');
        require_once(__DIR__ . '/widgets/hair-protocol.php');
        require_once(__DIR__ . '/widgets/hair-receive.php');
        require_once(__DIR__ . '/widgets/hair-root-cause.php');
        require_once(__DIR__ . '/widgets/hair-pricing.php');
        require_once(__DIR__ . '/widgets/hair-existing-patient.php');
        require_once(__DIR__ . '/widgets/hair-guarantee.php');
        require_once(__DIR__ . '/widgets/hair-non-buyer.php');
        require_once(__DIR__ . '/widgets/hair-faq.php');
        require_once(__DIR__ . '/widgets/hair-final-cta.php');
        require_once(__DIR__ . '/widgets/membership-hero.php');
        require_once(__DIR__ . '/widgets/membership-social-proof.php');
        require_once(__DIR__ . '/widgets/membership-agitation.php');
        require_once(__DIR__ . '/widgets/membership-insurance-banner.php');
        require_once(__DIR__ . '/widgets/membership-system-5.php');
        require_once(__DIR__ . '/widgets/membership-comparison.php');
        require_once(__DIR__ . '/widgets/membership-included-benefits.php');
        require_once(__DIR__ . '/widgets/membership-steps.php');
        require_once(__DIR__ . '/widgets/membership-testimonials.php');
        require_once(__DIR__ . '/widgets/membership-pricing.php');
        require_once(__DIR__ . '/widgets/membership-conditions.php');
        require_once(__DIR__ . '/widgets/membership-faq.php');
        require_once(__DIR__ . '/widgets/membership-final-cta.php');

        $widgets_manager->register(new \AM_Hair_Hero_Widget());
        $widgets_manager->register(new \AM_Hair_Comparison_Grid_Widget());
        $widgets_manager->register(new \AM_Hair_How_It_Works_Widget());
        $widgets_manager->register(new \AM_Hair_Ingredients_Widget());
        $widgets_manager->register(new \AM_Hair_Protocol_Widget());
        $widgets_manager->register(new \AM_Hair_Receive_Widget());
        $widgets_manager->register(new \AM_Hair_Root_Cause_Widget());
        $widgets_manager->register(new \AM_Hair_Pricing_Widget());
        $widgets_manager->register(new \AM_Hair_Existing_Patient_Widget());
        $widgets_manager->register(new \AM_Hair_Guarantee_Widget());
        $widgets_manager->register(new \AM_Hair_NonBuyer_Widget());
        $widgets_manager->register(new \AM_Hair_FAQ_Widget());
        $widgets_manager->register(new \AM_Hair_Final_CTA_Widget());
        $widgets_manager->register(new \AM_Membership_Hero_Widget());
        $widgets_manager->register(new \AM_Membership_Social_Proof_Widget());
        $widgets_manager->register(new \AM_Membership_Agitation_Widget());
        $widgets_manager->register(new \AM_Membership_Insurance_Banner_Widget());
        $widgets_manager->register(new \AM_Membership_System_5_Widget());
        $widgets_manager->register(new \AM_Membership_Comparison_Widget());
        $widgets_manager->register(new \AM_Membership_Included_Benefits_Widget());
        $widgets_manager->register(new \AM_Membership_Steps_Widget());
        $widgets_manager->register(new \AM_Membership_Testimonials_Widget());
        $widgets_manager->register(new \AM_Membership_Pricing_Widget());
        $widgets_manager->register(new \AM_Membership_Conditions_Widget());
        $widgets_manager->register(new \AM_Membership_FAQ_Widget());
        $widgets_manager->register(new \AM_Membership_Final_CTA_Widget());
    }

    public function register_categories($elements_manager)
    {
        $elements_manager->add_category(
            'amazing-meds',
            [
                'title' => esc_html__('Amazing Meds', 'amazing-meds-elementor'),
                'icon' => 'fa fa-plug',
            ]
        );
    }
}

Amazing_Meds_Elementor::instance();
