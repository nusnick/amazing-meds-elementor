<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Symptoms_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_symptoms';
    }

    public function get_title()
    {
        return esc_html__('AM Home Symptoms', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-tags';
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

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What can we help you improve?']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'If you\'re experiencing any of the following, a deeper look at your hormones and metabolism may help.']);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('text', ['label' => 'Symptom Text', 'type' => \Elementor\Controls_Manager::TEXT]);
        $repeater->add_control('svg', ['label' => 'Icon (SVG)', 'type' => \Elementor\Controls_Manager::WYSIWYG]);

        $this->add_control(
            'symptoms',
            [
                'label' => 'Symptoms List',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Low energy', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>'],
                    ['text' => 'Hormonal imbalance', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 3v18M3 10l9-7 9 7M6 10v4a6 6 0 0 0 12 0v-4"></path></svg>'],
                    ['text' => 'Perimenopause / menopause symptoms', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="10" r="6"></circle><line x1="12" y1="16" x2="12" y2="22"></line><line x1="9" y1="19" x2="15" y2="19"></line></svg>'],
                    ['text' => 'Brain fog', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 3a6 6 0 0 0-6 6c0 1.5 1 3 1 5h10c0-2 1-3.5 1-5a6 6 0 0 0-6-6z"></path></svg>'],
                    ['text' => 'Low libido', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>'],
                    ['text' => 'Weight gain or difficulty losing weight', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="4" y="4" width="16" height="16" rx="2"></rect><circle cx="12" cy="14" r="3"></circle><path d="M12 4v4"></path></svg>'],
                    ['text' => 'Testosterone-related concerns', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="10" cy="14" r="6"></circle><line x1="14.24" y1="9.76" x2="21" y2="3"></line></svg>'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control('btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Get Started']);
        $this->add_control('btn_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-symptoms">
            <section class="section am-home-container text-center">
                <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p><?php echo wp_kses_post($settings['subtitle']); ?></p>

                <?php if (!empty($settings['symptoms'])): ?>
                    <div class="symp-tags">
                        <?php foreach ($settings['symptoms'] as $pill): ?>
                            <span class="s-tag">
                                <?php echo $pill['svg']; ?>
                                <?php echo esc_html($pill['text']); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

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
