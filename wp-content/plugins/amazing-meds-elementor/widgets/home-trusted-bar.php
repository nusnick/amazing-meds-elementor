<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Trusted_Bar_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_trusted_bar';
    }

    public function get_title()
    {
        return esc_html__('AM Home Trusted Bar', 'amazing-meds-elementor');
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
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('We proudly accept most major insurance plans', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Logo Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'logos',
            [
                'label' => esc_html__('Logos', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-trusted-bar">
            <div class="ins-banner am-home-container section">
                <p style="margin-bottom: 0;">
                    <?php echo wp_kses_post($settings['title']); ?>
                </p>
                <?php if (!empty($settings['logos'])): ?>
                    <div class="ins-logos">
                        <?php foreach ($settings['logos'] as $item): ?>
                            <?php if (!empty($item['image']['url'])): ?>
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="Insurance Logo">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
