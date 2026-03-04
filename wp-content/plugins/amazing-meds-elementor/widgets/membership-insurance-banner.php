<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Insurance Banner Widget
 */
class AM_Membership_Insurance_Banner_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_insurance_banner';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Insurance Banner', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-banner';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-insurance-banner', plugins_url('../assets/css/widgets/membership-insurance-banner.css', __FILE__));
        return ['am-membership-insurance-banner'];
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
            'text',
            [
                'label' => esc_html__('Banner Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We accept most major insurance plans for qualifying services, labs, and provider visits', 'amazing-meds-elementor'),
                'rows' => 2,
            ]
        );

        $this->add_control(
            'logos',
            [
                'label' => esc_html__('Insurance Logos (Names)', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => esc_html__('Name', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Cigna', 'amazing-meds-elementor'),
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    ['name' => 'Cigna'],
                    ['name' => 'United Healthcare'],
                    ['name' => 'Blue Cross Blue Shield'],
                    ['name' => 'Aetna'],
                    ['name' => 'Humana'],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-insurance-banner am-section--trust-banner">
            <div class="am-container">
                <div class="trust-banner-inner">
                    <p>
                        <?php echo esc_html($settings['text']); ?>
                    </p>
                    <?php if (!empty($settings['logos'])): ?>
                        <div class="trust-logos">
                            <?php foreach ($settings['logos'] as $logo): ?>
                                <span class="trust-logo-item">
                                    <?php echo esc_html($logo['name']); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
