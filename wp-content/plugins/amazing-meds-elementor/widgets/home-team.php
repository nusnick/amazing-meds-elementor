<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

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
        // General
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Meet Your Care Team']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Our team is made up of experienced medical professionals focused on delivering thoughtful, personalized care...']);
        $this->end_controls_section();

        // Main Doctor
        $this->start_controls_section(
            'section_main_doc',
            [
                'label' => esc_html__('Main Doctor', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('doc_img', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $this->add_control('doc_icon', ['label' => 'Top Icon (SVG)', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>']);
        $this->add_control('doc_name', ['label' => 'Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Dr. Jennifer Frangos']);
        $this->add_control('doc_titles', ['label' => 'Titles (Supports HTML)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'D.O., DABOM Board-Certified Family & Obesity Medicine Specialist<br><span style="color: var(--accent-gold);">Integrative & Functional Medicine</span>']);
        $this->add_control('doc_about_title', ['label' => 'About Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'About']);
        $this->add_control('doc_about_text', ['label' => 'About Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Meet Dr. Jennifer Frangos. She isn\'t your typical doctor...']);
        $this->add_control('doc_spec_title', ['label' => 'Areas Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Areas of Specialty']);
        $this->add_control('doc_spec_text', ['label' => 'Areas Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Weight Management & Metabolism, Hormone Health, Whole-Body Care.']);
        $this->end_controls_section();

        // Team members
        $this->start_controls_section(
            'section_team',
            [
                'label' => esc_html__('Team Members', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control('image', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $repeater->add_control('name', ['label' => 'Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Lynn']);
        $repeater->add_control('title', ['label' => 'Title (Supports HTML)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Peptide & HRT Nurse Practitioner<br><span style="color: var(--accent-gold);">Board-Certified in Internal Medicine</span>']);
        $repeater->add_control('desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Lynn specializes in hormone replacement...']);
        $this->add_control(
            'team_members',
            [
                'label' => 'Members',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['name' => 'Lynn'],
                    ['name' => 'Rachel']
                ],
                'title_field' => '{{{ name }}}',
            ]
        );
        $this->end_controls_section();

        // Stats Panel
        $this->start_controls_section(
            'section_stats',
            [
                'label' => esc_html__('Stats Banner', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        for ($i = 1; $i <= 3; $i++) {
            $this->add_control("stat_v_$i", ['label' => "Stat $i Value", 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '80']);
            $this->add_control("stat_s_$i", ['label' => "Stat $i Symbol", 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '+']);
            $this->add_control("stat_t_$i", ['label' => "Stat $i Text (HTML)", 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Licensed Providers<br><span style="opacity: 0.6;">Across all 50 states</span>']);
            $this->add_control("hr_$i", ['type' => \Elementor\Controls_Manager::DIVIDER]);
        }
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="am-home-widget am-home-team">
            <section class="section am-home-container">
                <h2 class="serif text-center"><?php echo wp_kses_post($settings['title']); ?></h2>
                <p class="text-center" style="max-width: 650px; margin: 0 auto 48px;">
                    <?php echo wp_kses_post($settings['subtitle']); ?>
                </p>

                <div class="team-top">
                    <div class="t-img-lg">
                        <?php if (!empty($settings['doc_img']['url'])): ?>
                            <img src="<?php echo esc_url($settings['doc_img']['url']); ?>"
                                alt="<?php echo esc_attr($settings['doc_name']); ?>">
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="sys-icon-circle"
                            style="background: var(--bg-card-tan); color: var(--text-dark); margin-bottom: 16px;">
                            <?php echo $settings['doc_icon']; ?>
                        </div>
                        <h3 class="serif" style="margin-bottom: 4px;"><?php echo wp_kses_post($settings['doc_name']); ?></h3>
                        <p style="font-size: 12px; margin-bottom: 24px;"><?php echo wp_kses_post($settings['doc_titles']); ?>
                        </p>

                        <h4 style="font-size: 16px; margin-bottom: 8px;">
                            <?php echo wp_kses_post($settings['doc_about_title']); ?>
                        </h4>
                        <p style="font-size: 13px; margin-bottom: 24px;">
                            <?php echo wp_kses_post($settings['doc_about_text']); ?>
                        </p>

                        <h4 style="font-size: 16px; margin-bottom: 8px;">
                            <?php echo wp_kses_post($settings['doc_spec_title']); ?>
                        </h4>
                        <p style="font-size: 13px; margin-bottom: 24px;"><?php echo wp_kses_post($settings['doc_spec_text']); ?>
                        </p>

                        <!-- Social defaults -->
                        <div style="display: flex; gap: 16px; color: var(--text-dark);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18.9 1.153h3.68l-8.04 9.19L24 22.846h-7.4l-5.8-7.584-6.64 7.584H.47l8.6-9.83L0 1.154h7.59l5.24 6.932ZM17.61 20.644h2.04L6.486 3.24H4.298Z" />
                            </svg>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M20.45 20.452h-3.55v-5.569c0-1.328-.03-3.037-1.85-3.037-1.85 0-2.14 1.445-2.14 2.939v5.667H9.35V9h3.41v1.561h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.455v6.286zM5.34 7.433c-1.14 0-2.06-.926-2.06-2.065 0-1.138.92-2.063 2.06-2.063 1.14 0 2.06.925 2.06 2.063 0 1.139-.92 2.065-2.06 2.065zm1.78 13.019H3.55V9h3.56v11.452zM22.23 0H1.77C.79 0 0 .774 0 1.729v20.542C0 23.227.79 24 1.77 24h20.45C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.22 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="team-bot">
                    <?php if (!empty($settings['team_members'])): ?>
                        <?php foreach ($settings['team_members'] as $mem): ?>
                            <div class="t-card-sm">
                                <div class="t-img-sm">
                                    <?php if (!empty($mem['image']['url'])): ?>
                                        <img src="<?php echo esc_url($mem['image']['url']); ?>" alt="<?php echo esc_attr($mem['name']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h3 class="serif" style="font-size: 24px; margin-bottom: 4px;">
                                        <?php echo wp_kses_post($mem['name']); ?>
                                    </h3>
                                    <p style="font-size: 11px; margin-bottom: 12px; line-height: 1.4;">
                                        <?php echo wp_kses_post($mem['title']); ?>
                                    </p>
                                    <div style="height: 1px; background: #D6CEC3; width: 30px; margin-bottom: 12px;"></div>
                                    <p style="font-size: 12px; margin: 0; color: var(--text-muted);">
                                        <?php echo wp_kses_post($mem['desc']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="stats-banner">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div class="stat">
                            <h3 class="serif">
                                <?php echo esc_html($settings["stat_v_$i"]); ?><span><?php echo esc_html($settings["stat_s_$i"]); ?></span>
                            </h3>
                            <p><?php echo wp_kses_post($settings["stat_t_$i"]); ?></p>
                        </div>
                    <?php endfor; ?>
                </div>

            </section>
        </div>
        <?php
    }
}
