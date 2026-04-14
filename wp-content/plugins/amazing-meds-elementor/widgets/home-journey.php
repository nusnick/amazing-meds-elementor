<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Journey Widget
 */
class AM_Home_Journey_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_journey';
    }

    public function get_title()
    {
        return esc_html__('AM Home Journey', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-editor-list-ol';
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
                'default' => esc_html__('The Path to Feeling Better', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Evidence-based telemedicine treatments designed to help you regain vitality—from the comfort of home.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'step_num',
            [
                'label' => esc_html__('Step Number', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'step_title',
            [
                'label' => esc_html__('Step Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Comprehensive Labs', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'step_description',
            [
                'label' => esc_html__('Step Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Book your lab visit at one of our 2,000+ partner locations (or we’ll come to you).', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'steps',
            [
                'label' => esc_html__('Steps', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'step_num' => '01',
                        'step_title' => 'Comprehensive Labs',
                        'step_description' => 'Book your lab visit at one of our 2,000+ partner locations (or we’ll come to you).',
                    ],
                    [
                        'step_num' => '02',
                        'step_title' => 'Expert Evaluation',
                        'step_description' => 'Review your full hormonal picture with a medical specialist via secure video call.',
                    ],
                    [
                        'step_num' => '03',
                        'step_title' => 'Tailored Treatment',
                        'step_description' => 'Receive your personalized plan and medication delivered discreetly to your door.',
                    ],
                    [
                        'step_num' => '04',
                        'step_title' => 'Ongoing Support',
                        'step_description' => 'Stay on track with quarterly monitoring and adjustments to optimize your results.',
                    ],
                ],
                'title_field' => '{{{ step_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-journey">
            <div class="am-journey-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($settings['description'])): ?>
                    <p class="am-text-p"><?php echo wp_kses_post($settings['description']); ?></p>
                <?php endif; ?>
            </div>

            <div class="am-journey-grid">
                <?php foreach ($settings['steps'] as $step): ?>
                    <div class="am-journey-card">
                        <div class="am-journey-num"><?php echo esc_html($step['step_num']); ?></div>
                        <h3 class="am-journey-title"><?php echo esc_html($step['step_title']); ?></h3>
                        <div class="am-journey-description"><?php echo wp_kses_post($step['step_description']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="#" class="am-button am-button-dark">Book Your Consultation</a>
        </div>
        <?php
    }
}
