<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Hero Widget
 */
class AM_Hair_Hero_Widget extends \Elementor\Widget_Base
{

    const VERSION = '1.0.0';

    public function get_name()
    {
        return 'am_hair_hero';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Hero', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-image-before-after';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_keywords()
    {
        return ['hero', 'amazing meds', 'hair'];
    }

    public function get_style_depends()
    {
        wp_register_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_register_style('am-hair-css', plugins_url('../assets/css/widgets/hair-global.css', __FILE__));
        return ['am-hair-css', 'swiper-css'];
    }

    public function get_script_depends()
    {
        // Enqueue Swiper if not already enqueued by theme
        wp_register_script('swiper-bundle', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.1.1', true);
        wp_register_script('am-hero-slider', plugins_url('../assets/js/widgets/hero-slider.js', __FILE__), ['jquery', 'swiper-bundle'], self::VERSION, true);

        return ['am-hero-slider'];
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
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('What If Your Hair Loss Is a Symptom, <em>Not the Problem?</em>', 'amazing-meds-elementor'),
                'placeholder' => esc_html__('Enter title (HTML em tags allowed)', 'amazing-meds-elementor'),
                'rows' => 5,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('The only women\'s hair loss protocol that investigates the hormonal root cause other companies ignore.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'badges',
            [
                'label' => esc_html__('Badges', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Trusted by 1,000+ Hormone Patients', 'amazing-meds-elementor'),
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    ['text' => 'Trusted by 1,000+ Hormone Patients'],
                    ['text' => 'Clinician-Prescribed'],
                    ['text' => 'Dose Escalation Protocol'],
                    ['text' => 'Hormone Screening Pathway'],
                    ['text' => 'Insurance-Eligible Labs'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'pricing_label',
            [
                'label' => esc_html__('Pricing Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Start Your Protocol', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$69', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'price_note',
            [
                'label' => esc_html__('Price Note', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('First month starter supply. Includes provider consult.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'price_sub',
            [
                'label' => esc_html__('Price Sub', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Full-strength quarterly shipping begins at Day 30 ($89/mo). Cancel anytime.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Start Your Hair Assessment', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('3-IN-1 CAPSULE', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_subtitle',
            [
                'label' => esc_html__('Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('SPIRO + MINOXIDIL + BIOTIN', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Choose Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => esc_html__('3-in-1 Capsule', 'amazing-meds-elementor'),
                        'slide_subtitle' => esc_html__('Spiro + Minoxidil + Biotin', 'amazing-meds-elementor'),
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->end_controls_section();

        // Problem Strip Section
        $this->start_controls_section(
            'section_problems',
            [
                'label' => esc_html__('Problem Strip', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'problem_strip_label',
            [
                'label' => esc_html__('Section Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Does this look familiar?', 'amazing-meds-elementor'),
            ]
        );

        $problem_repeater = new \Elementor\Repeater();

        $problem_repeater->add_control(
            'problem_text',
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Widening Part', 'amazing-meds-elementor'),
            ]
        );

        $problem_repeater->add_control(
            'problem_image',
            [
                'label' => esc_html__('Icon/Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'problems',
            [
                'label' => esc_html__('Problem Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $problem_repeater->get_controls(),
                'default' => [
                    [
                        'problem_text' => 'Widening Part',
                    ],
                    [
                        'problem_text' => 'Thinning Crown',
                    ],
                    [
                        'problem_text' => 'Excess Shedding',
                    ],
                    [
                        'problem_text' => 'Receding Temples',
                    ],
                ],
                'title_field' => '{{{ problem_text }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--white am-hero">
            <div class="am-container">
                <div class="am-hero-grid">
                    <!-- Left: Content -->
                    <div class="am-hero-text">
                        <div class="am-hero-title">
                            <h1><?php echo $settings['title']; ?></h1>
                        </div>
                        <div class="am-hero-subtitle">
                            <?php echo $settings['subtitle']; ?>
                        </div>

                        <?php if (!empty($settings['badges'])): ?>
                            <div class="am-hero-badges">
                                <?php foreach ($settings['badges'] as $badge): ?>
                                    <span class="am-badge">
                                        <?php echo esc_html($badge['text']); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="am-hero-pricing">
                            <div class="price-label">
                                <?php echo esc_html($settings['pricing_label']); ?>
                            </div>
                            <div class="price">
                                <?php echo esc_html($settings['price']); ?>
                            </div>
                            <div class="price-note">
                                <?php echo esc_html($settings['price_note']); ?>
                            </div>
                            <div class="price-sub">
                                <?php echo esc_html($settings['price_sub']); ?>
                            </div>
                            <a href="<?php echo esc_url($settings['button_url']['url']); ?>"
                                class="am-btn am-btn--primary am-btn--lg">
                                <?php echo esc_html($settings['button_text']); ?>
                            </a>
                        </div>
                    </div>

                    <div class="am-hero-product">
                        <div class="am-hero-slider-main-container">
                            <div class="swiper am-hero-main-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['slides'] as $slide): ?>
                                        <div class="swiper-slide">
                                            <div class="am-slide-visual">
                                                <div class="am-slide-image">
                                                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($slide, 'slide_image'); ?>
                                                </div>
                                                <div class="am-slide-label">
                                                    <?php echo esc_html($slide['slide_title']); ?>
                                                    <span><?php echo esc_html($slide['slide_subtitle']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Product thumbnails -->
                        <div class="am-hero-thumb-container">
                            <div class="swiper am-hero-thumbs-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['slides'] as $slide): ?>
                                        <div class="swiper-slide">
                                            <div class="am-thumb-item">
                                                <?php if (!empty($slide['slide_image']['url'])): ?>
                                                    <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="">
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Problem-area strip -->
                <div class="am-problem-strip">
                    <div class="strip-label">
                        <?php echo esc_html($settings['problem_strip_label']); ?>
                    </div>
                    <div class="am-problem-items">
                        <?php foreach ($settings['problems'] as $problem): ?>
                            <div class="am-problem-item">
                                <div class="am-problem-circle shadow-sm">
                                    <div class="am-problem-circle-inner">
                                        <?php if (!empty($problem['problem_image']['url'])): ?>
                                            <img src="<?php echo esc_url($problem['problem_image']['url']); ?>"
                                                alt="<?php echo esc_attr($problem['problem_text']); ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="problem-label">
                                    <?php echo wp_kses($problem['problem_text'], ['br' => []]); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
