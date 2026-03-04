<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership System 5 Widget
 */
class AM_Membership_System_5_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_system_5';
    }

    public function get_title()
    {
        return esc_html__('AM Membership System 5', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-number-field';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-system-5', plugins_url('../assets/css/widgets/membership-system-5.css', __FILE__));
        return ['am-membership-system-5'];
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
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Why We\'re Different', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The System 5 Protocol™', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Hormones don\'t work in isolation. Neither should your care. Here are the five systems we check and why most clinics only check one.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('System Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'number',
                        'label' => esc_html__('Number', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '1',
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__('Title', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Hormonal Core', 'amazing-meds-elementor'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'description',
                        'label' => esc_html__('Description', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Complete hormone mapping: testosterone, estradiol, progesterone, SHBG, FSH, LH. The full picture, not a single number.', 'amazing-meds-elementor'),
                    ],
                    [
                        'name' => 'is_featured',
                        'label' => esc_html__('Featured', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => esc_html__('Yes', 'amazing-meds-elementor'),
                        'label_off' => esc_html__('No', 'amazing-meds-elementor'),
                        'return_value' => 'yes',
                        'default' => 'no',
                    ],
                ],
                'default' => [
                    [
                        'number' => '1',
                        'title' => 'Hormonal Core',
                        'description' => 'Complete hormone mapping: testosterone, estradiol, progesterone, SHBG, FSH, LH. The full picture, not a single number.',
                        'is_featured' => 'yes',
                    ],
                    [
                        'number' => '2',
                        'title' => 'Metabolic Engine',
                        'description' => 'Thyroid panel, fasting insulin, A1C, metabolic markers. The reason you\'re still tired and gaining weight even on hormones.',
                        'is_featured' => 'no',
                    ],
                    [
                        'number' => '3',
                        'title' => 'Protective Shield',
                        'description' => 'CBC, hematocrit, PSA, liver, kidney, lipids, cortisol, vitamin D. All monitored every quarter. We prescribe and watch.',
                        'is_featured' => 'no',
                    ],
                    [
                        'number' => '4',
                        'title' => 'Complete Protocol',
                        'description' => 'Multi-med coordination, compounding, dose optimization, and real adjustments every 90 days. Not "here\'s your script, good luck."',
                        'is_featured' => 'no',
                    ],
                    [
                        'number' => '5',
                        'title' => 'Coverage & Cost',
                        'description' => 'Insurance verification, labs billed to insurance, pharmacy routing, prior authorizations, denial appeals. You handle none of it.',
                        'is_featured' => 'no',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label' => esc_html__('Tagline', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('"Ask your clinic how many systems they check.<br>Their answer will tell you <em>everything</em>."', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Your Free Consult', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-system-5 am-section--system5">
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

                <?php if (!empty($settings['items'])): ?>
                    <div class="system5-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item):
                            $card_class = ('yes' === $item['is_featured']) ? 'system5-card--featured' : 'am-card';
                            ?>
                            <div class="system5-card <?php echo esc_attr($card_class); ?>">
                                <div class="step-num">
                                    <?php echo esc_html($item['number']); ?>
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

                <?php if (!empty($settings['tagline'])): ?>
                    <p class="system5-tagline">
                        <?php echo $settings['tagline']; ?>
                    </p>
                <?php endif; ?>

                <div style="text-align:center; margin-top: 32px;">
                    <a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="am-btn--primary">
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php
    }
}
