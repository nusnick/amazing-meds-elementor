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
        wp_register_style('am-membership-global', plugins_url('../assets/css/widgets/am-membership-global.css', __FILE__));
        return ['am-membership-global'];
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

        $logo_repeater = new \Elementor\Repeater();
        $logo_repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Cigna', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );
        $logo_repeater->add_control(
            'image',
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
                'fields' => $logo_repeater->get_controls(),
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
        <section class="am-membership-global am-section--trust-banner">
            <div class="am-container container">
                <div class="trust-banner-inner">
                    <p>
                        <?php echo esc_html($settings['text']); ?>
                    </p>
                    <?php if (!empty($settings['logos'])): ?>
                        <div class="trust-logos">
                            <?php foreach ($settings['logos'] as $logo): ?>
                                <span class="trust-logo-item">
                                    <?php if (!empty($logo['image']['url'])): ?>
                                        <img src="<?php echo esc_url($logo['image']['url']); ?>"
                                            alt="<?php echo esc_attr($logo['name']); ?>"
                                            style="max-height: 24px; width: auto; opacity: 0.7;">
                                    <?php else: ?>
                                        <?php echo esc_html($logo['name']); ?>
                                    <?php endif; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            </div>
        </section>
        <?php
    }
}
