<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Comparison Grid Widget
 */
class AM_Hair_Comparison_Grid_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_comparison_grid';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Comparison Grid', 'amazing-meds-elementor');
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
        wp_register_style('am-hair-css', plugins_url('../assets/css/widgets/hair-global.css', __FILE__));
        return ['am-hair-css'];
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
            'heading',
            [
                'label' => esc_html__('Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('One-size-fits-all hair loss treatment is failing women.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Model Name', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Card Title', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description text here...', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'is_featured',
            [
                'label' => esc_html__('Featured', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'amazing-meds-elementor'),
                'label_off' => esc_html__('No', 'amazing-meds-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Comparison Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'label' => 'The One-Size-Fits-All Model',
                        'title' => '',
                        'description' => 'Every woman gets the same dose. No adjustment. No provider relationship. You get a pill in a bag and hope for the best. If you have side effects, you quit. If it doesn\'t work, nobody investigates why. You\'re on your own.',
                        'is_featured' => 'no',
                    ],
                    [
                        'label' => 'A Dermatologist\'s Office',
                        'title' => '',
                        'description' => 'Personalized dosing. Lab work. Follow-up visits. Hormone screening. Exactly what you need, except it costs $200-400 per visit, takes weeks to get an appointment, and you\'re stuck in a waiting room.',
                        'is_featured' => 'no',
                    ],
                    [
                        'label' => 'Amazing Meds',
                        'title' => '',
                        'description' => 'Everything a dermatologist does, delivered to your door. Personalized dose escalation. Quarterly provider reviews. Hormone screening when needed. Labs billed to your insurance. One capsule, one protocol, one provider who actually knows your case.',
                        'is_featured' => 'yes',
                    ],
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--beige am-cap">
            <div class="am-container">
                <?php if (!empty($settings['heading'])): ?>
                    <div class="am-heading-stack">
                        <h2>
                            <?php echo esc_html($settings['heading']); ?>
                        </h2>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['items'])): ?>
                    <div class="am-compare-grid">
                        <?php foreach ($settings['items'] as $item):
                            $card_class = ('yes' === $item['is_featured']) ? 'am-card--featured' : 'am-card';
                            ?>
                            <div class="am-compare-card <?php echo esc_attr($card_class); ?>">
                                <div class="card-label">
                                    <span class="label-dot"></span>
                                    <?php echo esc_html($item['label']); ?>
                                </div>
                                <?php if (!empty($item['title'])): ?>
                                    <h3>
                                        <?php echo esc_html($item['title']); ?>
                                    </h3>
                                <?php endif; ?>
                                <p>
                                    <?php echo esc_html($item['description']); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
