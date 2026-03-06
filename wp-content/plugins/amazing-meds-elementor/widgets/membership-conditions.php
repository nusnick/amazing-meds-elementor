<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Conditions Widget
 */
class AM_Membership_Conditions_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_conditions';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Conditions', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-apps';
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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Who We Grow With']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Conditions we treat']
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Conditions', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => 'Title',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Menopause & Perimenopause',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Hot flashes, night sweats, mood swings, and sleep disruption.',
                    ],
                    [
                        'name' => 'icon_svg',
                        'label' => 'Icon SVG',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                    ],
                    [
                        'name' => 'is_featured',
                        'label' => 'Dark/Featured Card?',
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'default' => '',
                    ]
                ],
                'default' => [
                    [
                        'title' => 'Hormone Optimization',
                        'description' => 'Testosterone, estradiol, progesterone, thyroid. Full HRT for men and women, tailored to your labs and symptoms.',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
                        'is_featured' => 'yes',
                    ],
                    [
                        'title' => 'Weight Management',
                        'description' => 'GLP-1 medications and metabolic support for medically-supervised weight loss. Insurance accepted where eligible.',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>'
                    ],
                    [
                        'title' => 'Sexual Health',
                        'description' => 'Discreet treatment for ED, PE, and other sexual health concerns. Prescribed and shipped with complete privacy.',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'
                    ],
                    [
                        'title' => 'Hair Restoration',
                        'description' => 'Evidence-based hair loss treatments including finasteride, minoxidil, and combination therapies.',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>'
                    ],
                    [
                        'title' => 'Peptide Therapy',
                        'description' => 'NAD+, sermorelin, and advanced peptide protocols. Compounded and coordinated as part of your full treatment plan.',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>'
                    ],
                    [
                        'title' => 'Ongoing Chronic Care',
                        'description' => 'Long-term management and quarterly lab monitoring for conditions that need consistent provider oversight.',
                        'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'
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
        <section class="am-membership-global am-section--conditions">
            <div class="am-container container">
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
                    <div class="conditions-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item):
                            $is_dark = ('yes' === $item['is_featured']);
                            $card_class = $is_dark ? 'am-card--dark condition-card' : 'am-card condition-card';
                            $icon_class = $is_dark ? 'am-icon-circle am-icon-circle--gold' : 'am-icon-circle';
                            ?>
                            <div class="<?php echo esc_attr($card_class); ?>">
                                <div class="<?php echo esc_attr($icon_class); ?>">
                                    <?php echo $item['icon_svg']; ?>
                                </div>
                                <?php if ($is_dark): ?>
                                    <div class="condition-card-text">
                                        <h3><?php echo esc_html($item['title']); ?></h3>
                                        <p><?php echo esc_html($item['description']); ?></p>
                                    </div>
                                <?php else: ?>
                                    <h3><?php echo esc_html($item['title']); ?></h3>
                                    <p><?php echo esc_html($item['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
