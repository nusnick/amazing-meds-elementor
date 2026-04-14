<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Women's Care Widget
 */
class AM_Home_Women_Care_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_women_care';
    }

    public function get_title()
    {
        return esc_html__('AM Home Women\'s Care', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-image-pulse';
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
            'content_section',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Main Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Modern Women’s Care', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Precision medicine tailored to the unique hormonal needs of woman at every stage of life.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Item', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Perimenopause & Menopause', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Specialties', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['item_text' => 'Perimenopause & Menopause'],
                    ['item_text' => 'PCOS & Hormonal Imbalance'],
                    ['item_text' => 'Metabolic Support & Weight Loss'],
                    ['item_text' => 'Thyroid Optimization'],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn About Women’s Health', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Section Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-women-care">
            <div class="am-women-care-content">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>

                <?php if (!empty($settings['description'])): ?>
                    <p class="am-text-p"><?php echo wp_kses_post($settings['description']); ?></p>
                <?php endif; ?>

                <div class="am-items-list">
                    <?php foreach ($settings['items'] as $item): ?>
                        <div class="am-list-item">
                            <div class="am-list-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="10" stroke="#BFA568" stroke-width="2" />
                                    <path d="M8 12L11 15L16 9" stroke="#BFA568" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="am-list-text"><?php echo esc_html($item['item_text']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <a href="#" class="am-button am-button-dark"><?php echo esc_html($settings['btn_text']); ?></a>
            </div>

            <div class="am-women-care-img">
                <?php if (!empty($settings['image']['url'])): ?>
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                <?php else: ?>
                    <div
                        style="width: 100%; height: 600px; background: var(--am-beige-mid); display: flex; align-items: center; justify-content: center; color: var(--am-text-gray);">
                        Image Placeholder</div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
