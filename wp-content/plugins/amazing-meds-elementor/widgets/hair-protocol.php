<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Protocol Widget
 */
class AM_Hair_Protocol_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_protocol';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Protocol', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-time-line';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-hair-css', plugins_url('../assets/css/widgets/hair-global.css', __FILE__));
        return ['am-hair-css'];
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
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Not a product. A 12-month hair recovery protocol.', 'amazing-meds-elementor'),
            ]
        );

        // Phase 1 Card
        $this->add_control(
            'phase_1_badge',
            [
                'label' => esc_html__('Phase 1 Badge', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Phase 1: The Reset', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_1_title',
            [
                'label' => esc_html__('Phase 1 Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Month 1', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_1_subtitle',
            [
                'label' => esc_html__('Phase 1 Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Starter dose capsules. Daily tracking. Tolerability assessment.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_1_desc',
            [
                'label' => esc_html__('Phase 1 Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your 30-day supply arrives. You take the lower dose to let your body adjust. You submit your Day 1 progress photos through our portal. Your provider monitors for side effects and is available via async messaging.', 'amazing-meds-elementor'),
            ]
        );

        // Phase 2 Card
        $this->add_control(
            'phase_2_badge',
            [
                'label' => esc_html__('Phase 2 Badge', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Phase 2: The Growth Protocol', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_2_title',
            [
                'label' => esc_html__('Phase 2 Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Months 2-12', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_2_subtitle',
            [
                'label' => esc_html__('Phase 2 Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Full strength. Quarterly reviews. Root cause investigation.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_2_desc',
            [
                'label' => esc_html__('Phase 2 Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your provider graduates you to the full dose. Your 90-day supply ships.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'months',
            [
                'label' => esc_html__('Months', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Months 2-4', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description text...', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'timeline_items',
            [
                'label' => esc_html__('Timeline Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'months' => 'Months 2-4',
                        'description' => 'Reduced shedding begins. Your body is responding to the full-strength protocol.',
                    ],
                    [
                        'months' => 'Months 5-7',
                        'description' => 'Visible regrowth. Provider reviews your progress. If stalled, we investigate with hormone labs billed to your insurance.',
                    ],
                    [
                        'months' => 'Months 8-12',
                        'description' => 'Density improves. Provider evaluates your long-term maintenance plan. Protocol adjustments included at no extra cost.',
                    ],
                ],
                'title_field' => '{{{ months }}}',
            ]
        );

        $this->add_control(
            'callout_text',
            [
                'label' => esc_html__('Callout Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your provider reviews your case before every shipment is authorized. Every transition point, a real clinician looks at your progress and decides what\'s next. Not a chatbot. Not an automated refill. A person who knows your history.', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--dark">
            <div class="am-container">
                <div class="am-heading-stack">
                    <h2>
                        <?php echo esc_html($settings['heading']); ?>
                    </h2>
                </div>
                <div class="am-protocol-grid" style="margin-top: 48px;">
                    <div class="am-protocol-card am-protocol-card--accent">
                        <div class="phase-badge">
                            <?php echo esc_html($settings['phase_1_badge']); ?>
                        </div>
                        <h3>
                            <?php echo esc_html($settings['phase_1_title']); ?>
                        </h3>
                        <div class="phase-sub">
                            <?php echo esc_html($settings['phase_1_subtitle']); ?>
                        </div>
                        <p class="desc">
                            <?php echo esc_html($settings['phase_1_desc']); ?>
                        </p>
                    </div>
                    <div class="am-protocol-card">
                        <div class="phase-badge">
                            <?php echo esc_html($settings['phase_2_badge']); ?>
                        </div>
                        <h3>
                            <?php echo esc_html($settings['phase_2_title']); ?>
                        </h3>
                        <div class="phase-sub">
                            <?php echo esc_html($settings['phase_2_subtitle']); ?>
                        </div>
                        <p class="desc" style="margin-bottom: 24px;">
                            <?php echo esc_html($settings['phase_2_desc']); ?>
                        </p>

                        <?php if (!empty($settings['timeline_items'])): ?>
                            <div class="am-timeline">
                                <?php foreach ($settings['timeline_items'] as $item): ?>
                                    <div class="am-timeline-item">
                                        <div class="am-timeline-dot">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="timeline-months">
                                                <?php echo esc_html($item['months']); ?>
                                            </div>
                                            <div class="timeline-desc">
                                                <?php echo esc_html($item['description']); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($settings['callout_text'])): ?>
                    <div class="am-callout--dark">
                        <p>
                            <?php echo esc_html($settings['callout_text']); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
