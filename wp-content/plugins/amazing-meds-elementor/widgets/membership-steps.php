<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Steps Widget
 */
class AM_Membership_Steps_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_steps';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Steps', 'amazing-meds-elementor');
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
            'label',
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Process']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Four steps to feeling like yourself again']
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Steps', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'number',
                        'label' => 'Number',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '1',
                    ],
                    [
                        'name' => 'title',
                        'label' => 'Title',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Free Discovery Call',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => '15 minutes to see if we\'re a fit. No pressure, just answers about our process and your goals.',
                    ],
                ],
                'default' => [
                    [
                        'number' => '1',
                        'title' => 'Free Discovery Call',
                        'description' => '15 minutes to see if we\'re a fit. No pressure, just answers about our process and your goals.',
                    ],
                    [
                        'number' => '2',
                        'title' => 'The System 5 Lab Panel',
                        'description' => 'Go to any LabCorp near you. We check all five critical systems, not just one hormone.',
                    ],
                    [
                        'number' => '3',
                        'title' => 'Provider Consultation',
                        'description' => 'A deep dive into your labs, symptoms, and medical history to build your custom protocol.',
                    ],
                    [
                        'number' => '4',
                        'title' => 'Treatment & Ongoing Care',
                        'description' => 'Meds shipped to your door. Real adjustments every 90 days as your body changes.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-section--steps">
            <div class="am-container">
                <div class="am-heading-stack">
                    <?php if (!empty($settings['label'])): ?>
                        <div class="am-label">
                            <?php echo esc_html($settings['label']); ?>
                        </div>
                    <?php endif; ?>
                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                </div>

                <?php if (!empty($settings['items'])): ?>
                    <div class="steps-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="step-card">
                                <div class="step-num">
                                    <?php echo esc_html($item['number']); ?>
                                </div>
                                <h3>
                                    <?php echo esc_html($item['title']); ?>
                                </h3>
                                <p>
                                    <?php echo esc_html($item['description']); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
