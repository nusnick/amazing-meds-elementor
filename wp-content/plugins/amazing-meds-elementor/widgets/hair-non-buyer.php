<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Non-Buyer Capture Widget
 */
class AM_Hair_NonBuyer_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_nonbuyer';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Non-Buyer Capture', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-download-button';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-widget-nonbuyer', plugins_url('../assets/css/widgets/non-buyer.css', __FILE__));
        return ['am-widget-nonbuyer'];
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
            'heading',
            [
                'label' => esc_html__('Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Not ready to start?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'guide_title',
            [
                'label' => esc_html__('Guide Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('"5 Hormonal Signs Your Hair Loss Is More Than Just Hair"', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Learn what your shedding might be trying to tell you about your thyroid, cortisol, and estrogen.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Send Me the Free Guide', 'amazing-meds-elementor'),
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
        <section class="am-section am-nonbuyer">
            <div class="am-container">
                <div class="am-nonbuyer-inner">
                    <h3>
                        <?php echo esc_html($settings['heading']); ?>
                    </h3>
                    <p class="guide-title">
                        <?php echo esc_html($settings['guide_title']); ?>
                    </p>
                    <p>
                        <?php echo esc_html($settings['description']); ?>
                    </p>

                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="am-btn am-btn--gold am-btn--lg">
                        <?php echo esc_html($settings['btn_text']); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php
    }
}
