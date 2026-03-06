<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Pricing Widget
 */
class AM_Hair_Pricing_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_pricing';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Pricing', 'amazing-meds-elementor');
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
        wp_register_style('am-hair-css', plugins_url('../assets/css/widgets/hair-global.css', __FILE__));
        return ['am-hair-css'];
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
            'heading',
            [
                'label' => esc_html__('Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Start for $69. Stay because it works.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'subheading',
            [
                'label' => esc_html__('Subheading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('The traditional dermatologist route costs $2,000+ in the first year between visits, labs, and follow-ups. Your first year with Amazing Meds starts at $69.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Month 1 - Starter Protocol', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'amount',
            [
                'label' => esc_html__('Amount', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$69', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'note',
            [
                'label' => esc_html__('Note / Billing Sub', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('One-time. Everything included.', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'is_featured',
            [
                'label' => esc_html__('Featured', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'amazing-meds-elementor'),
                'label_off' => esc_html__('No', 'amazing-meds-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Most Popular', 'amazing-meds-elementor'),
                'condition' => [
                    'is_featured' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Feature text', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Feature item', 'amazing-meds-elementor'),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Get Started - $69', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'btn_url',
            [
                'label' => esc_html__('Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Pricing Cards', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'label' => 'Month 1 - Starter Protocol',
                        'amount' => '$69',
                        'note' => 'One-time. Everything included.',
                        'is_featured' => 'no',
                        'features' => [
                            ['text' => '30 starter-dose 3-in-1 capsules'],
                            ['text' => 'Provider intake + tolerability assessment'],
                            ['text' => 'Async messaging with your provider'],
                            ['text' => 'Progress photo submission through portal'],
                            ['text' => 'Digital Welcome Kit + Hormonal Hair Loss Guide'],
                            ['text' => 'Free shipping'],
                        ],
                    ],
                    [
                        'label' => 'Day 30+ - Full-Strength Quarterly',
                        'amount' => '$89<span>/month</span>',
                        'note' => 'Billed $267/quarter',
                        'is_featured' => 'yes',
                        'badge_text' => 'Most Popular',
                        'features' => [
                            ['text' => '90-day supply of full-strength capsules'],
                            ['text' => 'Quarterly provider review before each shipment'],
                            ['text' => 'Protocol adjustments at no extra cost'],
                            ['text' => 'Progress photo tracking'],
                            ['text' => 'Hormone screening pathway (labs billed to insurance)'],
                            ['text' => 'Free shipping every 90 days'],
                        ],
                    ],
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->add_control(
            'capacity_text',
            [
                'label' => esc_html__('Capacity Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Currently accepting 50 new patients for Q2 2026.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'nosurprise_title',
            [
                'label' => esc_html__('No Surprise Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('No Surprises: Your Day 30 Transition', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'nosurprise_text',
            [
                'label' => esc_html__('No Surprise Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We know the jump to quarterly billing is a commitment. Here is exactly what happens: Your provider reviews your first month. If you\'re tolerating the medication well, they authorize your full-strength 90-day supply. You\'ll receive a reminder 3 days before your card is charged $267. If you want to cancel instead, just reply to that email. No penalties. No phone calls. No hoops.', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--white am-cap">
            <div class="am-container">
                <div class="am-heading-stack">
                    <h2>
                        <?php echo esc_html($settings['heading']); ?>
                    </h2>
                </div>
                <?php if (!empty($settings['subheading'])): ?>
                    <p class="am-pricing-anchor" style="margin-top: 16px;">
                        <?php echo esc_html($settings['subheading']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($settings['cards'])): ?>
                    <div class="am-pricing-grid" style="margin-top: 40px;">
                        <?php foreach ($settings['cards'] as $card):
                            $is_featured = ('yes' === $card['is_featured']);
                            $card_class = $is_featured ? 'am-card--featured' : 'am-card';
                            $btn_class = $is_featured ? 'am-btn--white' : 'am-btn--primary';
                            ?>
                            <div class="am-pricing-card <?php echo esc_attr($card_class); ?>" style="padding: 36px 32px;">
                                <?php if ($is_featured && !empty($card['badge_text'])): ?>
                                    <div class="am-pricing-badge"><span class="am-badge am-badge--gold">
                                            <?php echo esc_html($card['badge_text']); ?>
                                        </span></div>
                                <?php endif; ?>

                                <div class="pricing-label">
                                    <?php echo esc_html($card['label']); ?>
                                </div>
                                <div class="pricing-amount">
                                    <?php echo wp_kses($card['amount'], ['span' => []]); ?>
                                </div>
                                <div class="pricing-note">
                                    <?php echo esc_html($card['note']); ?>
                                </div>

                                <?php if (!empty($card['features'])): ?>
                                    <ul class="pricing-features">
                                        <?php foreach ($card['features'] as $feature): ?>
                                            <li>
                                                <svg class="ck" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                <?php echo esc_html($feature['text']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($card['btn_url']['url']); ?>"
                                    class="am-btn <?php echo esc_attr($btn_class); ?>">
                                    <?php echo esc_html($card['btn_text']); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['capacity_text'])): ?>
                    <p class="am-pricing-capacity">
                        <?php echo esc_html($settings['capacity_text']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($settings['nosurprise_text'])): ?>
                    <div class="am-callout am-nosurprise">
                        <div class="callout-title">
                            <?php echo esc_html($settings['nosurprise_title']); ?>
                        </div>
                        <p>
                            <?php echo esc_html($settings['nosurprise_text']); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
