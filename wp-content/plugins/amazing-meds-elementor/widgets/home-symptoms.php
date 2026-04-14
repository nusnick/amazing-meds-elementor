<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Symptoms Widget
 */
class AM_Home_Symptoms_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_symptoms';
    }

    public function get_title()
    {
        return esc_html__('AM Home Symptoms', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-tags';
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
                'default' => esc_html__('What can we help you improve?', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Symptom Name', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Weight', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__('Icon', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'symptoms',
            [
                'label' => esc_html__('Symptoms', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['item_text' => 'Weight'],
                    ['item_text' => 'Energy'],
                    ['item_text' => 'Libido'],
                    ['item_text' => 'Mood'],
                    ['item_text' => 'Focus'],
                    ['item_text' => 'Sleep'],
                    ['item_text' => 'Strength'],
                    ['item_text' => 'Recovery'],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-symptoms">
            <div class="am-services-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
            </div>

            <div class="am-symptoms-grid">
                <?php foreach ($settings['symptoms'] as $item): ?>
                    <div class="am-symptom-card">
                        <div class="am-symptom-icon">
                            <!-- Placeholder icon -->
                            <div style="width: 100%; height: 100%; border: 2px solid var(--am-gold); border-radius: 8px;"></div>
                        </div>
                        <div class="am-symptom-text"><?php echo esc_html($item['item_text']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="#" class="am-button am-button-dark">Book Your Consultation</a>
        </div>
        <?php
    }
}
