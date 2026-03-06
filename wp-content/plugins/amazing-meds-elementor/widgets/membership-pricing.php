<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Pricing Widget
 */
class AM_Membership_Pricing_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_pricing';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Pricing', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
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
                'label' => esc_html__('Header', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'label',
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Simple Pricing']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Start your journey to better health']
        );

        $this->add_control(
            'description',
            ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'No hidden fees. No long-term contracts. Just expert care focused on your long-term wellness.']
        );

        $this->end_controls_section();

        // Value Banner
        $this->start_controls_section(
            'value_banner_section',
            [
                'label' => esc_html__('Value Banner', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control('vb_label', ['label' => 'Banner Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What You Save As a Member']);
        $this->add_control('vb_items', ['label' => 'Banner Items (one per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "Labs billed to your insurance (not $300-500+ out of pocket)\nProvider visits billed to insurance (you just pay copay)\n30% off meds through cheapest routing\nFree shipping + free syringe kits"]);
        $this->add_control('vb_crossed', ['label' => 'Banner Crossed Value', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$200-400/mo at other clinics (cash pay, no insurance help)']);
        $this->add_control('vb_price', ['label' => 'Banner Real Price', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '~$99/mo with Amazing Meds']);

        $this->end_controls_section();

        // Cards
        $this->start_controls_section(
            'cards_section',
            [
                'label' => esc_html__('Pricing Cards', 'amazing-meds-elementor'),
            ]
        );

        $card_repeater = new \Elementor\Repeater();
        $card_repeater->add_control('card_style', [
            'label' => 'Card Style',
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'entry' => 'Phase 1 (Entry / Diagnostic)',
                'featured' => 'Phase 2 (Featured / Quarterly)',
                'standard' => 'Phase 3 (Standard / Annual)',
            ],
            'default' => 'featured',
        ]);
        $card_repeater->add_control('top_badge', ['label' => 'Top Badge', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '']);
        $card_repeater->add_control('phase_label', ['label' => 'Phase Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Phase 2']);
        $card_repeater->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Quarterly Membership']);
        $card_repeater->add_control('price_desc', ['label' => 'Price Desc', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'All 5 systems. Every 90 days.']);
        $card_repeater->add_control('price', ['label' => 'Price', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$299']);
        $card_repeater->add_control('price_suffix', ['label' => 'Price Suffix / Period', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'billed quarterly · that\'s just ~$99/month. Cancel anytime.']);
        $card_repeater->add_control('features', ['label' => 'Features (one per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "All 5 systems monitored every 90 days\n30% off all protocol medications\nFree discreet shipping & supplies included\nSame-day provider messaging"]);
        $card_repeater->add_control('button_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Start Quarterly Care']);
        $card_repeater->add_control('button_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $card_repeater->add_control('savings_text', ['label' => 'Savings Text (Bottom)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '']);
        $card_repeater->add_control('disclaimer_text', ['label' => 'Disclaimer Text (Above button)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '']);

        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Cards', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $card_repeater->get_controls(),
                'default' => [
                    [
                        'card_style' => 'entry',
                        'top_badge' => 'Phase 1',
                        'phase_label' => 'Diagnostics',
                        'title' => '$75 Deposit',
                        'price_desc' => 'Fully credited toward your membership',
                        'price' => '$75',
                        'price_suffix' => 'one-time deposit',
                        'features' => "Free initial discovery call\nComprehensive 5-system lab orders\nLabs billed directly to your insurance\nOfficial Provider Visit to review results\nPersonalized protocol design",
                        'button_text' => 'Book Free Consult & Start Labs',
                        'disclaimer_text' => 'Treatment and ongoing care require membership'
                    ],
                    [
                        'card_style' => 'featured',
                        'top_badge' => 'Most Popular',
                        'phase_label' => 'Phase 2',
                        'title' => 'Quarterly Membership',
                        'price_desc' => 'All 5 systems. Every 90 days.',
                        'price' => '$299',
                        'price_suffix' => 'billed quarterly · that\'s just ~$99/month. Cancel anytime.',
                        'features' => "Everything in Phase 1, plus:\nAll 5 systems monitored every 90 days\n30% off all protocol medications\nFree discreet shipping & supplies included\nSame-day provider messaging\nWe handle insurance billing & prior auths\nRefill management (never run out)",
                        'button_text' => 'Start Quarterly Care',
                    ],
                    [
                        'card_style' => 'standard',
                        'top_badge' => 'Best Value',
                        'phase_label' => 'Phase 3',
                        'title' => 'Annual Membership',
                        'price_desc' => 'Get 1 quarter entirely FREE. Save $299.',
                        'price' => '$897',
                        'price_suffix' => 'billed annually · just $2.46/day',
                        'features' => "Everything in Quarterly, plus:\n4 full 5-system lab panels ordered and billed to your insurance\nPriority provider access\nDedicated care coordinator\nThe lowest overall cost for your protocol\nSet it and forget it for 12 months",
                        'button_text' => 'Start Annual Care',
                        'savings_text' => 'Save $299/year vs. quarterly',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Guarantee
        $this->start_controls_section(
            'extras_section',
            [
                'label' => esc_html__('Guarantee', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'guarantee_title',
            ['label' => 'Guarantee Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our 90-Day Guarantee']
        );
        $this->add_control(
            'guarantee_desc_html',
            ['label' => 'Guarantee Desc HTML', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'We measure results with data, not just feelings. If your 5-system labs don\'t show measurable improvement and you don\'t feel better after 90 days on our protocol, <span class="guarantee-highlight">we will pay for a consultation at the telehealth competitor of your choice.</span>']
        );
        $this->add_control(
            'guarantee_icon',
            ['label' => 'Guarantee Icon/Emoji', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '🛡️']
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-section--pricing" id="pricing">
            <div class="container">
                <div class="am-heading-stack">
                    <?php if (!empty($settings['label'])): ?>
                        <div class="am-label">
                            <?php echo esc_html($settings['label']); ?>
                        </div>
                    <?php endif; ?>
                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                    <?php if (!empty($settings['description'])): ?>
                        <p>
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($settings['vb_label']) || !empty($settings['vb_items'])): ?>
                    <div class="value-banner" style="margin-top: var(--sub-to-content);">
                        <div class="vb-label"><?php echo esc_html($settings['vb_label']); ?></div>
                        <div class="vb-items">
                            <?php
                            $items = explode("\n", str_replace("\r", "", $settings['vb_items']));
                            foreach ($items as $idx => $item) {
                                echo '<span>' . esc_html($item) . '</span>';
                                if ($idx < count($items) - 1) {
                                    echo '<span class="vb-dot">·</span>';
                                }
                            }
                            ?>
                        </div>
                        <div class="vb-total">
                            <span class="vb-crossed"><?php echo esc_html($settings['vb_crossed']); ?></span>
                            <span class="vb-price"><?php echo esc_html($settings['vb_price']); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['cards'])): ?>
                    <div class="pricing-grid">
                        <?php foreach ($settings['cards'] as $card):
                            $card_class = 'pricing-card--' . esc_attr($card['card_style']);
                            ?>
                            <div class="<?php echo esc_attr($card_class); ?>">
                                <?php if (!empty($card['top_badge'])): ?>
                                    <?php if ($card['card_style'] === 'entry' || $card['card_style'] === 'standard'): ?>
                                        <span class="am-badge"
                                            style="<?php echo ($card['card_style'] === 'entry') ? 'background: rgba(255,255,255,0.2); color: var(--am-white);' : ''; ?> position: absolute; top: -12px; left: 36px;"><?php echo esc_html($card['top_badge']); ?></span>
                                    <?php elseif ($card['card_style'] === 'featured'): ?>
                                        <span class="am-badge--gold"><?php echo esc_html($card['top_badge']); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($card['phase_label'])): ?>
                                    <div class="phase-label"><?php echo esc_html($card['phase_label']); ?></div>
                                <?php endif; ?>

                                <h3><?php echo esc_html($card['title']); ?></h3>
                                <p class="price-desc"><?php echo esc_html($card['price_desc']); ?></p>

                                <div class="pricing-amount">
                                    <span class="dollar"><?php echo esc_html($card['price']); ?></span>
                                </div>
                                <p class="pricing-period"><?php echo esc_html($card['price_suffix']); ?></p>

                                <?php if (!empty($card['features'])):
                                    $features = explode("\n", str_replace("\r", "", $card['features']));
                                    ?>
                                    <ul class="pricing-features">
                                        <?php foreach ($features as $feature): ?>
                                            <li>
                                                <span class="pricing-check">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round">
                                                        <polyline points="20 6 9 17 4 12" />
                                                    </svg>
                                                </span>
                                                <?php echo esc_html($feature); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <?php if (!empty($card['disclaimer_text'])): ?>
                                    <p style="font-size: 12px; color: rgba(255,255,255,0.5); margin-bottom: 20px; text-align: center;">
                                        <?php echo esc_html($card['disclaimer_text']); ?>
                                    </p>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($card['button_url']['url']); ?>" class="pricing-cta">
                                    <?php echo esc_html($card['button_text']); ?>
                                </a>

                                <?php if (!empty($card['savings_text'])): ?>
                                    <p class="pricing-savings"><?php echo esc_html($card['savings_text']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['guarantee_title'])): ?>
                    <div class="guarantee-banner">
                        <div class="guarantee-icon">
                            <?php echo esc_html($settings['guarantee_icon']); ?>
                        </div>
                        <h3>
                            <?php echo esc_html($settings['guarantee_title']); ?>
                        </h3>
                        <p>
                            <?php echo $settings['guarantee_desc_html']; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
