<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Wellness Widget
 */
class AM_Home_Wellness_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_wellness';
    }

    public function get_title()
    {
        return esc_html__('AM Home Wellness', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-column';
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
                'default' => esc_html__('A More Complete Approach to Wellness', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We start by identifying exactly what your body needs to reach its optimal state.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lab Analysis', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'feature_description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Comprehensive panels reviewed by medical experts to identify hormonal imbalances.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_title' => 'Lab Analysis',
                        'feature_description' => 'Comprehensive panels reviewed by medical experts to identify hormonal imbalances.',
                    ],
                    [
                        'feature_title' => 'Treatment Plan',
                        'feature_description' => 'Personalized protocols tailored specifically to your labs, symptoms, and lifestyle.',
                    ],
                    [
                        'feature_title' => 'Price Advocacy',
                        'feature_description' => 'Transparent pricing and support navigating insurance to manage your healthcare costs.',
                    ],
                ],
                'title_field' => '{{{ feature_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-wellness">
            <div class="am-wellness-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])): ?>
                    <p class="am-text-p"><?php echo wp_kses_post($settings['subtitle']); ?></p>
                <?php endif; ?>
            </div>

            <div class="am-features-grid">
                <?php foreach ($settings['features'] as $feature): ?>
                    <div class="am-feature-card">
                        <div class="am-feature-icon-box">
                            <!-- Placeholder icon -->
                            <div style="width: 24px; height: 24px; border: 2px solid var(--am-dark); border-radius: 4px;"></div>
                        </div>
                        <h3 class="am-feature-title"><?php echo esc_html($feature['feature_title']); ?></h3>
                        <div class="am-feature-description"><?php echo wp_kses_post($feature['feature_description']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}
