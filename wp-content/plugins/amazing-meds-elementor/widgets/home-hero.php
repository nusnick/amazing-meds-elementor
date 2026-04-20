<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Hero_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_hero';
    }

    public function get_title()
    {
        return esc_html__('AM Home Hero', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-image-box';
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

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Feel Better With a<br>Complete Approach<br>to Hormone Care', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Amazing Meds goes beyond basic hormone checks with a full-system approach through our Care Plan—combining comprehensive labs, personalized treatment, and ongoing medical support.', 'amazing-meds-elementor'),
            ]
        );

        // Features Repeater
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Item', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'hero_feats',
            [
                'label' => esc_html__('Features List', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Insurance accepted'],
                    ['text' => 'Available in all 50 states'],
                    ['text' => 'Care for men and women'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'btn1_text',
            [
                'label' => esc_html__('Button 1 Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Consultation', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn1_url',
            [
                'label' => esc_html__('Button 1 URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#'],
            ]
        );

        $this->add_control(
            'btn2_text',
            [
                'label' => esc_html__('Button 2 Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn How It Works', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn2_url',
            [
                'label' => esc_html__('Button 2 URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#'],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'hr_review',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'review_rating',
            [
                'label' => esc_html__('Review Rating', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 0.1,
                'default' => 4.8,
            ]
        );

        $this->add_control(
            'review_text',
            [
                'label' => esc_html__('Review Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '12,450 Reviews',
            ]
        );

        $av_repeater = new \Elementor\Repeater();
        $av_repeater->add_control(
            'av_img',
            [
                'label' => esc_html__('Avatar Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'review_avatars',
            [
                'label' => esc_html__('Review Avatars', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $av_repeater->get_controls(),
                'default' => [
                    ['av_img' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                    ['av_img' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                    ['av_img' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style_hero',
            [
                'label' => esc_html__('Style', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feat_icon_color',
            [
                'label' => esc_html__('Features Icon Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-feats span i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-feats span svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-hero">
            <section class="hero-sec am-home-container section">
                <div class="hero-grid">
                    <div>
                        <h1>
                            <?php echo nl2br(wp_kses_post($settings['title'])); ?>
                        </h1>
                        <p>
                            <?php echo nl2br(wp_kses_post($settings['subtitle'])); ?>
                        </p>

                        <div class="hero-actions">
                            <a href="<?php echo esc_url($settings['btn1_url']['url']); ?>" class="btn btn-dark">
                                <?php echo esc_html($settings['btn1_text']); ?>
                            </a>
                            <a href="<?php echo esc_url($settings['btn2_url']['url']); ?>" class="btn btn-white">
                                <?php echo esc_html($settings['btn2_text']); ?>
                            </a>
                        </div>

                        <?php if (!empty($settings['hero_feats'])): ?>
                            <div class="hero-feats">
                                <?php foreach ($settings['hero_feats'] as $feat): ?>
                                    <span>
                                        <?php
                                        if (!empty($feat['icon']['value'])) {
                                            \Elementor\Icons_Manager::render_icon($feat['icon'], ['aria-hidden' => 'true']);
                                        }
                                        ?>
                                        <?php echo esc_html($feat['text']); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="review-badge">
                            <?php if (!empty($settings['review_avatars'])): ?>
                                <div class="review-avs">
                                    <?php foreach ($settings['review_avatars'] as $av): ?>
                                        <?php if (!empty($av['av_img']['url'])): ?>
                                            <img src="<?php echo esc_url($av['av_img']['url']); ?>" alt="Avatar">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <div style="font-size: 14px; font-weight: 600;">
                                    <span style="color: var(--accent-gold);">
                                        <?php
                                        $rating = (float)($settings['review_rating'] ?? 5);
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= floor($rating)) {
                                                echo '★';
                                            } elseif ($i - 0.5 <= $rating) {
                                                echo '★'; // Simplified for now, or could use half star SVG
                                            } else {
                                                echo '☆';
                                            }
                                        }
                                        ?>
                                    </span> 
                                    <?php echo esc_html($settings['review_rating']); ?>
                                </div>
                                <div style="font-size: 12px; color: var(--text-muted); text-decoration: underline;">
                                    <?php echo esc_html($settings['review_text']); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hero-visual">
                        <div class="hero-bg-shape"></div>
                        <div class="hero-pill-shape"></div>
                        <div class="hero-visual-img">
                            <?php if (!empty($settings['image']['url'])): ?>
                                <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="Hero image">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
