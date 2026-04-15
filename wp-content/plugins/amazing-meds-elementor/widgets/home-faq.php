<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_FAQ_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_faq';
    }

    public function get_title()
    {
        return esc_html__('AM Home FAQ', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-help-o';
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

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Frequently Asked Questions']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Have questions? We have answers.']);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('q', ['label' => 'Question', 'type' => \Elementor\Controls_Manager::TEXT]);
        $repeater->add_control('a', ['label' => 'Answer', 'type' => \Elementor\Controls_Manager::TEXTAREA]);
        $repeater->add_control('is_open', ['label' => 'Open by default?', 'type' => \Elementor\Controls_Manager::SWITCHER, 'return_value' => 'open', 'default' => '']);

        $this->add_control(
            'faqs',
            [
                'label' => 'Questions',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['q' => 'What is included in the Care Plan?', 'a' => 'Your Care Plan includes lab analysis, personalized treatment, quarterly monitoring, and ongoing provider support.', 'is_open' => 'open'],
                    ['q' => 'Do you accept insurance?', 'a' => 'Yes, we accept most major insurance plans. Our team handles prior authorizations and paperwork.'],
                    ['q' => 'Do you send prescriptions to local pharmacies?', 'a' => 'Yes, we can route your prescriptions to the most convenient local pharmacy or mail-order facility for you.'],
                    ['q' => 'What makes Amazing Meds different?', 'a' => 'We look at the whole picture—combining comprehensive metabolic and hormone mapping with continuous care advocacy.'],
                ],
                'title_field' => '{{{ q }}}',
            ]
        );

        $this->add_control('contact_text', ['label' => 'Bottom Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Still have questions?']);
        $this->add_control('contact_link_text', ['label' => 'Link Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Contact Us']);
        $this->add_control('contact_url', ['label' => 'Link URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-faq">
            <section class="section am-home-container text-center">
                <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p><?php echo wp_kses_post($settings['subtitle']); ?></p>

                <div class="faq-wrap">
                    <?php if (!empty($settings['faqs'])): ?>
                        <?php foreach ($settings['faqs'] as $faq): ?>
                            <details <?php echo $faq['is_open'] ? 'open' : ''; ?>>
                                <summary><?php echo esc_html($faq['q']); ?></summary>
                                <p><?php echo wp_kses_post($faq['a']); ?></p>
                            </details>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div style="margin-top: 32px; font-size: 14px; color: var(--text-muted);">
                    <?php echo esc_html($settings['contact_text']); ?>
                    <a href="<?php echo esc_url($settings['contact_url']['url']); ?>"
                        style="color: var(--text-dark); font-weight: 500;">
                        <?php echo esc_html($settings['contact_link_text']); ?>
                    </a>
                </div>
            </section>
        </div>
        <?php
    }
}
