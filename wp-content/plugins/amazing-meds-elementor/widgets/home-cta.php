<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home CTA Widget
 */
class AM_Home_CTA_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_cta';
    }

    public function get_title()
    {
        return esc_html__('AM Home CTA', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
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
                'default' => esc_html__('Ready to feel like yourself again?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Join 10,000+ patients who have reclaimed their vitality through precision hormone optimization.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_text_1',
            [
                'label' => esc_html__('Primary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Your Consultation', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_text_2',
            [
                'label' => esc_html__('Secondary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Pricing', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-cta">
            <?php if (!empty($settings['title'])): ?>
                <h2 class="am-heading-xl am-cta-title"><?php echo wp_kses_post($settings['title']); ?></h2>
            <?php endif; ?>

            <?php if (!empty($settings['description'])): ?>
                <p class="am-text-p am-cta-description"><?php echo wp_kses_post($settings['description']); ?></p>
            <?php endif; ?>

            <div style="display: flex; gap: 16px; justify-content: center; width: 100%;">
                <a href="#" class="am-button am-button-gold"><?php echo esc_html($settings['btn_text_1']); ?></a>
                <a href="#" class="am-button am-button-dark"
                    style="border: 1px solid var(--am-white);"><?php echo esc_html($settings['btn_text_2']); ?></a>
            </div>

            <p style="color: rgba(255,255,255,0.4); font-size: 14px;">No credit card required to book.</p>
        </div>
        <?php
    }
}
