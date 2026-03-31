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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Pricing']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Use Your Insurance. Pay Less.']
        );

        $this->add_control(
            'description',
            ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Most patients underuse their insurance benefits. We help you use them before you pay out of pocket.']
        );

        $this->end_controls_section();

        // Comparison Table
        $this->start_controls_section(
            'comparison_section',
            [
                'label' => esc_html__('Comparison Table', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'comp_table_header',
            [
                'label' => 'Table Header',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Stop paying out of pocket for what insurance may cover'
            ]
        );

        $comp_repeater = new \Elementor\Repeater();
        $comp_repeater->add_control('service', ['label' => 'Service', 'type' => \Elementor\Controls_Manager::TEXT]);
        $comp_repeater->add_control('without_am', ['label' => 'Without Amazing Meds', 'type' => \Elementor\Controls_Manager::TEXT]);
        $comp_repeater->add_control('with_am', ['label' => 'With Amazing Meds', 'type' => \Elementor\Controls_Manager::TEXT]);
        $comp_repeater->add_control('is_advocate', ['label' => 'Highlight Row (Advocacy)', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '']);

        $this->add_control(
            'comp_items',
            [
                'label' => 'Comparison Items',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $comp_repeater->get_controls(),
                'default' => [
                    ['service' => 'Labs', 'without_am' => '$300–500 out of pocket', 'with_am' => 'Covered by your plan'],
                    ['service' => 'Provider visit', 'without_am' => '$150–200', 'with_am' => 'Your copay only'],
                    ['service' => 'Medications', 'without_am' => '$200–400/mo', 'with_am' => 'We find the lowest legitimate price'],
                    ['service' => 'Insurance fighting & advocacy', 'without_am' => 'You handle it yourself', 'with_am' => 'Included — we handle everything', 'is_advocate' => 'yes'],
                ],
                'title_field' => '{{{ service }}}',
            ]
        );

        $this->add_control('comp_total_label', ['label' => 'Total Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'TOTAL']);
        $this->add_control('comp_total_without', ['label' => 'Total Without AM', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$650–1,100+/mo']);
        $this->add_control('comp_total_with', ['label' => 'Total With AM', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '~$99/mo']);
        $this->add_control('comp_total_badge', ['label' => 'Total Badge Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Care Plan Fee']);
        $this->add_control('comp_disclaimer', ['label' => 'Disclaimer', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Savings vary by insurance plan, copays, medication, and treatment protocol.']);

        $this->end_controls_section();

        // Urgency Bar
        $this->start_controls_section(
            'urgency_section',
            [
                'label' => esc_html__('Urgency Bar', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'urgency_text',
            [
                'label' => 'Urgency Text (HTML allowed)',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<strong>Your insurance benefits reset January 1.</strong> Patients who enroll now have time to get labs ordered and billed this calendar year.'
            ]
        );

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
                'entry' => 'Standard',
                'featured' => 'Featured / Quarterly',
            ],
            'default' => 'featured',
        ]);
        $card_repeater->add_control('top_badge', ['label' => 'Top Badge', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '']);
        $card_repeater->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Quarterly Care Plan']);
        $card_repeater->add_control('price', ['label' => 'Price', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$299']);
        $card_repeater->add_control('price_suffix', ['label' => 'Price Suffix / Period', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '/quarter']);
        $card_repeater->add_control('price_sub', ['label' => 'Sub Price (e.g. ~$99/mo)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '~$99/month']);
        $card_repeater->add_control('features', ['label' => 'Features (one per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "All 5 systems checked every 90 days\nWholesale medication pricing\nFree shipping + supplies\nSame-day provider messaging (business days)\nInsurance billing, prior auth, and denial appeals\nProactive refill coordination"]);
        $card_repeater->add_control('button_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Enroll Quarterly']);
        $card_repeater->add_control('button_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $card_repeater->add_control('disclaimer_text', ['label' => 'Disclaimer Text (Above button)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Risk-free enrollment. Full refund if our providers determine you are not a candidate.']);

        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Cards', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $card_repeater->get_controls(),
                'default' => [
                    [
                        'card_style' => 'featured',
                        'top_badge' => 'Most Popular',
                        'title' => 'Quarterly Care Plan',
                        'price' => '$299',
                        'price_suffix' => '/quarter',
                        'price_sub' => '~$99/month',
                        'features' => "All 5 systems checked every 90 days\nWholesale medication pricing\nFree shipping + supplies\nSame-day provider messaging (business days)\nInsurance billing, prior auth, and denial appeals\nProactive refill coordination",
                        'button_text' => 'Enroll Quarterly',
                    ],
                    [
                        'card_style' => 'entry',
                        'top_badge' => 'Best Value',
                        'title' => 'Annual Care Plan',
                        'price' => '$897',
                        'price_suffix' => '/year',
                        'price_sub' => '~$2.46/day — save $299',
                        'features' => "All 5 systems checked every 90 days\nWholesale medication pricing\nFree shipping + supplies\nSame-day provider messaging (business days)\nInsurance billing, prior auth, and denial appeals\nProactive refill coordination\nPriority provider access\nDedicated care coordinator",
                        'button_text' => 'Enroll Annually',
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

        // Button Style Section
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Button Style', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__('Background Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .am-btn--primary' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label' => esc_html__('Text Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .am-btn--primary' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'btn_bg_color_hover',
            [
                'label' => esc_html__('Background Color (Hover)', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .am-btn--primary:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color_hover',
            [
                'label' => esc_html__('Text Color (Hover)', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .am-btn--primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

                <!-- COMPARISON TABLE -->
                <?php if (!empty($settings['comp_items'])): ?>
                    <div class="am-comparison-wrap" style="margin-top: var(--sub-to-content);">
                        <div class="am-comparison-header"><?php echo esc_html($settings['comp_table_header']); ?></div>
                        <table class="am-comparison-table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Without Amazing Meds</th>
                                    <th>With Amazing Meds</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($settings['comp_items'] as $item): ?>
                                    <tr class="<?php echo ($item['is_advocate'] === 'yes') ? 'am-advocate-row' : ''; ?>">
                                        <td><?php echo esc_html($item['service']); ?></td>
                                        <td><?php echo esc_html($item['without_am']); ?></td>
                                        <td><?php echo esc_html($item['with_am']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="am-total-row">
                                    <td><?php echo esc_html($settings['comp_total_label']); ?></td>
                                    <td><?php echo esc_html($settings['comp_total_without']); ?></td>
                                    <td>
                                        <div class="am-total-callout">
                                            <?php echo esc_html($settings['comp_total_with']); ?>
                                            <span class="am-total-price-badge"><?php echo esc_html($settings['comp_total_badge']); ?></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if (!empty($settings['comp_disclaimer'])): ?>
                            <div class="am-comparison-disclaimer"><?php echo esc_html($settings['comp_disclaimer']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- URGENCY BAR -->
                <?php if (!empty($settings['urgency_text'])): ?>
                    <div class="am-urgency-bar">
                        <?php echo $settings['urgency_text']; ?>
                    </div>
                <?php endif; ?>

                <!-- PRICING CARDS -->
                <?php if (!empty($settings['cards'])):
                    $count = count($settings['cards']);
                    $cols = min($count, 4);
                ?>
                    <div class="am-pricing-cards am-dynamic-grid cols-<?php echo $cols; ?>">
                        <?php foreach ($settings['cards'] as $card):
                            $card_class = 'am-pricing-card';
                            if ($card['card_style'] === 'featured') {
                                $card_class .= ' am-pricing-card--featured';
                            }
                        ?>
                            <div class="<?php echo esc_attr($card_class); ?>">
                                <?php if (!empty($card['top_badge'])): ?>
                                    <div class="am-card-badge <?php echo ($card['card_style'] === 'entry') ? 'am-card-badge--value' : ''; ?>">
                                        <?php echo esc_html($card['top_badge']); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="am-card-plan"><?php echo esc_html($card['title']); ?></div>
                                <div class="am-card-price">
                                    <?php echo esc_html($card['price']); ?><span><?php echo esc_html($card['price_suffix']); ?></span>
                                </div>
                                <?php if (!empty($card['price_sub'])): ?>
                                    <div class="am-card-sub"><?php echo esc_html($card['price_sub']); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($card['disclaimer_text'])): ?>
                                    <p class="am-card-refund"><?php echo esc_html($card['disclaimer_text']); ?></p>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($card['button_url']['url']); ?>" 
                                   class="am-btn--primary <?php echo ($card['card_style'] === 'featured') ? 'am-btn--gold' : ''; ?>"
                                   <?php echo $card['button_url']['is_external'] ? 'target="_blank"' : ''; ?>
                                   <?php echo $card['button_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                    <?php echo esc_html($card['button_text']); ?>
                                </a>

                                <?php if (!empty($card['features'])):
                                    $features = explode("\n", str_replace("\r", "", $card['features']));
                                ?>
                                    <ul class="am-card-features">
                                        <?php foreach ($features as $feature): ?>
                                            <li><?php echo esc_html($feature); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- GUARANTEE -->
                <?php if (!empty($settings['guarantee_title'])): ?>
                    <div class="guarantee-banner">
                        <?php if (!empty($settings['guarantee_icon'])): ?>
                            <div class="guarantee-icon"><?php echo esc_html($settings['guarantee_icon']); ?></div>
                        <?php endif; ?>
                        <h3><?php echo esc_html($settings['guarantee_title']); ?></h3>
                        <p><?php echo $settings['guarantee_desc_html']; ?></p>
                    </div>
                <?php endif; ?>

            </div>
        </section>
<?php
    }
}
