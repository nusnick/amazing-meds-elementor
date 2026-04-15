<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Women_Care_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_women_care';
    }

    public function get_title()
    {
        return esc_html__('AM Home Women Care', 'amazing-meds-elementor');
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

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Personalized Hormone<br>Care for Women']);
        $this->add_control('description', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Hormone health for women is often overlooked or oversimplified. At Amazing Meds, we provide personalized care based on your labs, symptoms, and goals—including testosterone therapy for women when clinically appropriate.']);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('text', ['label' => 'List Item text', 'type' => \Elementor\Controls_Manager::TEXT]);
        $this->add_control(
            'items',
            [
                'label' => 'Checklist Items',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Multiple treatment delivery options'],
                    ['text' => 'Care tailored to your body and needs'],
                    ['text' => 'Ongoing monitoring and adjustments'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control('btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Explore Women\'s Care']);
        $this->add_control('btn_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->add_control('image', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-women-care">
            <section class="am-home-container section">
                <div class="women-card">
                    <div>
                        <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                        <p><?php echo wp_kses_post($settings['description']); ?></p>

                        <?php if (!empty($settings['items'])): ?>
                            <ul class="check-list">
                                <?php foreach ($settings['items'] as $item): ?>
                                    <li><?php echo wp_kses_post($item['text']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($settings['btn_text'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="btn btn-dark"
                                style="margin-top: 16px;">
                                <?php echo esc_html($settings['btn_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="wc-img">
                        <?php if (!empty($settings['image']['url'])): ?>
                            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="Women Care">
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
