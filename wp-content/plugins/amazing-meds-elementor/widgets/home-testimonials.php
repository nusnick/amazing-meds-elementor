<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Testimonials Widget
 */
class AM_Home_Testimonials_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_testimonials';
    }

    public function get_title()
    {
        return esc_html__('AM Home Testimonials', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        return ['am-home-widgets'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Main Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('The Difference is Real', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'quote',
            [
                'label' => esc_html__('Testimonial Quote', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('“I finally feel like myself again. My energy is back, my brain fog is gone, and I have the vitality I thought I’d lost forever.”', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'author',
            [
                'label' => esc_html__('Author Name', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sarah J., Patient', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-testimonials">
            <div class="am-services-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
            </div>

            <div class="am-testimonial-card">
                <div class="am-testimonial-quote"><?php echo wp_kses_post($settings['quote']); ?></div>
                <div class="am-testimonial-author">
                    <div style="width: 48px; height: 48px; background: var(--am-gold); border-radius: 999px;"></div>
                    <div class="am-author-name"><?php echo esc_html($settings['author']); ?></div>
                </div>
            </div>

            <a href="#" class="am-button am-button-dark">Read More Stories</a>
        </div>
        <?php
    }
}
