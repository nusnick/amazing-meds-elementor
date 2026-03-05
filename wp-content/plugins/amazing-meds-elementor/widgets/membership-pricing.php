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
        wp_register_style('am-membership-pricing', plugins_url('../assets/css/widgets/membership-pricing-v2.css', __FILE__));
        return ['am-membership-global', 'am-membership-pricing'];
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

        // Cards
        $this->start_controls_section(
            'cards_section',
            [
                'label' => esc_html__('Pricing Cards', 'amazing-meds-elementor'),
            ]
        );

        $card_repeater = new \Elementor\Repeater();
        $card_repeater->add_control('badge', ['label' => 'Badge', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'System 5 Lab Panel']);
        $card_repeater->add_control('price', ['label' => 'Price', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$75']);
        $card_repeater->add_control('price_suffix', ['label' => 'Price Suffix', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'deposit']);
        $card_repeater->add_control('features', ['label' => 'Features (one per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "Comprehensive 5-System Panel\n15-Min Results Call\nProvider Review\nInsurance Verification"]);
        $card_repeater->add_control('button_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Get Started']);
        $card_repeater->add_control('button_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $card_repeater->add_control('is_featured', ['label' => 'Featured', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '']);

        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Cards', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $card_repeater->get_controls(),
                'default' => [
                    [
                        'badge' => 'System 5 Lab Panel',
                        'price' => '$75',
                        'price_suffix' => 'deposit',
                        'features' => "Comprehensive 5-System Panel\n15-Min Results Call\nProvider Review\nInsurance Verification",
                        'is_featured' => '',
                    ],
                    [
                        'badge' => 'Ongoing Membership',
                        'price' => '$149',
                        'price_suffix' => '/ month',
                        'features' => "Full Protocol Management\nQuarterly Provider Visits\nPriority Support Access\nInsurance Denial Support\nExclusive Pharmacy Pricing",
                        'is_featured' => 'yes',
                    ],
                ],
                'title_field' => '{{{ badge }}}',
            ]
        );

        $this->end_controls_section();

        // Banner & Guarantee
        $this->start_controls_section(
            'extras_section',
            [
                'label' => esc_html__('Banner & Guarantee', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'banner_text',
            ['label' => 'Banner Bold Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Total value of services: $400+/mo']
        );
        $this->add_control(
            'banner_subtext',
            ['label' => 'Banner Subtext', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Your membership locks in your price and priority access.']
        );

        $this->add_control(
            'guarantee_title',
            ['label' => 'Guarantee Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our "True Feel" Guarantee']
        );
        $this->add_control(
            'guarantee_desc',
            ['label' => 'Guarantee Desc', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'If you don\'t feel a measurable difference in your energy, focus, or symptoms after your first 90 days of following our protocol, we\'ll refund your membership fees. Period.']
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
                    <?php if (!empty($settings['description'])): ?>
                        <p>
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($settings['cards'])): ?>
                    <div class="pricing-grid">
                        <?php foreach ($settings['cards'] as $card):
                            ?>
                            <?php
                            $card_class = 'pricing-card--standard';
                            if ('yes' === $card['is_featured']) {
                                $card_class = 'pricing-card--featured';
                            }
                            // If we want to support 'entry' we might need another control,
                            // but for now let's assume first one is entry if not featured?
                            // Actually let's just use featured vs standard as per current PHP.
                            // I'll adjust CSS to handle .pricing-card--standard.
                            ?>
                            <div class="pricing-card <?php echo esc_attr($card_class); ?>">
                                <div class="pricing-badge">
                                    <?php echo esc_html($card['badge']); ?>
                                </div>
                                <div class="price">
                                    <?php echo esc_html($card['price']); ?> <span>
                                        <?php echo esc_html($card['price_suffix']); ?>
                                    </span>
                                </div>

                                <?php if (!empty($card['features'])):
                                    $features = explode("\n", str_replace("\r", "", $card['features']));
                                    ?>
                                    <ul class="pricing-features">
                                        <?php foreach ($features as $feature): ?>
                                            <li>
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="3">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                <?php echo esc_html($feature); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($card['button_url']['url']); ?>"
                                    class="am-btn <?php echo ('yes' === $card['is_featured']) ? 'am-btn--gold' : 'am-btn--primary'; ?>">
                                    <?php echo esc_html($card['button_text']); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="pricing-value-banner">
                    <strong>
                        <?php echo esc_html($settings['banner_text']); ?>
                    </strong>
                    <span>
                        <?php echo esc_html($settings['banner_subtext']); ?>
                    </span>
                </div>

                <div class="pricing-guarantee">
                    <div class="guarantee-icon">
                        <?php echo esc_html($settings['guarantee_icon']); ?>
                    </div>
                    <div>
                        <h3>
                            <?php echo esc_html($settings['guarantee_title']); ?>
                        </h3>
                        <p>
                            <?php echo esc_html($settings['guarantee_desc']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
