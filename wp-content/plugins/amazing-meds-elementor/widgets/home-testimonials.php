<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Testimonials_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_testimonials';
    }

    public function get_title()
    {
        return esc_html__('AM Home Testimonials', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
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
            'section_content',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Real Stories From Patients']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Join thousands of satisfied customers who trust AmazingMeds.']);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('bg_image', ['label' => 'Background Video Thumbnail', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $repeater->add_control('views', ['label' => 'Views Count', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '15.4K']);
        $repeater->add_control('stars', ['label' => 'Stars (text)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '★★★★★']);
        $repeater->add_control('quote', ['label' => 'Quote', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '"I finally felt like someone was looking at the full picture—not just one number."']);
        $repeater->add_control('avatar', ['label' => 'Author Avatar', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $repeater->add_control('author_name', ['label' => 'Author Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Zeen Rai']);
        $repeater->add_control('author_title', ['label' => 'Author Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Product Manager']);

        $this->add_control(
            'testimonials',
            [
                'label' => 'Testimonials Cards',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['author_name' => 'Review 1'],
                    ['author_name' => 'Review 2'],
                    ['author_name' => 'Review 3'],
                ],
                'title_field' => '{{{ author_name }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style_testi',
            [
                'label' => esc_html__('Style', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'star_color',
            [
                'label' => esc_html__('Stars Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t-stars' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_bg',
            [
                'label' => esc_html__('Play Button BG', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-circ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_icon',
            [
                'label' => esc_html__('Play Icon Color', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-circ svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-testimonials">
            <section class="section am-home-container text-center" style="position: relative;">
                <h2 class="serif"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p><?php echo wp_kses_post($settings['subtitle']); ?></p>

                <div style="position: relative; max-width: 1050px; margin: 0 auto;">
                    <button class="nav-btn nav-prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </button>

                    <div class="testi-wrap">
                        <?php if (!empty($settings['testimonials'])): ?>
                            <?php foreach ($settings['testimonials'] as $testi): ?>
                                <div class="testi-card">
                                    <?php if (!empty($testi['bg_image']['url'])): ?>
                                        <img src="<?php echo esc_url($testi['bg_image']['url']); ?>" class="bg-img" alt="Video Background">
                                    <?php endif; ?>

                                    <div class="testi-overlay"></div>
                                    <div class="play-circ">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="var(--bg-dark)" stroke="none">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </div>
                                    <div class="view-c">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        <?php echo esc_html($testi['views']); ?>
                                    </div>

                                    <div class="t-content">
                                        <div class="t-stars"><?php echo esc_html($testi['stars']); ?></div>
                                        <p
                                            style="font-size: 13px; color: var(--text-dark); margin: 0; font-weight: 500; text-align: left;">
                                            <?php echo wp_kses_post($testi['quote']); ?>
                                        </p>
                                        <div class="t-auth">
                                            <?php if (!empty($testi['avatar']['url'])): ?>
                                                <img src="<?php echo esc_url($testi['avatar']['url']); ?>" alt="Avatar">
                                            <?php endif; ?>
                                            <div style="text-align: left;">
                                                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark);">
                                                    <?php echo esc_html($testi['author_name']); ?>
                                                </div>
                                                <div style="font-size: 11px; color: var(--text-muted);">
                                                    <?php echo esc_html($testi['author_title']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button class="nav-btn nav-next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </section>
        </div>
        <?php
    }
}
