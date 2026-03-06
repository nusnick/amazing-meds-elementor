<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership How It Works Widget
 */
class AM_Membership_How_It_Works_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_how_it_works';
    }

    public function get_title()
    {
        return esc_html__('AM Membership How It Works', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-editor-list-ol';
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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'How It Works']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Four steps to feeling amazing']
        );

        $this->add_control(
            'description',
            ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'No insurance headaches. No waiting rooms. Here\'s exactly what happens.']
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Steps', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'number',
                        'label' => 'Number',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '1',
                    ],
                    [
                        'name' => 'title',
                        'label' => 'Title',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Step Title',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Step description.',
                    ],
                ],
                'default' => [
                    [
                        'number' => '1',
                        'title' => 'Free Discovery Call',
                        'description' => 'Book a quick, no-pressure consultation with our care team. We\'ll review your history, answer your questions, and see if the System 5 Protocol™ is right for you.',
                    ],
                    [
                        'number' => '2',
                        'title' => 'The $75 Diagnostic Deposit',
                        'description' => 'Ready to move forward? A $75 deposit gets your 5-system labs ordered and books your official Provider Visit. The labs are billed directly to your insurance, and the $75 is fully credited toward your membership.',
                    ],
                    [
                        'number' => '3',
                        'title' => 'Your Protocol, Built for You',
                        'description' => 'Once your labs are back, you meet with your provider to review the data. No guessing. We design your custom protocol and route your prescriptions through the cheapest option (insurance or compounding).',
                    ],
                    [
                        'number' => '4',
                        'title' => 'Quarterly Optimization',
                        'description' => 'Every 90 days, we run new labs and fine-tune your doses. Your protocol evolves with you.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'btn_text',
            ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Book Your Free Consult']
        );

        $this->add_control(
            'btn_url',
            [
                'label' => 'Button URL',
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#'],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="how-it-works" class="am-section--how">
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

                <?php if (!empty($settings['items'])): ?>
                    <div class="steps-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="step-card">
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

                <?php if (!empty($settings['btn_text'])): ?>
                    <div style="text-align:center; margin-top: 40px;">
                        <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="am-btn--primary">
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
