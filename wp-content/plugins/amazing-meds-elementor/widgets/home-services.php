<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Services_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_services';
    }

    public function get_title()
    {
        return esc_html__('AM Home Comparison', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-columns';
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
        // Header
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Header Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Not All Hormone Care Providers<br>Are Built the Same']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Here\'s how Amazing Meds compares to typical telehealth clinics.']);

        $this->end_controls_section();

        // Left Column (Typical)
        $this->start_controls_section(
            'section_left_col',
            [
                'label' => esc_html__('Left Column (Typical)', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('left_title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Typical Clinics']);

        $repeater_left = new \Elementor\Repeater();
        $repeater_left->add_control('text', ['label' => 'Item Text', 'type' => \Elementor\Controls_Manager::TEXT]);
        $this->add_control(
            'left_items',
            [
                'label' => 'Items',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_left->get_controls(),
                'default' => [
                    ['text' => 'Limited testing'],
                    ['text' => 'One-time prescriptions'],
                    ['text' => 'Minimal follow-up'],
                    ['text' => 'No insurance support'],
                    ['text' => 'Mail-order only pharmacies'],
                    ['text' => 'Standardized treatment plans'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();


        // Right Column (Amazing Meds)
        $this->start_controls_section(
            'section_right_col',
            [
                'label' => esc_html__('Right Column (Amazing Meds)', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('right_badge', ['label' => 'Badge', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Best Option']);
        $this->add_control('right_title', ['label' => 'Brand Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'amazing meds']);

        $repeater_right = new \Elementor\Repeater();
        $repeater_right->add_control('text', ['label' => 'Item Text', 'type' => \Elementor\Controls_Manager::TEXT]);
        $this->add_control(
            'right_items',
            [
                'label' => 'Items',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_right->get_controls(),
                'default' => [
                    ['text' => 'Complete hormone and metabolic mapping'],
                    ['text' => 'Ongoing safety monitoring'],
                    ['text' => 'Quarterly treatment adjustments'],
                    ['text' => 'Insurance and prior authorization support'],
                    ['text' => 'Prescriptions sent to local pharmacies'],
                    ['text' => 'Multiple treatment options'],
                    ['text' => 'Personalized and ongoing care'],
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
        <div class="am-home-widget am-home-services">
            <section class="section am-home-container text-center">
                <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p><?php echo wp_kses_post($settings['subtitle']); ?></p>

                <div class="comp-wrap">

                    <div class="comp-left">
                        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 24px; text-align: left;">
                            <?php echo esc_html($settings['left_title']); ?>
                        </h3>
                        <?php if (!empty($settings['left_items'])): ?>
                            <ul class="comp-list-left">
                                <?php foreach ($settings['left_items'] as $item): ?>
                                    <li><span class="icon-minus"></span><?php echo wp_kses_post($item['text']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <div class="comp-right text-white">
                        <?php if (!empty($settings['right_badge'])): ?>
                            <span class="badge-best"><?php echo esc_html($settings['right_badge']); ?></span>
                        <?php endif; ?>

                        <h3 class="serif" style="font-size: 36px; margin-bottom: 24px; letter-spacing: -1px; color: #fff;">
                            <?php echo esc_html($settings['right_title']); ?>
                        </h3>

                        <?php if (!empty($settings['right_items'])): ?>
                            <ul class="comp-list-right">
                                <?php foreach ($settings['right_items'] as $item): ?>
                                    <li><span class="icon-check"></span><?php echo wp_kses_post($item['text']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($settings['btn_text'])): ?>
                            <div style="text-align: center; margin-top: 32px;">
                                <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="btn btn-white"
                                    style="width: 100%;">
                                    <?php echo esc_html($settings['btn_text']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </section>
        </div>
        <?php
    }
}
