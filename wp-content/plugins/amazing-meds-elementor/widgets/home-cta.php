<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_CTA_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_cta';
    }

    public function get_title()
    {
        return esc_html__('AM Home Bottom CTA', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-button';
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

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Feel better with care that<br>looks at the full picture']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Book your consultation and discover a more complete approach to hormone optimization.']);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('text', ['label' => 'Text', 'type' => \Elementor\Controls_Manager::TEXT]);
        $repeater->add_control('svg', ['label' => 'Icon (SVG)', 'type' => \Elementor\Controls_Manager::WYSIWYG]);

        $this->add_control(
            'features',
            [
                'label' => 'Features List',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Provider-reviewed', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>'],
                    ['text' => 'Free discreet shipping', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>'],
                    ['text' => '4.8/5 rating', 'svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control('btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Book a Consultation']);
        $this->add_control('btn_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-cta">
            <section class="section am-home-container">
                <div class="bottom-cta">
                    <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                    <p style="color: #D6CEC3; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                        <?php echo wp_kses_post($settings['subtitle']); ?>
                    </p>

                    <div class="cta-feats">
                        <?php if (!empty($settings['features'])): ?>
                            <?php foreach ($settings['features'] as $feat): ?>
                                <span>
                                    <?php echo $feat['svg']; ?>
                                    <?php echo esc_html($feat['text']); ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($settings['btn_text'])): ?>
                        <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="btn btn-tan">
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
