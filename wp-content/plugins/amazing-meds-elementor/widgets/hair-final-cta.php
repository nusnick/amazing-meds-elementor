<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Final CTA Widget
 */
class AM_Hair_Final_CTA_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_final_cta';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Final CTA', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-widget-final-cta', plugins_url('../assets/css/widgets/final-cta.css', __FILE__));
        return ['am-widget-final-cta'];
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
            'cta_heading',
            [
                'label' => esc_html__('Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your hair didn\'t thin overnight. The recovery shouldn\'t be rushed either.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'cta_content',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>This protocol is for women who want more than a pill. It\'s for women who want to understand what\'s happening to their body and take control of it.</p><p>The Amazing Meds Hair Recovery Protocol starts with a dose your body can handle, adjusts when you\'re ready, and investigates the root cause if something deeper is driving your hair loss.</p>',
            ]
        );

        $this->add_control(
            'cta_price_callout',
            [
                'label' => esc_html__('Price Callout', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Your first month is $69.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'cta_price_note',
            [
                'label' => esc_html__('Price Note', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('After you submit your assessment, your assigned provider will reach out within 48 hours with your personalized protocol.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'cta_button_text',
            [
                'label' => esc_html__('Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Start My Hair Assessment - $69', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'cta_button_link',
            [
                'label' => esc_html__('Button Link', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'amazing-meds-elementor'),
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
        <div class="am-final-cta-wrapper">
            <div class="am-container">
                <div class="am-final-cta">
                    <h2><?php echo esc_html($settings['cta_heading']); ?></h2>
                    
                    <div class="cta-content">
                        <?php echo wp_kses_post($settings['cta_content']); ?>
                    </div>

                    <?php if (!empty($settings['cta_price_callout'])): ?>
                        <div class="price-callout">
                            <?php echo esc_html($settings['cta_price_callout']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['cta_price_note'])): ?>
                        <div class="price-note">
                            <?php echo esc_html($settings['cta_price_note']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['cta_button_text'])): ?>
                        <a href="<?php echo esc_url($settings['cta_button_link']['url']); ?>" 
                           class="am-btn am-btn--white am-btn--lg"
                           <?php echo $settings['cta_button_link']['is_external'] ? 'target="_blank"' : ''; ?>
                           <?php echo $settings['cta_button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                            <?php echo esc_html($settings['cta_button_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
