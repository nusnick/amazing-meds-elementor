<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AM_Home_Care_Plan_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_home_care_plan';
    }

    public function get_title()
    {
        return esc_html__('AM Home Care Plan', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
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
                'label' => esc_html__('Header Content', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Your Care Plan']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Your Care Plan is designed to give you continuous, personalized support—not just a one-time prescription.']);

        $this->end_controls_section();

        // Left Panel (Pricing)
        $this->start_controls_section(
            'section_pricing',
            [
                'label' => esc_html__('Pricing Column', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('price_title', ['label' => 'Pricing Column Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Choose Your Plan']);

        $repeater_pricing = new \Elementor\Repeater();
        $repeater_pricing->add_control('price_val', ['label' => 'Price / Value', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$299']);
        $repeater_pricing->add_control('price_sub', ['label' => 'Subtext (e.g. per quarter)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'per quarter']);
        $repeater_pricing->add_control('badge_text', ['label' => 'Badge Text (Optional)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '']);
        $repeater_pricing->add_control('is_active', ['label' => 'Default Active?', 'type' => \Elementor\Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '']);
        $repeater_pricing->add_control('checklist_items', ['label' => 'Checklist Features (One per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "Dedicated advisor for visits\nPriority submissions\nCompound discounts"]);
        $repeater_pricing->add_control('plan_btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Get Started']);
        $repeater_pricing->add_control('plan_btn_url', ['label' => 'Button URL', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->add_control(
            'pricing_plans',
            [
                'label' => 'Pricing Plans',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_pricing->get_controls(),
                'default' => [
                    [
                        'price_val' => '$299',
                        'price_sub' => 'per quarter',
                        'badge_text' => '',
                        'is_active' => '',
                        'checklist_items' => "Dedicated advisor for visits\nPriority submissions and appeals handled\nExpedited prescription processing\nCompound and supplement discounts\nPartner prescription processing",
                        'plan_btn_text' => 'Get Started',
                        'plan_btn_url' => ['url' => '#']
                    ],
                    [
                        'price_val' => '$899',
                        'price_sub' => 'per year',
                        'badge_text' => 'Best Value • Save 20%',
                        'is_active' => 'yes',
                        'checklist_items' => "Dedicated advisor for visits\nPriority submissions and appeals handled\nExpedited prescription processing\nCompound and supplement discounts\nPartner prescription processing",
                        'plan_btn_text' => 'Get Started',
                        'plan_btn_url' => ['url' => '#']
                    ],
                ],
                'title_field' => '{{{ price_val }}} - {{{ price_sub }}}',
            ]
        );



        $this->end_controls_section();


        // Right Panel (Advocacy Cards)
        $this->start_controls_section(
            'section_advocacy',
            [
                'label' => esc_html__('Advocacy Column', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater_adv = new \Elementor\Repeater();
        $repeater_adv->add_control('title', ['label' => 'Card Title', 'type' => \Elementor\Controls_Manager::TEXT]);
        $repeater_adv->add_control('icon', [
            'label' => 'Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
        ]);
        $repeater_adv->add_control('is_highlight', ['label' => 'Highlight Style? (Tan)', 'type' => \Elementor\Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '']);
        $repeater_adv->add_control('items', ['label' => 'Bullet Items (One per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA]);

        $this->add_control(
            'adv_cards',
            [
                'label' => 'Advocacy Cards',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_adv->get_controls(),
                'default' => [
                    [
                        'title' => 'Health Advocacy',
                        'is_highlight' => '',
                        'items' => "Complete medical care\nQuarterly lab-based adjustments\nLabs every 90 days to keep your protocol evolving",
                        'icon' => ['value' => 'fas fa-stethoscope', 'library' => 'fa-solid']
                    ],
                    [
                        'title' => 'Insurance Advocacy',
                        'is_highlight' => 'yes',
                        'items' => "Prior authorization denial support\nRejection claims appeals\nEnd-to-end paperwork management",
                        'icon' => ['value' => 'fas fa-shield-alt', 'library' => 'fa-solid']
                    ],
                    [
                        'title' => 'Price Advocacy',
                        'is_highlight' => '',
                        'items' => "Metabolic and compound discounts\nLowest pharmacy routing\nMedication coupons\nCost alternatives",
                        'icon' => ['value' => 'fas fa-tags', 'library' => 'fa-solid']
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();


        // Bottom Features
        $this->start_controls_section(
            'section_features',
            [
                'label' => esc_html__('Bottom Grid', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater_bot = new \Elementor\Repeater();
        $repeater_bot->add_control('title', ['label' => 'Text', 'type' => \Elementor\Controls_Manager::TEXTAREA]);
        $repeater_bot->add_control('icon', [
            'label' => 'Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
        ]);

        $this->add_control(
            'bot_features',
            [
                'label' => 'Features',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_bot->get_controls(),
                'default' => [
                    ['title' => 'Comprehensive<br>Medical Care', 'icon' => ['value' => 'fas fa-user-md', 'library' => 'fa-solid']],
                    ['title' => 'Hormone & Metabolic<br>Monitoring', 'icon' => ['value' => 'fas fa-chart-bar', 'library' => 'fa-solid']],
                    ['title' => 'Dedicated Insurance<br>Advocacy', 'icon' => ['value' => 'fas fa-hands-helping', 'library' => 'fa-solid']],
                    ['title' => 'Insurance<br>Routing', 'icon' => ['value' => 'fas fa-route', 'library' => 'fa-solid']],
                    ['title' => 'Lowest Price<br>Routing', 'icon' => ['value' => 'fas fa-piggy-bank', 'library' => 'fa-solid']],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <div class="am-home-widget am-home-care-plan">
            <section class="section">
                <div class="plan-sec">
                    <div class="am-home-container">
                        <h2 class="serif text-center" style="color: var(--accent-gold); margin-bottom: 24px;">
                            <?php echo esc_html($settings['title']); ?>
                        </h2>
                        <p class="text-center" style="color: #D6CEC3; max-width: 600px; margin: 0 auto;">
                            <?php echo esc_html($settings['subtitle']); ?>
                        </p>

                        <div class="plan-grid">

                            <div class="plan-left">
                                <h3 style="font-size: 20px; text-align: center; margin-bottom: 24px;">
                                    <?php echo esc_html($settings['price_title']); ?>
                                </h3>

                                <?php if (!empty($settings['pricing_plans'])): ?>
                                    <div class="price-tog" id="price-tog-<?php echo esc_attr($widget_id); ?>">
                                        <?php
                                        $has_active = false;
                                        foreach ($settings['pricing_plans'] as $index => $plan):
                                            $is_active = ($plan['is_active'] === 'yes') || (!$has_active && $index === count($settings['pricing_plans']) - 1); // Defaults to active if checked, otherwise fallback
                                            if ($plan['is_active'] === 'yes')
                                                $has_active = true;
                                            ?>
                                            <div class="price-box <?php echo $is_active ? 'active' : ''; ?>"
                                                data-target="plan-list-<?php echo esc_attr($widget_id . '-' . $index); ?>">
                                                <?php if ($is_active): ?>
                                                    <div class="plan-check-icon">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                                            stroke-width="3">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </div>
                                                <?php endif; ?>

                                                <h3><?php echo esc_html($plan['price_val']); ?></h3>
                                                <p><?php echo esc_html($plan['price_sub']); ?></p>

                                                <?php if (!empty($plan['badge_text'])): ?>
                                                    <div class="badge-save"><?php echo esc_html($plan['badge_text']); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="price-checklists" id="price-lists-<?php echo esc_attr($widget_id); ?>">
                                        <?php
                                        $has_active = false;
                                        foreach ($settings['pricing_plans'] as $index => $plan):
                                            $is_active = ($plan['is_active'] === 'yes') || (!$has_active && $index === count($settings['pricing_plans']) - 1);
                                            if ($plan['is_active'] === 'yes')
                                                $has_active = true;
                                            ?>
                                            <div class="plan-list-container"
                                                id="plan-list-<?php echo esc_attr($widget_id . '-' . $index); ?>"
                                                style="display: <?php echo $is_active ? 'block' : 'none'; ?>">
                                                <ul class="check-list">
                                                    <?php
                                                    if (!empty($plan['checklist_items'])) {
                                                        $lines = explode("\n", strip_tags($plan['checklist_items']));
                                                        foreach ($lines as $line) {
                                                            if (trim($line) !== '') {
                                                                echo '<li>' . esc_html(trim($line)) . '</li>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                                <?php if (!empty($plan['plan_btn_text'])): ?>
                                                    <a href="<?php echo esc_url($plan['plan_btn_url']['url']); ?>" class="am-pill-btn"
                                                        style="width: 100%;">
                                                        <?php echo esc_html($plan['plan_btn_text']); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="plan-right">
                                <?php
                                if (!empty($settings['adv_cards'])) {
                                    foreach ($settings['adv_cards'] as $card) {
                                        $hl_class = ($card['is_highlight'] === 'yes') ? ' highlight' : '';
                                        ?>
                                        <div class="adv-card<?php echo esc_attr($hl_class); ?>">
                                            <div class="adv-icon">
                                                <?php
                                                if (!empty($card['icon']['value'])) {
                                                    \Elementor\Icons_Manager::render_icon($card['icon'], ['aria-hidden' => 'true']);
                                                } else {
                                                    echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06z"></path></svg>';
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <h4 style="font-size: 16px; margin-bottom: 4px; font-weight:600;">
                                                    <?php echo esc_html($card['title']); ?>
                                                </h4>

                                                <?php if (!empty($card['items'])): ?>
                                                    <ul class="adv-list">
                                                        <?php
                                                        $lines = explode("\n", strip_tags($card['items']));
                                                        foreach ($lines as $line) {
                                                            if (trim($line) !== '') {
                                                                echo '<li>' . esc_html(trim($line)) . '</li>';
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>

                        <?php if (!empty($settings['bot_features'])): ?>
                            <div class="feat-bot">
                                <?php foreach ($settings['bot_features'] as $feat): ?>
                                    <div class="feat-mini">
                                        <div class="feat-mini-icon">
                                            <?php
                                            if (!empty($feat['icon']['value'])) {
                                                \Elementor\Icons_Manager::render_icon($feat['icon'], ['aria-hidden' => 'true']);
                                            } else {
                                                echo '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>';
                                            }
                                            ?>
                                        </div>
                                        <?php echo wp_kses_post($feat['title']); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var togWrap = document.getElementById('price-tog-<?php echo esc_attr($widget_id); ?>');
                if (!togWrap) return;

                var boxes = togWrap.querySelectorAll('.price-box');
                boxes.forEach(function (box) {
                    box.addEventListener('click', function () {
                        // Reset all
                        boxes.forEach(function (b) {
                            b.classList.remove('active');
                            var icon = b.querySelector('.plan-check-icon');
                            if (icon) icon.remove();
                        });

                        // Activate this
                        this.classList.add('active');
                        if (!this.querySelector('.plan-check-icon')) {
                            this.insertAdjacentHTML('afterbegin', '<div class="plan-check-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>');
                        }

                        // Toggle lists
                        var parentGrid = this.closest('.plan-left');
                        var containers = parentGrid.querySelectorAll('.plan-list-container');
                        containers.forEach(function (cont) {
                            cont.style.display = 'none';
                        });

                        var targetId = this.getAttribute('data-target');
                        if (targetId) {
                            var targetEl = document.getElementById(targetId);
                            if (targetEl) targetEl.style.display = 'block';
                        }
                    });
                });
            });
        </script>
        <?php
    }
}
