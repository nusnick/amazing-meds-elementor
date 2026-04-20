<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Wellness_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_wellness';
    }

    public function get_title()
    {
        return esc_html__('AM Home Wellness (System 5)', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
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
                'label' => esc_html__('Header Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'top_heading',
            [
                'label' => esc_html__('Top Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('What We Get You', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'main_heading',
            [
                'label' => esc_html__('Main Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'An Absolutely Complete Way to<br>Understand & Treat Your Health',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Our "System 5 Protocol" is designed to give you a full picture of your health before, during, and after treatment.', 'amazing-meds-elementor'),
            ]
        );
        $this->end_controls_section();


        // Large Cards
        $this->start_controls_section(
            'section_large_cards',
            [
                'label' => esc_html__('Large Cards (Top Grid)', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('lc1_title', ['label' => 'Card 1 Title', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Hormone<br>Blueprint']);
        $this->add_control('lc1_desc', ['label' => 'Card 1 Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Complete hormone mapping before any treatment begins.']);
        $this->add_control('lc1_img', ['label' => 'Card 1 Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $this->add_control('lc1_icon', [
            'label' => 'Card 1 Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-dna',
                'library' => 'fa-solid',
            ],
        ]);
        $this->add_control('lc1_icon_color', [
            'label' => 'Icon Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sys-c1 .sys-icon-circle i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sys-c1 .sys-icon-circle svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                '{{WRAPPER}} .sys-c1 .sys-icon-circle' => 'color: {{VALUE}};',
            ]
        ]);
        $this->add_control('lc1_icon_bg', ['label' => 'Icon BG', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .sys-c1 .sys-icon-circle' => 'background-color: {{VALUE}};']]);

        $this->add_responsive_control('lc1_img_scale', [
            'label' => 'Image Scale (px/%)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                '%' => ['min' => 50, 'max' => 200],
                'px' => ['min' => 100, 'max' => 600],
            ],
            'default' => [
                'unit' => '%',
                'size' => 135,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 300,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 250,
            ],
            'selectors' => ['{{WRAPPER}} .sys-c1 img' => 'height: {{SIZE}}{{UNIT}};'],
        ]);
        $this->add_responsive_control('lc1_img_x', [
            'label' => 'Image Offset X (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -200, 'max' => 200]],
            'default' => ['unit' => 'px', 'size' => -80],
            'selectors' => ['{{WRAPPER}} .sys-c1 img' => 'left: {{SIZE}}{{UNIT}};'],
        ]);
        $this->add_responsive_control('lc1_img_y', [
            'label' => 'Image Offset Y (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -100, 'max' => 100]],
            'default' => ['unit' => 'px', 'size' => 0],
            'selectors' => ['{{WRAPPER}} .sys-c1 img' => 'bottom: {{SIZE}}{{UNIT}};'],
        ]);

        $this->add_control('lc2_title', ['label' => 'Card 2 Title', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Metabolic<br>Insight']);
        $this->add_control('lc2_desc', ['label' => 'Card 2 Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'In-depth analysis of thyroid, insulin, glucose, lipids, vitamin levels, and more.']);
        $this->add_control('lc2_img', ['label' => 'Card 2 Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $this->add_control('lc2_icon', [
            'label' => 'Card 2 Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-chart-line',
                'library' => 'fa-solid',
            ],
        ]);
        $this->add_control('lc2_icon_color', [
            'label' => 'Icon Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sys-c2 .sys-icon-circle i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sys-c2 .sys-icon-circle svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                '{{WRAPPER}} .sys-c2 .sys-icon-circle' => 'color: {{VALUE}};',
            ]
        ]);
        $this->add_control('lc2_icon_bg', ['label' => 'Icon BG', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .sys-c2 .sys-icon-circle' => 'background-color: {{VALUE}};']]);

        $this->add_responsive_control('lc2_img_scale', [
            'label' => 'Image Scale (px/%)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                '%' => ['min' => 50, 'max' => 200],
                'px' => ['min' => 100, 'max' => 600],
            ],
            'default' => [
                'unit' => '%',
                'size' => 135,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 300,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 250,
            ],
            'selectors' => ['{{WRAPPER}} .sys-c2 img' => 'height: {{SIZE}}{{UNIT}};'],
        ]);
        $this->add_responsive_control('lc2_img_x', [
            'label' => 'Image Offset X (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -200, 'max' => 200]],
            'default' => ['unit' => 'px', 'size' => -80],
            'selectors' => ['{{WRAPPER}} .sys-c2 img' => 'left: {{SIZE}}{{UNIT}};'],
        ]);
        $this->add_responsive_control('lc2_img_y', [
            'label' => 'Image Offset Y (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -100, 'max' => 100]],
            'default' => ['unit' => 'px', 'size' => 0],
            'selectors' => ['{{WRAPPER}} .sys-c2 img' => 'bottom: {{SIZE}}{{UNIT}};'],
        ]);

        $this->end_controls_section();


        // Small Cards
        $this->start_controls_section(
            'section_small_cards',
            [
                'label' => esc_html__('Small Cards (Bot Grid)', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('sc1_title', ['label' => 'Small Card 1 Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Peptides']);
        $this->add_control('sc1_desc', ['label' => 'Small Card 1 Desc', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Science-backed peptides for skin, recovery, and longevity.']);
        $this->add_control('sc1_icon', [
            'label' => 'Small Card 1 Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-tint',
                'library' => 'fa-solid',
            ],
        ]);
        $this->add_control('sc1_icon_color', [
            'label' => 'Icon Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(1) .sys-icon-circle i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(1) .sys-icon-circle svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(1) .sys-icon-circle' => 'color: {{VALUE}};',
            ]
        ]);
        $this->add_control('sc1_icon_bg', ['label' => 'Icon BG', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(1) .sys-icon-circle' => 'background-color: {{VALUE}};']]);

        $this->add_control('sc2_title', ['label' => 'Small Card 2 Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Hormone Therapy']);
        $this->add_control('sc2_desc', ['label' => 'Small Card 2 Desc', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Personalized HRT to help you feel balanced and energized.']);
        $this->add_control('sc2_icon', [
            'label' => 'Small Card 2 Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-heartbeat',
                'library' => 'fa-solid',
            ],
        ]);
        $this->add_control('sc2_icon_color', [
            'label' => 'Icon Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(2) .sys-icon-circle i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(2) .sys-icon-circle svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(2) .sys-icon-circle' => 'color: {{VALUE}};',
            ]
        ]);
        $this->add_control('sc2_icon_bg', ['label' => 'Icon BG', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(2) .sys-icon-circle' => 'background-color: {{VALUE}};']]);

        $this->add_control('sc3_title', ['label' => 'Small Card 3 Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Weight Management']);
        $this->add_control('sc3_desc', ['label' => 'Small Card 3 Desc', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Medical-grade solutions for sustainable weight loss.']);
        $this->add_control('sc3_icon', [
            'label' => 'Small Card 3 Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-weight',
                'library' => 'fa-solid',
            ],
        ]);
        $this->add_control('sc3_icon_color', [
            'label' => 'Icon Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(3) .sys-icon-circle i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(3) .sys-icon-circle svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                '{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(3) .sys-icon-circle' => 'color: {{VALUE}};',
            ]
        ]);
        $this->add_control('sc3_icon_bg', ['label' => 'Icon BG', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .sys-grid-bot .sys-card-sm:nth-child(3) .sys-icon-circle' => 'background-color: {{VALUE}};']]);

        $this->end_controls_section();


        // Button
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Button', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Get Started']);
        $this->add_control('btn_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icons',
            [
                'label' => esc_html__('Icons Style', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__('Arrow Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sys-arrow-down' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-wellness">
            <section class="section am-home-container">
                <div class="text-center">
                    <h2 class="serif text-gold">
                        <?php echo nl2br(wp_kses_post($settings['top_heading'])); ?>
                    </h2>
                    <div class="sys-arrow-down"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <polyline points="19 12 12 19 5 12"></polyline>
                        </svg></div>
                    <h2 class="serif"><?php echo nl2br(wp_kses_post($settings['main_heading'])); ?></h2>
                    <p style="max-width: 600px; margin: 0 auto 48px;">
                        <?php echo nl2br(wp_kses_post($settings['description'])); ?>
                    </p>
                </div>

                <div class="sys-grid-top">
                    <!-- LC1 -->
                    <div class="sys-card-lg sys-c1">
                        <?php if (!empty($settings['lc1_img']['url'])): ?>
                            <img src="<?php echo esc_url($settings['lc1_img']['url']); ?>" alt="Card Image">
                        <?php endif; ?>
                        <div class="sys-card-lg-content">
                            <div class="sys-icon-circle">
                                <?php
                                if (!empty($settings['lc1_icon']['value'])) {
                                    \Elementor\Icons_Manager::render_icon($settings['lc1_icon'], ['aria-hidden' => 'true']);
                                }
                                ?>
                            </div>
                            <h3 class="serif"><?php echo nl2br(wp_kses_post($settings['lc1_title'])); ?></h3>
                                <p>
                                    <?php echo nl2br(wp_kses_post($settings['lc1_desc'])); ?>
                                </p>
                        </div>
                    </div>
                    <!-- LC2 -->
                    <div class="sys-card-lg sys-c2 text-white">
                        <?php if (!empty($settings['lc2_img']['url'])): ?>
                            <img src="<?php echo esc_url($settings['lc2_img']['url']); ?>" alt="Card Image">
                        <?php endif; ?>
                        <div class="sys-card-lg-content">
                            <div class="sys-icon-circle">
                                <?php
                                if (!empty($settings['lc2_icon']['value'])) {
                                    \Elementor\Icons_Manager::render_icon($settings['lc2_icon'], ['aria-hidden' => 'true']);
                                }
                                ?>
                            </div>
                            <h3 class="serif">
                                <?php echo nl2br(wp_kses_post($settings['lc2_title'])); ?>
                            </h3>
                            <p>
                                <?php echo nl2br(wp_kses_post($settings['lc2_desc'])); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="sys-grid-bot">
                    <!-- SC1 -->
                    <div class="sys-card-sm">
                        <div class="sys-icon-circle">
                            <?php
                            if (!empty($settings['sc1_icon']['value'])) {
                                \Elementor\Icons_Manager::render_icon($settings['sc1_icon'], ['aria-hidden' => 'true']);
                            }
                            ?>
                        </div>
                        <h3><?php echo wp_kses_post($settings['sc1_title']); ?></h3>
                        <p><?php echo wp_kses_post($settings['sc1_desc']); ?></p>
                    </div>
                    <!-- SC2 -->
                    <div class="sys-card-sm">
                        <div class="sys-icon-circle">
                            <?php
                            if (!empty($settings['sc2_icon']['value'])) {
                                \Elementor\Icons_Manager::render_icon($settings['sc2_icon'], ['aria-hidden' => 'true']);
                            }
                            ?>
                        </div>
                        <h3><?php echo wp_kses_post($settings['sc2_title']); ?></h3>
                        <p><?php echo wp_kses_post($settings['sc2_desc']); ?></p>
                    </div>
                    <!-- SC3 -->
                    <div class="sys-card-sm">
                        <div class="sys-icon-circle">
                            <?php
                            if (!empty($settings['sc3_icon']['value'])) {
                                \Elementor\Icons_Manager::render_icon($settings['sc3_icon'], ['aria-hidden' => 'true']);
                            }
                            ?>
                        </div>
                        <h3><?php echo wp_kses_post($settings['sc3_title']); ?></h3>
                        <p><?php echo wp_kses_post($settings['sc3_desc']); ?></p>
                    </div>
                </div>

                <?php if (!empty($settings['btn_text'])): ?>
                    <div class="text-center">
                        <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="btn btn-dark">
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </section>
        </div>
        <?php
    }
}
