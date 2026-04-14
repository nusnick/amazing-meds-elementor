<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Care Plan Widget
 */
class AM_Home_Care_Plan_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_care_plan';
    }

    public function get_title()
    {
        return esc_html__('AM Home Care Plan', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-price-list';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-home-css', plugins_url('../assets/css/widgets/home-global.css', __FILE__));
        return ['am-home-css'];
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
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('An All-Inclusive Care Plan Made for You', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Complete initial blood work', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => esc_html__('Plan Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['item_text' => 'Complete initial blood work'],
                    ['item_text' => 'Provider consultation & review'],
                    ['item_text' => 'Ongoing medical support'],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Full Pricing', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__('Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$199', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'price_label',
            [
                'label' => esc_html__('Price Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('/monthly membership', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'price_description',
            [
                'label' => esc_html__('Price Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Covers your consultations, ongoing care, and program management.', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget">
            <section class="container am-home-care-plan section-padding">
                <div class="care-plan-grid">
                    <div class="plan-left">
                        <?php if (!empty($settings['title'])): ?>
                            <h2>
                                <?php echo esc_html($settings['title']); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($settings['list_items'])): ?>
                            <ul style="list-style: none; margin-top: 30px;">
                                <?php foreach ($settings['list_items'] as $item): ?>
                                    <li style="margin-bottom: 12px;">✓
                                        <?php echo esc_html($item['item_text']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($settings['btn_text'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="btn btn-dark"
                                style="margin-top: 30px;">
                                <?php echo esc_html($settings['btn_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="plan-right">
                        <?php if (!empty($settings['price'])): ?>
                            <h3>
                                <?php echo esc_html($settings['price']); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if (!empty($settings['price_label'])): ?>
                            <p style="color: rgba(255,255,255,0.7);">
                                <?php echo esc_html($settings['price_label']); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($settings['price_description'])): ?>
                            <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 15px;">
                                <?php echo esc_html($settings['price_description']); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
