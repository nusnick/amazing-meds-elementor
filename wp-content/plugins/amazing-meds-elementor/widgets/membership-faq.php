<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership FAQ Widget
 */
class AM_Membership_FAQ_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_faq';
    }

    public function get_title()
    {
        return esc_html__('AM Membership FAQ', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-help-o';
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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'FAQ']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Questions? We\'ve got answers.']
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('question', ['label' => 'Question', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What is the answer?']);
        $repeater->add_control('answer', ['label' => 'Answer', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'This is the answer.']);
        $repeater->add_control('is_active', ['label' => 'Open by default?', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '']);

        $this->add_control(
            'faqs',
            [
                'label' => esc_html__('FAQs', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question' => 'What\'s the difference between the $75 deposit and the membership?',
                        'answer' => 'Think of the $75 as your diagnostic deposit. It covers the administrative work to get your comprehensive 5-system labs ordered and billed to your insurance, plus your official Provider Visit to review the results. Once you and your provider agree on a treatment plan, that $75 is fully credited toward your $299 quarterly membership.',
                        'is_active' => 'yes',
                    ],
                    [
                        'question' => 'What does the membership include?',
                        'answer' => 'Full System 5 Protocol + 30% off medications + free shipping + same-day messaging + refill management and insurance advocacy.',
                        'is_active' => '',
                    ],
                    [
                        'question' => 'Do you accept insurance?',
                        'answer' => 'Yes, for labs and provider visits. Testosterone for men and estrogen/progesterone for women are typically covered. Testosterone for women is usually out of pocket. We actively accept and bill through Cigna, UHC, BCBS, Aetna, and Humana.',
                        'is_active' => '',
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->add_control('contact_text', ['label' => 'Contact Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Still have questions?']);
        $this->add_control('contact_link_text', ['label' => 'Contact Link Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Contact Us']);
        $this->add_control('contact_link', ['label' => 'Contact Link URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-section--faq"
            style="background: var(--am-white); padding: var(--section-pad-desktop) 0;">
            <div class="am-container container">
                <div class="am-heading-stack">
                    <?php if (!empty($settings['label'])): ?>
                        <div class="am-label">
                            <?php echo esc_html($settings['label']); ?>
                        </div>
                    <?php endif; ?>
                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                </div>

                <?php if (!empty($settings['faqs'])): ?>
                    <div class="faq-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['faqs'] as $faq):
                            $active_class = ('yes' === $faq['is_active']) ? 'active' : '';
                            ?>
                            <div class="faq-item <?php echo esc_attr($active_class); ?>">
                                <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                                    <?php echo esc_html($faq['question']); ?>
                                    <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round">
                                        <polyline points="6 9 12 15 18 9" />
                                    </svg>
                                </button>
                                <div class="faq-answer">
                                    <?php echo esc_html($faq['answer']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['contact_text'])): ?>
                    <p class="faq-contact">
                        <?php echo esc_html($settings['contact_text']); ?> <a
                            href="<?php echo esc_url($settings['contact_link']['url']); ?>">
                            <?php echo esc_html($settings['contact_link_text']); ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
