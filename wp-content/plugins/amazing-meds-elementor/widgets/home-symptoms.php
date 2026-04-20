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
        $repeater->add_control('text', ['label' => 'Symptom Text', 'type' => \Elementor\Controls_Manager::TEXTAREA]);
        $repeater->add_control(
            'icon',
            [
                'label' => 'Icon',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'symptoms',
            [
                'label' => 'Symptoms List',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Low energy', 'icon' => ['value' => 'fas fa-bolt', 'library' => 'fa-solid']],
                    ['text' => 'Hormonal imbalance', 'icon' => ['value' => 'fas fa-dna', 'library' => 'fa-solid']],
                    ['text' => 'Perimenopause / menopause symptoms', 'icon' => ['value' => 'fas fa-venus', 'library' => 'fa-solid']],
                    ['text' => 'Brain fog', 'icon' => ['value' => 'fas fa-cloud', 'library' => 'fa-solid']],
                    ['text' => 'Low libido', 'icon' => ['value' => 'fas fa-heart', 'library' => 'fa-solid']],
                    ['text' => 'Weight gain or difficulty losing weight', 'icon' => ['value' => 'fas fa-weight', 'library' => 'fa-solid']],
                    ['text' => 'Testosterone-related concerns', 'icon' => ['value' => 'fas fa-mars', 'library' => 'fa-solid']],
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
                                <?php
                                if (!empty($pill['icon']['value'])) {
                                    \Elementor\Icons_Manager::render_icon($pill['icon'], ['aria-hidden' => 'true']);
                                }
                                ?>
                                <?php echo nl2br(esc_html($pill['text'])); ?>
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
