<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Included Benefits Widget
 */
class AM_Membership_Included_Benefits_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_included_benefits';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Included Benefits', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-global', plugins_url('../assets/css/widgets/am-membership-global.css', __FILE__));
        wp_register_style('am-membership-included-benefits', plugins_url('../assets/css/widgets/membership-included-benefits.css', __FILE__));
        return ['am-membership-global', 'am-membership-included-benefits'];
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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Phase 2: Management']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What\'s Included in Your Membership']
        );

        $this->add_control(
            'description',
            ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Once your protocol is dialed in, we move to ongoing management. This is where the real transformation happens.']
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Benefit Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => 'Title',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'All Provider Visits',
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Quarterly check-ins and on-demand adjustments.',
                    ],
                    [
                        'name' => 'icon_svg',
                        'label' => 'Icon SVG',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                    ],
                ],
                'default' => [
                    [
                        'title' => 'All Provider Visits',
                        'description' => 'Quarterly check-ins and on-demand adjustments.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
                    ],
                    [
                        'title' => 'Quarterly Lab Reviews',
                        'description' => 'We monitor all 5 systems every 90 days.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>'
                    ],
                    [
                        'title' => 'Priority Support',
                        'description' => 'Text or call your team. No robot menus.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>'
                    ],
                    [
                        'title' => 'Exclusive Pharmacy Pricing',
                        'description' => 'Access to our curated compounding partners.',
                        'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>'
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Benefit Image', 'amazing-meds-elementor'),
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
        <section class="am-membership-global am-section--included">
            <div class="am-container">
                <div class="included-grid">
                    <div class="included-content">
                        <?php if (!empty($settings['label'])): ?>
                            <div class="am-label">
                                <?php echo esc_html($settings['label']); ?>
                            </div>
                        <?php endif; ?>
                        <h2>
                            <?php echo esc_html($settings['title']); ?>
                        </h2>
                        <p>
                            <?php echo esc_html($settings['description']); ?>
                        </p>

                        <?php if (!empty($settings['items'])): ?>
                            <ul class="included-list">
                                <?php foreach ($settings['items'] as $item): ?>
                                    <li class="included-item">
                                        <div class="am-icon-circle">
                                            <?php echo $item['icon_svg']; ?>
                                        </div>
                                        <div class="item-text">
                                            <strong>
                                                <?php echo esc_html($item['title']); ?>
                                            </strong>
                                            <span>
                                                <?php echo esc_html($item['description']); ?>
                                            </span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <div class="included-image">
                        <?php if (!empty($settings['image']['url'])): ?>
                            <div class="included-image-wrapper">
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
                            </div>
                        <?php else: ?>
                            <div class="am-image-placeholder" style="aspect-ratio: 1/1;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="M21 15l-5-5L5 21" />
                                </svg>
                                <span>Benefit Visual</span>
                                <span class="img-note">Image Placeholder</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
