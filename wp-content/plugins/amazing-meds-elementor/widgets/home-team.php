<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Team_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_team';
    }

    public function get_title()
    {
        return esc_html__('AM Home Team', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-person';
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
        // General
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Meet Your Care Team']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Our team is made up of experienced medical professionals focused on delivering thoughtful, personalized care...']);
        $this->end_controls_section();

        // Main Doctor
        $this->start_controls_section(
            'section_main_doc',
            [
                'label' => esc_html__('Main Doctor', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('doc_img', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $this->add_responsive_control('doc_img_scale', [
            'label' => 'Image Scale (px/%)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                '%' => ['min' => 50, 'max' => 200],
                'px' => ['min' => 100, 'max' => 1000],
            ],
            'selectors' => [
                '{{WRAPPER}} .t-img-lg img' => 'height: {{SIZE}}{{UNIT}}; width: auto; max-width: none;',
            ],
        ]);
        $this->add_responsive_control('doc_img_x', [
            'label' => 'Image Offset X (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -300, 'max' => 300]],
            'selectors' => [
                '{{WRAPPER}} .t-img-lg img' => 'left: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->add_responsive_control('doc_img_y', [
            'label' => 'Image Offset Y (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -300, 'max' => 300]],
            'selectors' => [
                '{{WRAPPER}} .t-img-lg img' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->add_control('doc_icon', [
            'label' => esc_html__('Top Icon', 'amazing-meds-elementor'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-user-md',
                'library' => 'fa-solid',
            ],
        ]);
        $this->add_control('doc_icon_color', [
            'label' => 'Icon Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .team-top-content .sys-icon-circle i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .team-top-content .sys-icon-circle svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
            ]
        ]);
        $this->add_control('doc_icon_bg', [
            'label' => 'Icon Background',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .team-top-content .sys-icon-circle' => 'background-color: {{VALUE}};',
            ]
        ]);
        $this->add_control('doc_name', ['label' => 'Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Dr. Jennifer Frangos']);
        $this->add_control('doc_titles', ['label' => 'Titles (Supports HTML)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'D.O., DABOM Board-Certified Family & Obesity Medicine Specialist<br><span style="color: var(--accent-gold);">Integrative & Functional Medicine</span>']);
        $this->add_control('doc_about_title', ['label' => 'About Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'About']);
        $this->add_control('doc_about_text', ['label' => 'About Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Meet Dr. Jennifer Frangos. She isn\'t your typical doctor...']);
        $this->add_control('doc_spec_title', ['label' => 'Areas Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Areas of Specialty']);
        $this->add_control('doc_spec_text', ['label' => 'Areas Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Weight Management & Metabolism, Hormone Health, Whole-Body Care.']);
        $this->end_controls_section();

        // Team members
        $this->start_controls_section(
            'section_team',
            [
                'label' => esc_html__('Team Members', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control('image', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $repeater->add_responsive_control('image_scale', [
            'label' => 'Image Scale (px/%)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                '%' => ['min' => 50, 'max' => 200],
                'px' => ['min' => 100, 'max' => 800],
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .t-img-sm img' => 'height: {{SIZE}}{{UNIT}}; width: auto; max-width: none;',
            ],
        ]);
        $repeater->add_responsive_control('image_x', [
            'label' => 'Image Offset X (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -200, 'max' => 200]],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .t-img-sm img' => 'left: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $repeater->add_responsive_control('image_y', [
            'label' => 'Image Offset Y (px)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => -200, 'max' => 200]],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .t-img-sm img' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $repeater->add_control('name', ['label' => 'Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Lynn']);
        $repeater->add_control('title', ['label' => 'Title (Supports HTML)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Peptide & HRT Nurse Practitioner<br><span style="color: var(--accent-gold);">Board-Certified in Internal Medicine</span>']);
        $repeater->add_control('desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Lynn specializes in hormone replacement...']);
        $this->add_control(
            'team_members',
            [
                'label' => 'Members',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['name' => 'Lynn'],
                    ['name' => 'Rachel']
                ],
                'title_field' => '{{{ name }}}',
            ]
        );
        $this->end_controls_section();

        // Stats Panel
        $this->start_controls_section(
            'section_stats',
            [
                'label' => esc_html__('Stats Banner', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        for ($i = 1; $i <= 3; $i++) {
            $this->add_control("stat_v_$i", ['label' => "Stat $i Value", 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '80']);
            $this->add_control("stat_s_$i", ['label' => "Stat $i Symbol", 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '+']);
            $this->add_control("stat_t_$i", ['label' => "Stat $i Text (HTML)", 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Licensed Providers<br><span style="opacity: 0.6;">Across all 50 states</span>']);
            $this->add_control("hr_$i", ['type' => \Elementor\Controls_Manager::DIVIDER]);
        }
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-team">
            <section class="section am-home-container">
                <h2 class="serif text-center"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p class="text-center" style="max-width: 650px; margin: 0 auto 48px;">
                    <?php echo wp_kses_post($settings['subtitle']); ?>
                </p>

                <div class="team-top">
                    <div class="t-img-lg">
                        <div class="t-img-bg"></div>
                        <?php if (!empty($settings['doc_img']['url'])): ?>
                            <img src="<?php echo esc_url($settings['doc_img']['url']); ?>"
                                alt="<?php echo esc_attr($settings['doc_name']); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="team-top-content">
                        <div class="sys-icon-circle" style="margin-bottom: 24px;">
                            <?php \Elementor\Icons_Manager::render_icon($settings['doc_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <h3 class="serif" style="margin-bottom: 8px; font-size: 32px;">
                            <?php echo wp_kses_post($settings['doc_name']); ?>
                        </h3>
                        <p style="font-size: 14px; margin-bottom: 32px;"><?php echo wp_kses_post($settings['doc_titles']); ?>
                        </p>

                        <h4 style="font-size: 18px; margin-bottom: 8px; font-weight: 700; font-family: var(--font-sans);">
                            <?php echo wp_kses_post($settings['doc_about_title']); ?>
                        </h4>
                        <p style="font-size: 14px; margin-bottom: 32px;">
                            <?php echo wp_kses_post($settings['doc_about_text']); ?>
                        </p>

                        <h4 style="font-size: 18px; margin-bottom: 8px; font-weight: 700; font-family: var(--font-sans);">
                            <?php echo wp_kses_post($settings['doc_spec_title']); ?>
                        </h4>
                        <p style="font-size: 14px; margin-bottom: 32px;"><?php echo wp_kses_post($settings['doc_spec_text']); ?>
                        </p>

                        <!-- Social defaults -->
                        <div class="team-social">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18.9 1.153h3.68l-8.04 9.19L24 22.846h-7.4l-5.8-7.584-6.64 7.584H.47l8.6-9.83L0 1.154h7.59l5.24 6.932ZM17.61 20.644h2.04L6.486 3.24H4.298Z" />
                            </svg>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M20.45 20.452h-3.55v-5.569c0-1.328-.03-3.037-1.85-3.037-1.85 0-2.14 1.445-2.14 2.939v5.667H9.35V9h3.41v1.561h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.455v6.286zM5.34 7.433c-1.14 0-2.06-.926-2.06-2.065 0-1.138.92-2.063 2.06-2.063 1.14 0 2.06.925 2.06 2.063 0 1.139-.92 2.065-2.06 2.065zm1.78 13.019H3.55V9h3.56v11.452zM22.23 0H1.77C.79 0 0 .774 0 1.729v20.542C0 23.227.79 24 1.77 24h20.45C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.22 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="team-bot">
                    <?php if (!empty($settings['team_members'])): ?>
                        <?php foreach ($settings['team_members'] as $index => $mem):
                            $repeater_setting_key = $this->get_repeater_setting_key('name', 'team_members', $index);
                            $this->add_render_attribute($repeater_setting_key, 'class', 't-card-sm');
                            $this->add_render_attribute($repeater_setting_key, 'class', 'elementor-repeater-item-' . $mem['_id']);
                            ?>
                            <div <?php echo $this->get_render_attribute_string($repeater_setting_key); ?>>
                                <div class="t-img-sm">
                                    <div class="t-img-bg"></div>
                                    <?php if (!empty($mem['image']['url'])): ?>
                                        <img src="<?php echo esc_url($mem['image']['url']); ?>" alt="<?php echo esc_attr($mem['name']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="t-card-sm-content">
                                    <h3 class="serif" style="font-size: 32px; margin-bottom: 8px;">
                                        <?php echo wp_kses_post($mem['name']); ?>
                                    </h3>
                                    <p style="font-size: 14px; margin-bottom: 12px; line-height: 1.4;">
                                        <?php echo wp_kses_post($mem['title']); ?>
                                    </p>
                                    <div class="t-card-sep"></div>
                                    <p style="font-size: 14px; margin: 0; color: var(--text-muted); line-height: 1.6;">
                                        <?php echo wp_kses_post($mem['desc']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="stats-banner">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div class="stat">
                            <h3 class="serif">
                                <?php echo esc_html($settings["stat_v_$i"]); ?><span><?php echo esc_html($settings["stat_s_$i"]); ?></span>
                            </h3>
                            <p><?php echo wp_kses_post($settings["stat_t_$i"]); ?></p>
                        </div>
                    <?php endfor; ?>
                </div>

            </section>
        </div>
        <?php
    }
}
