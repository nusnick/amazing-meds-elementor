<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds How It Works Widget
 */
class AM_Hair_How_It_Works_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_how_it_works';
    }

    public function get_title()
    {
        return esc_html__('AM Hair How It Works', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-flow-chart';
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
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('How It Works', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('From assessment to your doorstep. No waiting rooms, no guesswork.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step Title', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Step content description...', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'steps',
            [
                'label' => esc_html__('Steps', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Complete Your Hair Assessment (5 Minutes)',
                        'content' => 'Answer a few questions about your hair loss history, symptoms, and health background. Upload photos of your hair. No appointment needed. Your provider reviews everything and creates your personalized protocol within 48 hours.',
                    ],
                    [
                        'title' => 'Your Starter Month Arrives',
                        'content' => 'Your first 30-day supply ships to your door at a lower dose so your body adjusts safely with minimal side effects. Take one capsule daily. Your provider is available via async messaging for any questions. You\'ll also receive your digital Welcome Kit by email with your progress photo guide and "What to Expect in Your First 30 Days."',
                    ],
                    [
                        'title' => 'Graduate to Full Strength',
                        'content' => 'At Day 30, your provider reviews your tolerability and clears you for full-strength capsules. Your 90-day quarterly supply ships automatically. From here, your provider reviews your progress every quarter and adjusts your protocol as needed.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label' => esc_html__('CTA Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Start My Assessment', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'cta_url',
            [
                'label' => esc_html__('CTA URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
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
                    <p>
                        <?php echo esc_html($settings['description']); ?>
                    </p>
                </div>

                <?php if (!empty($settings['steps'])): ?>
                    <div class="am-steps-grid" style="margin-top: 48px;">
                        <?php
                        $count = count($settings['steps']);
                        foreach ($settings['steps'] as $index => $step):
                            ?>
                            <div class="am-step-card">
                                <div class="am-step-number">
                                    <?php echo $index + 1; ?>
                                </div>
                                <h3>
                                    <?php echo esc_html($step['title']); ?>
                                </h3>
                                <p>
                                    <?php echo esc_html($step['content']); ?>
                                </p>
                            </div>

                            <?php if ($index < $count - 1): ?>
                                <div class="am-step-arrow">
                                    <div class="arrow-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['cta_text'])): ?>
                    <div class="am-section-cta">
                        <a href="<?php echo esc_url($settings['cta_url']['url']); ?>" class="am-btn am-btn--primary am-btn--lg">
                            <?php echo esc_html($settings['cta_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
