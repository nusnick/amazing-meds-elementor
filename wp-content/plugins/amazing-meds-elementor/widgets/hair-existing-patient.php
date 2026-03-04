<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Existing Patient Widget
 */
class AM_Hair_Existing_Patient_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_existing_patient';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Existing Patient', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-user-circle-o';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-widget-existing', plugins_url('../assets/css/widgets/existing.css', __FILE__));
        return ['am-widget-existing'];
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
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Existing Patients', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Already an Amazing Meds Patient?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We built a special rate for you because we already know your history. Your provider already knows your hormones, your health, and your history. No new intake forms required.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'amount',
            [
                'label' => esc_html__('Amount', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$49', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'billing_sub',
            [
                'label' => esc_html__('Billing Sub-text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('first month &middot; then $79/month ($237/quarter)', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Add to My Protocol - $49', 'amazing-meds-elementor'),
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
        <section class="am-existing">
            <div class="am-container">
                <div class="am-existing-card">
                    <?php if (!empty($settings['badge_text'])): ?>
                        <span class="am-badge am-badge--gold" style="margin-bottom: 20px;">
                            <?php echo esc_html($settings['badge_text']); ?>
                        </span>
                    <?php endif; ?>

                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                    <p>
                        <?php echo esc_html($settings['description']); ?>
                    </p>

                    <div class="existing-price">
                        <?php echo esc_html($settings['amount']); ?>
                    </div>
                    <div class="existing-ongoing">
                        <?php echo wp_kses($settings['billing_sub'], ['middot' => []]); ?>
                    </div>

                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="am-btn am-btn--gold am-btn--lg">
                        <?php echo esc_html($settings['btn_text']); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php
    }
}
