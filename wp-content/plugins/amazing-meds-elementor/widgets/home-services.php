<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Services Widget
 */
class AM_Home_Services_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_services';
    }

    public function get_title()
    {
        return esc_html__('AM Home Services', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-inner-section';
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
                'default' => esc_html__('A More Complete Approach to Helping You Feel Better', 'amazing-meds-elementor'),
            ]
        );

        // Standard Care
        $this->add_control(
            'standard_title',
            [
                'label' => esc_html__('Standard Care Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Standard Care', 'amazing-meds-elementor'),
                'separator' => 'before',
            ]
        );

        $standard_repeater = new \Elementor\Repeater();
        $standard_repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Item Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'standard_items',
            [
                'label' => esc_html__('Standard Care Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $standard_repeater->get_controls(),
                'default' => [
                    ['item_text' => 'Treatment often based on a single number from a basic lab panel.'],
                    ['item_text' => 'One-size-fits-all prescriptions (capsules/topicals only).'],
                    ['item_text' => 'Minimal follow-up or adjustment once treatment begins.'],
                    ['item_text' => 'Navigating appointments, labs, and pharmacies on your own.'],
                ],
            ]
        );

        // Amazing Meds
        $this->add_control(
            'amazing_title',
            [
                'label' => esc_html__('Amazing Meds Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Amazing Meds', 'amazing-meds-elementor'),
                'separator' => 'before',
            ]
        );

        $amazing_repeater = new \Elementor\Repeater();
        $amazing_repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Item Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'amazing_items',
            [
                'label' => esc_html__('Amazing Meds Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $amazing_repeater->get_controls(),
                'default' => [
                    ['item_text' => 'Comprehensive lab review looking at your full hormonal picture.'],
                    ['item_text' => 'Personalized delivery options tailored to your body and goals.'],
                    ['item_text' => 'Ongoing quarterly monitoring and treatment adjustments.'],
                    ['item_text' => 'A seamless experience where we handle the logistics for you.'],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-services">
            <div class="am-services-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
            </div>

            <div class="am-comparison-container">
                <!-- Standard Care -->
                <div class="am-comparison-col am-col-standard">
                    <div class="am-col-header">
                        <h3 class="am-col-title"><?php echo esc_html($settings['standard_title']); ?></h3>
                    </div>
                    <div class="am-items-list">
                        <?php foreach ($settings['standard_items'] as $item): ?>
                            <div class="am-list-item">
                                <div class="am-list-text"><?php echo esc_html($item['item_text']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Amazing Meds -->
                <div class="am-comparison-col am-col-amazing">
                    <div class="am-col-header">
                        <h3 class="am-col-title"><?php echo esc_html($settings['amazing_title']); ?></h3>
                    </div>
                    <div class="am-items-list">
                        <?php foreach ($settings['amazing_items'] as $item): ?>
                            <div class="am-list-item">
                                <div class="am-list-text"><?php echo esc_html($item['item_text']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="#" class="am-button am-button-dark">Get Started</a>
                </div>
            </div>
        </div>
        <?php
    }
}
