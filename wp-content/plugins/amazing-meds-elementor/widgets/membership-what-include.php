<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership What Include Widget
 */
class AM_Membership_What_Include_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_what_include';
    }

    public function get_title()
    {
        return esc_html__('AM Membership What Include', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-check-circle';
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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Membership Benefits']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Everything you need,<br>nothing you don\'t']
        );

        $this->add_control(
            'description',
            ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Your membership covers real, provider-led care across all 5 systems. No hidden fees. No insurance runarounds.']
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
                        'default' => 'Benefit Title',
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Benefit description.',
                    ],
                ],
                'default' => [
                    [
                        'title' => '30% Off Your Protocol',
                        'description' => 'Members save 30% on all medications and treatment protocols. We route every script through the cheapest option: insurance first, then GoodRx, then compounding.',
                    ],
                    [
                        'title' => 'Free Shipping + Supplies Included',
                        'description' => 'Medications shipped discreetly to your door at no extra cost. Syringes, needles, alcohol swabs, all included.',
                    ],
                    [
                        'title' => 'Same-Day Provider Messaging',
                        'description' => 'Message your care team anytime. Members get same-day responses, not the 48-72 hour wait.',
                    ],
                    [
                        'title' => 'Quarterly Labs Across All 5 Systems',
                        'description' => 'Full panels every 90 days covering hormones, metabolic, and safety markers. Billed to your insurance. Real adjustments based on real data.',
                    ],
                    [
                        'title' => 'Insurance & Pharmacy Advocacy',
                        'description' => 'We handle billing, prior authorizations, denial appeals, and pharmacy routing so you never deal with that headache.',
                    ],
                    [
                        'title' => 'Refill Management (Never Run Out)',
                        'description' => 'We track your refills and coordinate with your pharmacy proactively. No gaps in your protocol.',
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
            <div class="container">
                <div class="included-grid">
                    <div class="included-image">
                        <?php if (!empty($settings['image']['url'])): ?>
                            <div class="included-image-wrapper">
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
                            </div>
                        <?php else: ?>
                            <div class="am-image-placeholder" style="aspect-ratio:1;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <path d="M21 15l-5-5L5 21"></path>
                                </svg>
                                <span>Feature image</span>
                                <span class="img-note">Image Placeholder</span>
                                <span style="font-size:12px; opacity:0.6;">Person messaging provider, relaxed home setting, warm
                                    tones</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <?php if (!empty($settings['label'])): ?>
                            <div class="am-label">
                                <?php echo esc_html($settings['label']); ?>
                            </div>
                        <?php endif; ?>

                        <h2>
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>

                        <?php if (!empty($settings['description'])): ?>
                            <p style="color: var(--am-muted); margin-top: 12px; font-size: 16px; line-height: 1.7;">
                                <?php echo wp_kses_post($settings['description']); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($settings['items'])): ?>
                            <ul class="included-list">
                                <?php foreach ($settings['items'] as $item): ?>
                                    <li>
                                        <div class="am-icon-circle">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </div>
                                        <div>
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
                </div>
            </div>
        </section>
        <?php
    }
}
