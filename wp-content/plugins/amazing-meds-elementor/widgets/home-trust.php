<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Trust_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_trust';
    }

    public function get_title()
    {
        return esc_html__('AM Home Trust', 'amazing-meds-elementor');
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
        // Row 1
        $this->start_controls_section(
            'section_row_1',
            [
                'label' => esc_html__('Row 1 (Access)', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'row1_image',
            [
                'label' => esc_html__('Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'row1_title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Care That\'s Easier to Access and Manage', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'row1_desc',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We make the process as seamless as possible—so you can focus on feeling better, not navigating logistics.', 'amazing-meds-elementor'),
            ]
        );

        $repeater1 = new \Elementor\Repeater();
        $repeater1->add_control(
            'text',
            [
                'label' => esc_html__('Item Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );
        $repeater1->add_control(
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
            'row1_features',
            [
                'label' => esc_html__('Features List', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'default' => [
                    ['text' => 'Insurance accepted'],
                    ['text' => 'Prior authorizations handled'],
                    ['text' => 'Prescriptions sent to your local pharmacy'],
                    ['text' => 'Support to help optimize your costs'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        // Row 2
        $this->start_controls_section(
            'section_row_2',
            [
                'label' => esc_html__('Row 2 (Trust)', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'row2_title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Care You Can Trust', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'row2_desc',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your health and safety are at the center of everything we do.', 'amazing-meds-elementor'),
            ]
        );

        $repeater2 = new \Elementor\Repeater();
        $repeater2->add_control(
            'text',
            [
                'label' => esc_html__('Item Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );
        $repeater2->add_control(
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
            'row2_features',
            [
                'label' => esc_html__('Features List', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),
                'default' => [
                    ['text' => 'Licensed medical providers'],
                    ['text' => 'Ongoing quarterly monitoring'],
                    ['text' => 'Safety-first prescribing approach'],
                    ['text' => 'Personalized care based on lab results'],
                    ['text' => 'Available across all 50 states'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'row2_image',
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
        <div class="am-home-widget am-home-trust">
            <section class="section am-home-container">

                <!-- ROW 1: Image Left, Content Right -->
                <div class="trust-row">
                    <div class="trust-visual-container">
                        <div class="trust-visual-stack">
                            <?php if (!empty($settings['row1_image']['url'])): ?>
                                <img src="<?php echo esc_url($settings['row1_image']['url']); ?>"
                                    alt="<?php echo esc_attr($settings['row1_title']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="trust-content">
                        <h2 class="serif">
                            <?php echo wp_kses_post($settings['row1_title']); ?>
                        </h2>
                        <p class="trust-desc">
                            <?php echo wp_kses_post($settings['row1_desc']); ?>
                        </p>

                        <?php if (!empty($settings['row1_features'])): ?>
                            <div class="trust-checklist">
                                <?php foreach ($settings['row1_features'] as $item): ?>
                                    <div class="trust-check-item">
                                        <div class="trust-check-icon">
                                            <?php
                                            if (!empty($item['selected_icon']['value'])) {
                                                \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
                                            }
                                            ?>
                                        </div>
                                        <span><?php echo wp_kses_post($item['text']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ROW 2: Content Left, Image Right -->
                <div class="trust-row reverse">
                    <div class="trust-content">
                        <h2 class="serif">
                            <?php echo wp_kses_post($settings['row2_title']); ?>
                        </h2>
                        <p class="trust-desc">
                            <?php echo wp_kses_post($settings['row2_desc']); ?>
                        </p>

                        <?php if (!empty($settings['row2_features'])): ?>
                            <div class="trust-checklist">
                                <?php foreach ($settings['row2_features'] as $item): ?>
                                    <div class="trust-check-item">
                                        <div class="trust-check-icon">
                                            <?php
                                            if (!empty($item['selected_icon']['value'])) {
                                                \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
                                            }
                                            ?>
                                        </div>
                                        <span><?php echo wp_kses_post($item['text']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="trust-visual-container">
                        <div class="trust-visual-stack">
                            <?php if (!empty($settings['row2_image']['url'])): ?>
                                <img src="<?php echo esc_url($settings['row2_image']['url']); ?>"
                                    alt="<?php echo esc_attr($settings['row2_title']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <?php
    }
}
