<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Social Proof Widget
 */
class AM_Membership_Social_Proof_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_social_proof';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Social Proof', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-rating';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-global', plugins_url('../assets/css/widgets/am-membership-global.css', __FILE__));
        wp_register_style('am-membership-social-proof', plugins_url('../assets/css/widgets/membership-social-proof.css', __FILE__));
        return ['am-membership-global', 'am-membership-social-proof'];
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
            'star_rating',
            [
                'label' => esc_html__('Star Rating Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('★★★★★', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'reviews_text',
            [
                'label' => esc_html__('Reviews Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('4.8 out of 5 based on 1,000+ reviews', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Social Proof Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Thousands of patients nationwide', 'amazing-meds-elementor'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon_svg',
                        'label' => esc_html__('Icon SVG Code', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                    ],
                ],
                'default' => [
                    [
                        'text' => 'Thousands of patients nationwide',
                        'icon_svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
                    ],
                    [
                        'text' => 'Providers in 45+ states',
                        'icon_svg' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-social-proof">
            <div class="am-container">
                <div class="social-proof-bar">
                    <div class="social-proof-stars">
                        <span class="stars">
                            <?php echo esc_html($settings['star_rating']); ?>
                        </span>
                        <?php echo esc_html($settings['reviews_text']); ?>
                    </div>

                    <?php if (!empty($settings['items'])): ?>
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="proof-separator"></div>
                            <div class="social-proof-item">
                                <?php echo $item['icon_svg']; ?>
                                <?php echo esc_html($item['text']); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
