<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

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
        return 'eicon-exchange';
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
            'section_content',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'How it Works']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Get the treatment you need in four simple steps.']);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('title', ['label' => 'Step Title', 'type' => \Elementor\Controls_Manager::TEXT]);
        $repeater->add_control('desc', ['label' => 'Step Description', 'type' => \Elementor\Controls_Manager::TEXTAREA]);

        $this->add_control(
            'steps',
            [
                'label' => 'Steps',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['title' => 'Book your consultation in a few seconds', 'desc' => 'Schedule a visit with our medical team and get started with setting up your plan.'],
                    ['title' => 'Complete your labs and full-system review', 'desc' => 'Get a comprehensive view of your hormone and metabolic health.'],
                    ['title' => 'Meet your provider and receive your plan', 'desc' => 'Review your results and start a personalized treatment plan.'],
                    ['title' => 'Continue optimizing through your Care Plan', 'desc' => 'Ongoing monitoring and adjustments to keep you progressing.'],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control('btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Get Started']);
        $this->add_control('btn_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style_journey',
            [
                'label' => esc_html__('Style', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'num_color',
            [
                'label' => esc_html__('Number Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .how-num' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'num_bg',
            [
                'label' => esc_html__('Number BG Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .how-num' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__('Arrow Circle Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .how-arr-circle' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .how-arr-circle svg' => 'stroke: {{VALUE}};', // This might need a separate color
                ],
            ]
        );

        $this->add_control(
            'arrow_stroke',
            [
                'label' => esc_html__('Arrow SVG Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .how-arr-circle svg' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-journey">
            <section class="section am-home-container text-center">
                <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p><?php echo wp_kses_post($settings['subtitle']); ?></p>

                <div class="how-row">
                    <?php
                    if (!empty($settings['steps'])) {
                        $total = count($settings['steps']);
                        foreach ($settings['steps'] as $index => $step) {
                            $num = $index + 1;
                            $box_class = ($num % 2 === 0) ? 'how-box tan' : 'how-box';
                            ?>
                            <div class="<?php echo esc_attr($box_class); ?>">
                                <div class="how-num"><?php echo esc_html($num); ?></div>
                                <h3><?php echo wp_kses_post($step['title']); ?></h3>
                                <p><?php echo wp_kses_post($step['desc']); ?></p>
                            </div>

                            <?php if ($num < $total): ?>
                                <div class="how-arr-wrap">
                                    <div class="how-arr-circle">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D6CEC3" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                        }
                    }
                    ?>
                </div>

                <?php if (!empty($settings['btn_text'])): ?>
                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="btn btn-dark">
                        <?php echo esc_html($settings['btn_text']); ?>
                    </a>
                <?php endif; ?>
            </section>
        </div>
        <?php
    }
}
