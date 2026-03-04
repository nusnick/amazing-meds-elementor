<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Guarantee Widget
 */
class AM_Hair_Guarantee_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_guarantee';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Guarantee', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-shield-check';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-widget-guarantee', plugins_url('../assets/css/widgets/guarantee.css', __FILE__));
        return ['am-widget-guarantee'];
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
                'default' => esc_html__('Our Promise to You', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Guarantee Title', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Guarantee description...', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Guarantees', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'The 30-Day Right Fit Promise',
                        'description' => 'Your first month is $69. If the medication doesn\'t agree with you, cancel before your second shipment. You only pay for the month you tried. No quarterly commitment until you and your provider agree you\'re ready.',
                    ],
                    [
                        'title' => 'Progress or Pivot',
                        'description' => 'At any point in your protocol, if progress stalls, your provider adjusts your plan at no extra cost. Dose changes. Hormone screening. Alternative approaches. Other companies send you the same pill and move on. We adapt until it works.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'note',
            [
                'label' => esc_html__('Bottom Note', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('No contracts. Cancel before any shipment. No hoops.', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--white">
            <div class="am-container">
                <div class="am-heading-stack">
                    <h2>
                        <?php echo esc_html($settings['heading']); ?>
                    </h2>
                </div>

                <?php if (!empty($settings['items'])): ?>
                    <div class="am-guarantee-grid" style="margin-top: 48px;">
                        <?php
                        $icons = [
                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>',
                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/></svg>'
                        ];
                        foreach ($settings['items'] as $index => $item):
                            ?>
                            <div class="am-card am-guarantee-card">
                                <div class="am-icon-circle am-icon-circle--gold">
                                    <?php echo $icons[$index % 2]; ?>
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

                <?php if (!empty($settings['note'])): ?>
                    <p class="am-guarantee-note">
                        <?php echo esc_html($settings['note']); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
