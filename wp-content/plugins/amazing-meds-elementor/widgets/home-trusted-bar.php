<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Trusted Bar Widget
 */
class AM_Home_Trusted_Bar_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_trusted';
    }

    public function get_title()
    {
        return esc_html__('AM Home Trusted Bar', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-info-box';
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
            'insurance_title',
            [
                'label' => esc_html__('Insurance Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Insurance Accepted', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'logo_image',
            [
                'label' => esc_html__('Logo Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'logos',
            [
                'label' => esc_html__('Insurance Logos', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['logo_image' => ['url' => 'https://placehold.co/100x40']],
                    ['logo_image' => ['url' => 'https://placehold.co/100x40']],
                    ['logo_image' => ['url' => 'https://placehold.co/100x40']],
                    ['logo_image' => ['url' => 'https://placehold.co/100x40']],
                    ['logo_image' => ['url' => 'https://placehold.co/100x40']],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-trusted-bar">
            <!-- Trust Indicators -->
            <div class="am-trust-items">
                <div class="am-trust-item">
                    <span class="am-trust-text">Provider-reviewed</span>
                </div>
                <div class="am-trust-item">
                    <span class="am-trust-text">Free discreet shipping</span>
                </div>
                <div class="am-trust-item">
                    <span class="am-trust-text">4.8/5 rating</span>
                </div>
            </div>

            <!-- Insurance Box -->
            <div class="am-insurance-box">
                <?php if (!empty($settings['insurance_title'])): ?>
                    <div class="am-insurance-title"><?php echo esc_html($settings['insurance_title']); ?></div>
                <?php endif; ?>

                <div class="am-logo-grid">
                    <?php foreach ($settings['logos'] as $item): ?>
                        <?php if (!empty($item['logo_image']['url'])): ?>
                            <img src="<?php echo esc_url($item['logo_image']['url']); ?>" class="am-insurance-logo"
                                alt="Insurance Partner">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
