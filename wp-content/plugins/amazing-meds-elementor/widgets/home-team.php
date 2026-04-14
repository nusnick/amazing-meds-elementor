<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Home Team Widget
 */
class AM_Home_Team_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_team';
    }

    public function get_title()
    {
        return esc_html__('AM Home Team', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-person';
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
                'default' => esc_html__('The Faces Behind Your Transformation', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Dr. Amanda Reed', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'role',
            [
                'label' => esc_html__('Role', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Chief Medical Officer', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'team_members',
            [
                'label' => esc_html__('Team Members', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => 'Dr. Amanda Reed',
                        'role' => 'Chief Medical Officer',
                    ],
                    [
                        'name' => 'Dr. James Mitchell',
                        'role' => 'Lead Hormone Specialist',
                    ],
                    [
                        'name' => 'Dr. Lisa Chang',
                        'role' => 'Precision Health Expert',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-team">
            <div class="am-services-header">
                <?php if (!empty($settings['title'])): ?>
                    <h2 class="am-heading-large"><?php echo wp_kses_post($settings['title']); ?></h2>
                <?php endif; ?>
            </div>

            <div class="am-team-grid">
                <?php foreach ($settings['team_members'] as $item): ?>
                    <div class="am-team-member">
                        <div class="am-member-img">
                            <?php if (!empty($item['image']['url'])): ?>
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['name']); ?>"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="width: 100%; height: 100%; background: var(--am-beige-mid);"></div>
                            <?php endif; ?>
                        </div>
                        <div class="am-member-info">
                            <div class="am-member-role"><?php echo esc_html($item['role']); ?></div>
                            <h3 class="am-member-name"><?php echo esc_html($item['name']); ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="#" class="am-button am-button-dark">Meet Our Full Medical Team</a>
        </div>
        <?php
    }
}
