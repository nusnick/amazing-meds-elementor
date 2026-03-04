<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds FAQ Widget
 */
class AM_Hair_FAQ_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_faq';
    }

    public function get_title()
    {
        return esc_html__('AM Hair FAQ', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-widget-faq', plugins_url('../assets/css/widgets/faq.css', __FILE__));
        return ['am-widget-faq'];
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
                'default' => esc_html__('Frequently Asked Questions', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label' => esc_html__('Question', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('FAQ Question', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => esc_html__('Answer', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('FAQ Answer...', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'faqs',
            [
                'label' => esc_html__('FAQs', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question' => 'Who is this for?',
                        'answer' => 'Women 18+ experiencing hair thinning, shedding, or female pattern hair loss. Not recommended if you\'re pregnant, planning to become pregnant, or breastfeeding. Your provider reviews your full health history before prescribing.',
                    ],
                    [
                        'question' => 'Why start on a lower dose?',
                        'answer' => 'Oral minoxidil can cause side effects like unwanted hair growth and fluid retention. Starting at 0.25mg and titrating up to 1.25mg based on your response is how dermatologists prescribe it in their offices. We follow the same clinical standard. One-size-fits-all companies skip this step because it\'s easier to ship everyone the same pill.',
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->add_control(
            'footer_text',
            [
                'label' => esc_html__('Footer Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Still have questions?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'footer_link_text',
            [
                'label' => esc_html__('Footer Link Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact Us', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'footer_link_url',
            [
                'label' => esc_html__('Footer Link URL', 'amazing-meds-elementor'),
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
                </div>

                <?php if (!empty($settings['faqs'])): ?>
                    <div class="am-faq-container" style="margin-top: 48px;">
                        <?php foreach ($settings['faqs'] as $index => $faq): ?>
                            <div class="am-faq-item <?php echo (0 === $index) ? 'open' : ''; ?>"
                                onclick="this.classList.toggle('open')">
                                <div class="am-faq-question">
                                    <span>
                                        <?php echo esc_html($faq['question']); ?>
                                    </span>
                                    <div class="chevron">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="am-faq-answer">
                                    <p>
                                        <?php echo esc_html($faq['answer']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (!empty($settings['footer_link_text'])): ?>
                            <div class="am-faq-footer">
                                <?php echo esc_html($settings['footer_text']); ?>
                                <a href="<?php echo esc_url($settings['footer_link_url']['url']); ?>">
                                    <?php echo esc_html($settings['footer_link_text']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
