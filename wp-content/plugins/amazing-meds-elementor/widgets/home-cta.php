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
        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__('Icon', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => 'Features List',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Provider-reviewed'],
                    ['text' => 'Free discreet shipping'],
                    ['text' => '4.8/5 rating'],
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
                            <?php 
                            $count = count($settings['features']);
                            foreach ($settings['features'] as $index => $item): 
                            ?>
                                <span class="cta-feat-item">
                                    <?php 
                                    if (!empty($item['selected_icon']['value'])) {
                                        \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
                                    }
                                    ?>
                                    <?php echo esc_html($item['text']); ?>
                                </span>
                                <?php if ($index < $count - 1): ?>
                                    <div class="cta-divider"></div>
                                <?php endif; ?>
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
