<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Hero Widget
 */
class AM_Home_Hero_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_hero';
    }

    public function get_title()
    {
        return esc_html__('AM Home Hero', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-image-before-after';
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
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Feel better with a more complete approach to hormone optimization', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Evidence-based telemedicine treatments designed to help you regain vitality and reach your goals—from the comfort of home.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book your consultation', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__('Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-hero">
            <div class="am-hero-container">
                <div class="am-hero-content">
                    <div class="am-hero-text-group">
                        <?php if (!empty($settings['title'])): ?>
                            <h1 class="am-hero-title am-heading-xl"><?php echo wp_kses_post($settings['title']); ?></h1>
                        <?php endif; ?>

                        <?php if (!empty($settings['description'])): ?>
                            <div class="am-hero-description"><?php echo wp_kses_post($settings['description']); ?></div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($settings['btn_text'])): ?>
                        <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="am-button am-button-dark">
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
