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
        wp_register_style('am-membership-conditions', plugins_url('../assets/css/widgets/membership-conditions.css', __FILE__));
        return ['am-membership-conditions'];
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
                ],
                'default' => [
                    [
                        'title' => 'Menopause & Perimenopause',
                        'description' => 'Hot flashes, night sweats, mood swings, and sleep disruption.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path d="M12 7v5l3 3"/></svg>'
                    ],
                    [
                        'title' => 'Low Testosterone (TRT)',
                        'description' => 'Fatigue, loss of muscle mass, low libido, and brain fog.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>'
                    ],
                    [
                        'title' => 'Weight Management',
                        'description' => 'Metabolic resistance, stubborn fat, and insulin sensitivity issues.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20v-8m0 0V4m0 8h8m-8 0H4"/></svg>'
                    ],
                    [
                        'title' => 'Thyroid Dysfunction',
                        'description' => 'Hypothyroidism, Hashimoto\'s, and metabolic slowdown.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c1.5 1.5 4 2.5 7.5 2.5s6-1 7.5-2.5"/><path d="M4.5 7.5C6 6 8.5 5 12 5s6 1 7.5 2.5"/></svg>'
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
        <section class="am-membership-conditions am-section--conditions">
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
                    <div class="conditions-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="condition-card">
                                <div class="am-icon-circle">
                                    <?php echo $item['icon_svg']; ?>
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
