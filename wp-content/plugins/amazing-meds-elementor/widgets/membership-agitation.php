<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Agitation Widget
 */
class AM_Membership_Agitation_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_agitation';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Agitation', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-info-circle';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-global', plugins_url('../assets/css/widgets/am-membership-global.css', __FILE__));
        return ['am-membership-global'];
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
            'label',
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Is This You?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('You might need all five systems checked if…', 'amazing-meds-elementor'),
                'rows' => 2,
            ]
        );

        $item_repeater = new \Elementor\Repeater();

        $item_repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $item_repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Still Tired on HRT', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $item_repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Hormones are up, but you\'re still exhausted and gaining weight. No one checked your thyroid or insulin.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Agitation Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $item_repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Still Tired on HRT',
                        'description' => 'Hormones are up, but you\'re still exhausted and gaining weight. No one checked your thyroid or insulin.',
                    ],
                    [
                        'title' => '"Your Labs Look Fine"',
                        'description' => 'Your doctor checked one number and dismissed how you actually feel.',
                    ],
                    [
                        'title' => 'Paying Out of Pocket',
                        'description' => 'Dropping $200-$400/month elsewhere because they don\'t help with insurance.',
                    ],
                    [
                        'title' => 'Insurance Runaround',
                        'description' => 'Prior authorizations denied, pharmacy won\'t fill, nobody returns your calls.',
                    ],
                    [
                        'title' => '5-Minute Visits',
                        'description' => 'Your provider spends 5 minutes, writes a script, and says "see you in 6 months." No adjustments.',
                    ],
                    [
                        'title' => 'Starting Fresh',
                        'description' => 'You want to do HRT, TRT, or weight loss right from the start, not piecemeal.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-section--agitation">
            <div class="am-container">
                <div class="am-heading-stack">
                    <?php if (!empty($settings['label'])): ?>
                        <div class="am-label">
                            <?php echo esc_html($settings['label']); ?>
                        </div>
                    <?php endif; ?>
                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                </div>

                <?php if (!empty($settings['items'])): ?>
                    <div class="who-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="who-card">
                                <div class="who-image">
                                    <?php if (!empty($item['image']['url'])): ?>
                                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'image'); ?>
                                    <?php endif; ?>
                                </div>
                                <h3>
                                    <?php echo esc_html($item['title']); ?>
                                </h3>
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
