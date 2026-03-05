<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Testimonials Widget
 */
class AM_Membership_Testimonials_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_testimonials';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Testimonials', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-global', plugins_url('../assets/css/widgets/am-membership-global.css', __FILE__));
        wp_register_style('am-membership-testimonials', plugins_url('../assets/css/widgets/membership-testimonials.css', __FILE__));
        return ['am-membership-global', 'am-membership-testimonials'];
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
            ['label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Success Stories']
        );

        $this->add_control(
            'title',
            ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Real results from real patients']
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Testimonials', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'stars',
                        'label' => 'Stars',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '★★★★★',
                    ],
                    [
                        'name' => 'content',
                        'label' => 'Content',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => '"I was on TRT for two years elsewhere and still felt like garbage. Amazing Meds checked my thyroid and insulin—turns out that was the missing piece. I finally have my energy back."',
                    ],
                    [
                        'name' => 'author_name',
                        'label' => 'Author Name',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Mark S.',
                    ],
                    [
                        'name' => 'author_meta',
                        'label' => 'Author Meta',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Patient since 2022',
                    ],
                ],
                'default' => [
                    [
                        'author_name' => 'Mark S.',
                        'author_meta' => 'Patient since 2022',
                    ],
                    [
                        'author_name' => 'Sarah J.',
                        'author_meta' => 'Patient since 2023',
                        'content' => '"I tried three different \'online clinics\' for menopause. They just sent a patch and never adjusted my dose. This team actually listens and tracks my progress every quarter."',
                    ],
                    [
                        'author_name' => 'David R.',
                        'author_meta' => 'Patient since 2021',
                        'content' => '"The System 5 Approach is legit. I didn\'t realize how much my metabolic health was affecting my performance until we fixed it alongside my hormones."',
                    ],
                ],
                'title_field' => '{{{ author_name }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-membership-global am-section--testimonials">
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
                </div>

                <?php if (!empty($settings['items'])): ?>
                    <div class="testimonials-grid" style="margin-top: var(--sub-to-content);">
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="testimonial-card">
                                <div class="testimonial-stars">
                                    <?php echo esc_html($item['stars']); ?>
                                </div>
                                <p class="testimonial-content">
                                    <?php echo $item['content']; ?>
                                </p>
                                <div class="testimonial-meta">
                                    <div class="testimonial-author">
                                        <strong>
                                            <?php echo esc_html($item['author_name']); ?>
                                        </strong>
                                        <span>
                                            <?php echo esc_html($item['author_meta']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
