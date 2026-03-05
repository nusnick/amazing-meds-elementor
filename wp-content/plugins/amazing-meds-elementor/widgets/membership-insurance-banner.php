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
        wp_register_style('am-membership-insurance-banner', plugins_url('../assets/css/widgets/membership-insurance-banner.css', __FILE__));
        return ['am-membership-global', 'am-membership-insurance-banner'];
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

        $this->add_control(
            'primary_button_text',
            [
                'label' => esc_html__('Primary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Your Free Consult', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'primary_button_url',
            [
                'label' => esc_html__('Primary Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'secondary_button_text',
            [
                'label' => esc_html__('Secondary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Membership Options', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'secondary_button_url',
            [
                'label' => esc_html__('Secondary Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
                'default' => [
                    'url' => '#pricing',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-section--trust-banner">
            <div class="am-container">
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

                    <div style="text-align:center; margin-top: 36px;">
                        <?php if (!empty($settings['primary_button_text'])): ?>
                            <a href="<?php echo esc_url($settings['primary_button_url']['url']); ?>"
                                class="am-btn--primary-on-dark">
                                <?php echo esc_html($settings['primary_button_text']); ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <span style="display:inline-block; margin: 0 12px; color: rgba(255,255,255,0.3);">or</span>

                        <?php if (!empty($settings['secondary_button_text'])): ?>
                            <a href="<?php echo esc_url($settings['secondary_button_url']['url']); ?>"
                                class="am-btn--secondary-on-dark">
                                <?php echo esc_html($settings['secondary_button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
