<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Hero Widget
 */
class AM_Membership_Hero_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_hero';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Hero', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-image-before-after';
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
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The System 5 Protocol™', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Stop Guessing with Your Hormones. Get the <em>Complete Picture.</em>', 'amazing-meds-elementor'),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Most telehealth clinics check one hormone, hand you a generic prescription, and ignore the rest of your body. We map all 5 critical systems so you actually feel better.', 'amazing-meds-elementor'),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'primary_button_text',
            [
                'label' => esc_html__('Primary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Your Free Consult', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'primary_button_url',
            [
                'label' => esc_html__('Primary Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'secondary_button_text',
            [
                'label' => esc_html__('Secondary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('See How It Works', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'secondary_button_url',
            [
                'label' => esc_html__('Secondary Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
                'default' => [
                    'url' => '#how-it-works',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'microcopy',
            [
                'label' => esc_html__('Microcopy', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Then, start your lab work for just a $75 deposit.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'trust_items',
            [
                'label' => esc_html__('Trust Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Start with a Free Call', 'amazing-meds-elementor'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon_svg',
                        'label' => esc_html__('Icon SVG Code', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'description' => esc_html__('Paste SVG code here (must contain no fill/stroke to inherit)', 'amazing-meds-elementor'),
                    ],
                ],
                'default' => [
                    [
                        'text' => 'Start with a Free Call',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'
                    ],
                    [
                        'text' => '45+ states',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>'
                    ],
                    [
                        'text' => 'Free shipping',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h2a2 2 0 012 2v6a2 2 0 01-2 2H6"/></svg>'
                    ],
                    [
                        'text' => 'Insurance accepted',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'hero_image',
            [
                'label' => esc_html__('Hero Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section--hero">
            <div class="container">
                <div class="hero-grid">
                    <div class="hero-content">
                        <?php if (!empty($settings['label'])): ?>
                            <div class="am-label">
                                <?php echo esc_html($settings['label']); ?>
                            </div>
                        <?php endif; ?>

                        <h1><?php echo $settings['title']; ?></h1>
                        <p class="hero-sub"><?php echo esc_html($settings['subtitle']); ?></p>

                        <div class="hero-buttons">
                            <?php if (!empty($settings['primary_button_text'])): ?>
                                <a href="<?php echo esc_url($settings['primary_button_url']['url']); ?>" class="am-btn--primary">
                                    <?php echo esc_html($settings['primary_button_text']); ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($settings['secondary_button_text'])): ?>
                                <a href="<?php echo esc_url($settings['secondary_button_url']['url']); ?>"
                                    class="am-btn--secondary">
                                    <?php echo esc_html($settings['secondary_button_text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($settings['microcopy'])): ?>
                            <p class="hero-microcopy"><?php echo esc_html($settings['microcopy']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['trust_items'])): ?>
                            <div class="hero-trust">
                                <?php foreach ($settings['trust_items'] as $item): ?>
                                    <div class="hero-trust-item">
                                        <div class="am-icon-circle">
                                            <?php echo $item['icon_svg']; ?>
                                        </div>
                                        <?php echo esc_html($item['text']); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="hero-image-area">
                        <?php if (!empty($settings['hero_image']['url'])): ?>
                            <div class="hero-image-wrapper">
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'hero_image'); ?>
                            </div>
                        <?php else: ?>
                            <div class="am-image-placeholder" style="aspect-ratio: 4/3.5;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="M21 15l-5-5L5 21" />
                                </svg>
                                <span>Hero lifestyle image</span>
                                <span class="img-note">Image Placeholder</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
