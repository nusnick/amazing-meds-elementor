<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Final CTA Widget
 */
class AM_Membership_Final_CTA_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_final_cta';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Final CTA', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
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
                'label' => esc_html__('Main CTA', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Ready to feel amazing again?']
        );

        $this->add_control(
            'description',
            ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Start with a Free Call, lock in your labs with a $75 deposit, or go all-in with the membership. Either way, we check all five systems.']
        );

        $this->add_control('primary_button_text', ['label' => 'Primary Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Book Your Free Consult']);
        $this->add_control('primary_button_url', ['label' => 'Primary Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->add_control('secondary_button_text', ['label' => 'Secondary Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View Membership Options']);
        $this->add_control('secondary_button_url', ['label' => 'Secondary Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#pricing']]);

        // Next steps
        $steps_repeater = new \Elementor\Repeater();
        $steps_repeater->add_control('time', ['label' => 'Timeframe', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Today']);
        $steps_repeater->add_control('content_html', ['label' => 'Content HTML', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '<strong>Quick intake & Free Call</strong>']);

        $this->add_control(
            'next_steps',
            [
                'label' => esc_html__('Next Steps Grid', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $steps_repeater->get_controls(),
                'default' => [
                    [
                        'time' => 'Today',
                        'content_html' => '<strong>Quick intake & Free Call</strong>',
                    ],
                    [
                        'time' => 'Within 48 Hours',
                        'content_html' => '<strong>$75 Deposit & Lab Orders</strong>',
                    ],
                    [
                        'time' => '2-3 Weeks',
                        'content_html' => '<strong>Meet your provider,</strong> review labs, start your protocol.',
                    ],
                ],
                'title_field' => '{{{ time }}}',
            ]
        );

        // Trust
        $trust_repeater = new \Elementor\Repeater();
        $trust_repeater->add_control('text', ['label' => 'Item Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Free Consult']);

        $this->add_control(
            'trust_items',
            [
                'label' => esc_html__('Trust Bar Bottom', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $trust_repeater->get_controls(),
                'default' => [
                    ['text' => 'Free Consult'],
                    ['text' => 'Insurance accepted'],
                    ['text' => '45+ states'],
                    ['text' => 'Free shipping'],
                    ['text' => 'Cancel anytime'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sticky_section',
            [
                'label' => esc_html__('Sticky Mobile CTA', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control('enable_sticky', ['label' => 'Enable Sticky CTA on Mobile?', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes']);
        $this->add_control('sticky_btn_1_text', ['label' => 'Button 1 Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Book Free Consult']);
        $this->add_control('sticky_btn_1_url', ['label' => 'Button 1 URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $this->add_control('sticky_btn_2_text', ['label' => 'Button 2 Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Membership']);
        $this->add_control('sticky_btn_2_url', ['label' => 'Button 2 URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#pricing']]);

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section style="padding: 48px 0 var(--section-pad-desktop); background: var(--am-beige);">
            <div class="am-container container">
                <div class="final-cta-inner">
                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                    <?php if (!empty($settings['description'])): ?>
                        <p>
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                    <?php endif; ?>

                    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                        <?php if (!empty($settings['primary_button_text'])): ?>
                            <a href="<?php echo esc_url($settings['primary_button_url']['url']); ?>"
                                class="am-btn--primary-on-dark">
                                <?php echo esc_html($settings['primary_button_text']); ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($settings['secondary_button_text'])): ?>
                            <a href="<?php echo esc_url($settings['secondary_button_url']['url']); ?>"
                                class="am-btn--secondary-on-dark">
                                <?php echo esc_html($settings['secondary_button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($settings['next_steps'])): ?>
                        <div class="next-steps-grid">
                            <?php foreach ($settings['next_steps'] as $ns): ?>
                                <div class="next-step-item">
                                    <div class="ns-time">
                                        <?php echo esc_html($ns['time']); ?>
                                    </div>
                                    <p>
                                        <?php echo $ns['content_html']; ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['trust_items'])): ?>
                        <div class="final-cta-trust" style="margin-top: 32px;">
                            <?php foreach ($settings['trust_items'] as $idx => $t): ?>
                                <span>
                                    <?php echo esc_html($t['text']); ?>
                                </span>
                                <?php if ($idx < count($settings['trust_items']) - 1): ?>
                                    <span class="separator">|</span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php if ('yes' === $settings['enable_sticky']): ?>
            <!-- STICKY MOBILE CTA -->
            <div class="sticky-mobile-cta">
                <div class="sticky-inner">
                    <?php if (!empty($settings['sticky_btn_1_text'])): ?>
                        <a href="<?php echo esc_url($settings['sticky_btn_1_url']['url']); ?>" class="am-btn--primary" style="flex:2;">
                            <?php echo esc_html($settings['sticky_btn_1_text']); ?>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($settings['sticky_btn_2_text'])): ?>
                        <a href="<?php echo esc_url($settings['sticky_btn_2_url']['url']); ?>" class="am-btn--gold" style="flex:1;">
                            <?php echo esc_html($settings['sticky_btn_2_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
    }
}
