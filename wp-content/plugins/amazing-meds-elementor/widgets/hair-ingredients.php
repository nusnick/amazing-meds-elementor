<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Ingredients Widget
 */
class AM_Hair_Ingredients_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_ingredients';
    }

    public function get_title()
    {
        return esc_html__('AM Hair Ingredients', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-info-circle';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-widget-ingredients', plugins_url('../assets/css/widgets/ingredients.css', __FILE__));
        return ['am-widget-ingredients'];
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
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Three clinically proven ingredients. One daily capsule. Two strength phases.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_1_label',
            [
                'label' => esc_html__('Phase 1 Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Phase 1 - Starter Month', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_1_doses',
            [
                'label' => esc_html__('Phase 1 Doses', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Biotin 5mg &middot; Minoxidil 0.25mg &middot; Spiro 25mg', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_2_label',
            [
                'label' => esc_html__('Phase 2 Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Phase 2 - Full Strength (Day 30+)', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'phase_2_doses',
            [
                'label' => esc_html__('Phase 2 Doses', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Biotin 5mg &middot; Minoxidil 1.25mg &middot; Spiro 25mg', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

        // Botanical Visual Section
        $this->start_controls_section(
            'botanical_section',
            [
                'label' => esc_html__('Botanical Visual', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $botanical_repeater = new \Elementor\Repeater();

        $botanical_repeater->add_control(
            'orb_image',
            [
                'label' => esc_html__('Orb Image', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $botanical_repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Spironolactone',
            ]
        );

        $botanical_repeater->add_control(
            'role',
            [
                'label' => esc_html__('Role', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Anti-Androgen',
            ]
        );

        $this->add_control(
            'botanical_ingredients',
            [
                'label' => esc_html__('Botanical Orbs', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $botanical_repeater->get_controls(),
                'default' => [
                    [
                        'name' => 'Spironolactone',
                        'role' => 'Anti-Androgen',
                    ],
                    [
                        'name' => 'Minoxidil',
                        'role' => 'Growth Activator',
                    ],
                    [
                        'name' => 'Biotin',
                        'role' => 'The Foundation',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ingredients_section',
            [
                'label' => esc_html__('Ingredients', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Ingredient Name', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'role',
            [
                'label' => esc_html__('Role', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Role/Sub-label', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'dose_description',
            [
                'label' => esc_html__('Dose / Full Sub-label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('25mg - The Description', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'ingredient_icon',
            [
                'label' => esc_html__('Card Icon', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Detailed description...', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'ingredients',
            [
                'label' => esc_html__('Ingredients', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => 'Spironolactone',
                        'role' => 'Anti-Androgen',
                        'dose_description' => '25mg - The Anti-Androgen',
                        'content' => 'Blocks DHT from binding to your hair follicle receptors, halting the hormone-driven thinning that causes most female pattern hair loss. Used by dermatologists for decades as a first-line treatment for women.',
                    ],
                    [
                        'name' => 'Minoxidil',
                        'role' => 'Growth Activator',
                        'dose_description' => '0.25mg &rarr; 1.25mg - The Growth Activator',
                        'content' => 'Reactivates dormant follicles and extends the growth phase of your hair cycle. We start you on a lower dose to minimize side effects like unwanted body hair and fluid retention, then scale up once your body has adjusted. This is exactly how top dermatologists prescribe oral minoxidil.',
                    ],
                    [
                        'name' => 'Biotin',
                        'role' => 'The Foundation',
                        'dose_description' => '5mg - The Foundation',
                        'content' => 'Supports keratin production, strengthens hair structure, and promotes healthy skin and nails. The most recommended hair supplement by women\'s health professionals.',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_control(
            'callout_title',
            [
                'label' => esc_html__('Callout Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Why do we start low?', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'callout_text',
            [
                'label' => esc_html__('Callout Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Oral minoxidil can cause unwanted body hair growth and water retention in some women. Starting at 0.25mg and monitoring your response before increasing to 1.25mg is the standard of care in dermatology. One-size-fits-all companies skip this step. We don\'t.', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--beige am-cap">
            <div class="am-container">
                <div class="am-heading-stack">
                    <h2>
                        <?php echo esc_html($settings['heading']); ?>
                    </h2>
                </div>

                <div class="am-phase-pills" style="margin-top: 36px;">
                    <div class="am-phase-pill">
                        <div class="phase-label">
                            <?php echo esc_html($settings['phase_1_label']); ?>
                        </div>
                        <div class="phase-doses">
                            <?php echo wp_kses($settings['phase_1_doses'], ['span' => [], 'middot' => []]); ?>
                        </div>
                    </div>
                    <div class="am-phase-pill" style="border: 2px solid var(--am-gold);">
                        <div class="phase-label">
                            <?php echo esc_html($settings['phase_2_label']); ?>
                        </div>
                        <div class="phase-doses">
                            <?php echo wp_kses($settings['phase_2_doses'], ['span' => [], 'middot' => []]); ?>
                        </div>
                    </div>
                </div>

                <!-- Botanical visual -->
                <div class="am-botanical">
                    <div class="am-botanical-inner">
                        <?php
                        foreach ($settings['botanical_ingredients'] as $index => $orb):
                            ?>
                            <div class="am-botanical-ingredient">
                                <div class="am-botanical-orb">
                                    <?php if (!empty($orb['orb_image']['url'])): ?>
                                        <img src="<?php echo esc_url($orb['orb_image']['url']); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="ing-name">
                                    <?php echo esc_html($orb['name']); ?>
                                </div>
                                <div class="ing-role">
                                    <?php echo esc_html($orb['role']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Detail cards -->
                <div class="am-ingredients-grid" style="margin-top: 40px;">
                    <?php foreach ($settings['ingredients'] as $item): ?>
                        <div class="am-card am-ingredient-card">
                            <div class="am-icon-circle am-icon-circle--beige">
                                <?php if (!empty($item['ingredient_icon']['url'])): ?>
                                    <img src="<?php echo esc_url($item['ingredient_icon']['url']); ?>" alt=""
                                        style="width: 32px; height: 32px; object-fit: contain;">
                                <?php endif; ?>
                            </div>
                            <h3>
                                <?php echo esc_html($item['name']); ?>
                            </h3>
                            <div class="dose">
                                <?php echo wp_kses($item['dose_description'], ['rarr' => []]); ?>
                            </div>
                            <p>
                                <?php echo esc_html($item['content']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($settings['callout_text'])): ?>
                    <div class="am-callout">
                        <div class="callout-title">
                            <?php echo esc_html($settings['callout_title']); ?>
                        </div>
                        <p>
                            <?php echo esc_html($settings['callout_text']); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
