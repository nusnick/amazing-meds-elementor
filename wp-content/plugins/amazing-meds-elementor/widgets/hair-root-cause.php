<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Root Cause Widget
 */
class AM_Hair_Root_Cause_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_root_cause';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Root Cause', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-search';
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
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('The question no one else is asking: Why are you losing your hair?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('<p>Most hair loss companies treat the symptom. They give you minoxidil to stimulate growth and an anti-androgen to block DHT. That works for many women. But what if your hair loss is driven by something deeper?</p><p>Low testosterone. Thyroid dysfunction. Estrogen imbalance. Perimenopause. Chronic stress hormones. These are all common causes of hair loss in women, and a company that only sells hair pills will never find them.</p>', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label' => esc_html__('Tagline', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('They sell hair products. We treat patients.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'card_title',
            [
                'label' => esc_html__('Card Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Root causes we investigate', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Low testosterone levels', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => esc_html__('Investigation List', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => 'Low testosterone levels'],
                    ['text' => 'Thyroid dysfunction (hypo/hyper)'],
                    ['text' => 'Estrogen imbalance'],
                    ['text' => 'Perimenopause / menopause'],
                    ['text' => 'Chronic cortisol elevation'],
                    ['text' => 'DHEA-S imbalance'],
                    ['text' => 'Iron deficiency / ferritin'],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label' => esc_html__('CTA Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Start Your Assessment', 'amazing-meds-elementor'),
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
        <section class="am-section am-rootcause">
            <div class="am-container">
                <div class="am-rootcause-grid">
                    <div class="am-rootcause-text">
                        <h2>
                            <?php echo esc_html($settings['title']); ?>
                        </h2>
                        <?php echo $settings['description']; ?>
                        <?php if (!empty($settings['tagline'])): ?>
                            <p class="tagline">
                                <?php echo esc_html($settings['tagline']); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="am-rootcause-card">
                        <h3>
                            <?php echo esc_html($settings['card_title']); ?>
                        </h3>
                        <?php if (!empty($settings['list_items'])): ?>
                            <ul class="am-rootcause-list">
                                <?php foreach ($settings['list_items'] as $item): ?>
                                    <li><span class="dot"></span>
                                        <?php echo esc_html($item['text']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($settings['cta_text'])): ?>
                    <div class="am-section-cta" style="margin-top: 48px;">
                        <a href="<?php echo esc_url($settings['cta_url']['url']); ?>" class="am-btn am-btn--white am-btn--lg">
                            <?php echo esc_html($settings['cta_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
