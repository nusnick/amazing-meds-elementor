<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Problem_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_problem';
    }

    public function get_title()
    {
        return esc_html__('AM Home Problem', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-warning';
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
            'badge',
            [
                'label' => esc_html__('Badge', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The Problem', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Most hormone care clinics miss the full picture...', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description (supports HTML)', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Many clinics focus on a single hormone marker—but your symptoms rarely come from just one place.</p><p>Fatigue, weight gain, poor sleep, and low energy are often connected to a broader imbalance across your body. Treating one number without understanding the full system can lead to incomplete results.</p><p>At Amazing Meds, we take a more comprehensive approach—so you get care that actually addresses what\'s going on beneath the surface.</p>',
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

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-problem">
            <section class="am-home-container section">
                <div class="prob-sec">
                    <div class="prob-grid">
                        <div class="prob-content">
                            <?php if (!empty($settings['badge'])): ?>
                                <span class="badge-pill"><?php echo esc_html($settings['badge']); ?></span>
                            <?php endif; ?>

                            <h2 class="serif">
                                <?php echo wp_kses_post($settings['title']); ?>
                            </h2>

                            <div class="prob-description">
                                <?php echo wp_kses_post($settings['description']); ?>
                            </div>
                        </div>
                        <div class="prob-img">
                            <?php if (!empty($settings['image']['url'])): ?>
                                <img src="<?php echo esc_url($settings['image']['url']); ?>"
                                    alt="<?php echo esc_attr($settings['title']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
