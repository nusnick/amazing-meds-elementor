<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home FAQ Widget
 */
class AM_Home_FAQ_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_faq';
    }

    public function get_title()
    {
        return esc_html__('AM Home FAQ', 'amazing-meds-elementor');
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
        return ['am-home-widgets'];
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
            'title',
            [
                'label' => esc_html__('Main Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Questions? We’ve Got Answers.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label' => esc_html__('Question', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Do you take insurance?', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => esc_html__('Answer', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Yes, we work with many major insurance providers for lab work and certain aspects of your care.', 'amazing-meds-elementor'),
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
                        'question' => 'Do you take insurance?',
                        'answer' => 'We accept insurance for lab work through our partners like Quest Diagnostics and Labcorp. The clinical membership fee is typically out-of-pocket, but may be HSA/FSA eligible.',
                    ],
                    [
                        'question' => 'How soon will I see results?',
                        'answer' => 'Many patients report feeling improvements in energy and mood within 2-4 weeks, though full physical optimization typically takes 3-6 months based on your unique metabolic profile.',
                    ],
                    [
                        'question' => 'Where do the labs happen?',
                        'answer' => 'We partner with over 2,000 lab locations nationwide, including Quest and Labcorp. We also offer mobile phlebotomy services in select areas if you prefer a home visit.',
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-faq">
            <div class="am-services-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
            </div>

            <div style="width: 100%; max-width: 800px;">
                <?php foreach ($settings['faqs'] as $index => $faq): ?>
                    <div class="am-faq-item">
                        <div class="am-faq-question" id="faq-q-<?php echo esc_attr($index); ?>">
                            <?php echo esc_html($faq['question']); ?>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="am-faq-answer" id="faq-a-<?php echo esc_attr($index); ?>" style="display: none;">
                            <?php echo wp_kses_post($faq['answer']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                $('.am-faq-question').on('click', function () {
                    var $answer = $(this).next('.am-faq-answer');
                    var $icon = $(this).find('svg');

                    $('.am-faq-answer').not($answer).slideUp();
                    $('.am-faq-question svg').not($icon).css('transform', 'rotate(0deg)');

                    $answer.slideToggle();
                    var rotation = $answer.is(':visible') ? '0deg' : '180deg';
                    $icon.css('transform', 'rotate(' + rotation + ')');
                });
            });
        </script>
        <?php
    }
}
