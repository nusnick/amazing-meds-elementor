<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds Membership Comparison Widget
 */
class AM_Membership_Comparison_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_membership_comparison';
    }

    public function get_title()
    {
        return esc_html__('AM Membership Comparison', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-table';
    }

    public function get_categories()
    {
        return ['amazing-meds'];
    }

    public function get_style_depends()
    {
        wp_register_style('am-membership-global', plugins_url('../assets/css/widgets/am-membership-global.css', __FILE__));
        wp_register_style('am-membership-comparison', plugins_url('../assets/css/widgets/membership-comparison-v2.css', __FILE__));
        return ['am-membership-global', 'am-membership-comparison'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Header', 'amazing-meds-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('See The Difference', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('How we compare', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Most clinics check one number. We check all five systems. Here\'s how that plays out.', 'amazing-meds-elementor'),
            ]
        );

        $this->end_controls_section();

        // Table Config
        $this->start_controls_section(
            'table_section',
            [
                'label' => esc_html__('Comparison Tables (Tabs)', 'amazing-meds-elementor'),
            ]
        );

        $tab_repeater = new \Elementor\Repeater();

        $tab_repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__('Tab Title (e.g. Women\'s HRT)', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Women\'s HRT', 'amazing-meds-elementor'),
            ]
        );

        $tab_repeater->add_control('col_head_1', ['label' => 'Col 1 (Main Column)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What Gets Checked']);
        $tab_repeater->add_control('col_head_2', ['label' => 'Col 2 (Amazing Meds)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Amazing Meds']);
        $tab_repeater->add_control('col_head_3', ['label' => 'Col 3', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Your PCP']);
        $tab_repeater->add_control('col_head_4', ['label' => 'Col 4', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Midi Health']);
        $tab_repeater->add_control('col_head_5', ['label' => 'Col 5', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Winona']);
        $tab_repeater->add_control('col_head_6', ['label' => 'Col 6', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Evernow']);

        $row_repeater = new \Elementor\Repeater();
        $row_repeater->add_control('row_label', ['label' => 'System Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '1. Hormonal Core']);
        $row_repeater->add_control('row_desc', ['label' => 'System Desc', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Estradiol, Progesterone, T, FSH, LH']);

        $status_options = [
            'check' => 'Check (✓)',
            'cross' => 'Cross (✗)',
            'partial' => 'Partial',
        ];

        $row_repeater->add_control('val_2', ['label' => 'Val Col 2', 'type' => \Elementor\Controls_Manager::SELECT, 'options' => $status_options, 'default' => 'check']);
        $row_repeater->add_control('val_3', ['label' => 'Val Col 3', 'type' => \Elementor\Controls_Manager::SELECT, 'options' => $status_options, 'default' => 'partial']);
        $row_repeater->add_control('val_4', ['label' => 'Val Col 4', 'type' => \Elementor\Controls_Manager::SELECT, 'options' => $status_options, 'default' => 'cross']);
        $row_repeater->add_control('val_5', ['label' => 'Val Col 5', 'type' => \Elementor\Controls_Manager::SELECT, 'options' => $status_options, 'default' => 'cross']);
        $row_repeater->add_control('val_6', ['label' => 'Val Col 6', 'type' => \Elementor\Controls_Manager::SELECT, 'options' => $status_options, 'default' => 'cross']);

        $tab_repeater->add_control(
            'rows',
            [
                'label' => esc_html__('Table Rows', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $row_repeater->get_controls(),
                'title_field' => '{{{ row_label }}}',
            ]
        );

        $tab_repeater->add_control('footer_label', ['label' => 'Footer Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'System Score']);
        $tab_repeater->add_control('footer_val_2', ['label' => 'Footer Val Col 2', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '5 / 5']);
        $tab_repeater->add_control('footer_val_3', ['label' => 'Footer Val Col 3', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '1 / 5']);
        $tab_repeater->add_control('footer_val_4', ['label' => 'Footer Val Col 4', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '2 / 5']);
        $tab_repeater->add_control('footer_val_5', ['label' => 'Footer Val Col 5', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '1.5 / 5']);
        $tab_repeater->add_control('footer_val_6', ['label' => 'Footer Val Col 6', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '1.5 / 5']);

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__('Comparison Tables', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $tab_repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
                'default' => [
                    [
                        'tab_title' => 'Women\'s HRT',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        // Callouts Section
        $this->start_controls_section(
            'callouts_section',
            [
                'label' => esc_html__('Flag Callouts', 'amazing-meds-elementor'),
            ]
        );

        $callout_repeater = new \Elementor\Repeater();
        $callout_repeater->add_control('text', ['label' => 'Problem Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Pharmacy rejected your script, nobody called back.']);
        $callout_repeater->add_control('answer', ['label' => 'Our Answer', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'We handle prior authorizations and find alternatives while you wait.']);

        $this->add_control(
            'callouts',
            [
                'label' => esc_html__('Red Flag items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $callout_repeater->get_controls(),
                'default' => [
                    [
                        'text' => 'Pharmacy rejected your script, nobody called back.',
                        'answer' => 'We handle prior authorizations and find alternatives while you wait.',
                    ],
                    [
                        'text' => 'They only check hormones. Nothing else.',
                        'answer' => 'We monitor 5 systems. Every quarter. Labs billed to insurance.',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label' => esc_html__('Tagline', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('You don\'t have to switch. Just ask your clinic one question:<br>"How many systems do you check?"<br>Their answer will tell you <em>everything</em>.', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'primary_button_text',
            [
                'label' => esc_html__('Primary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Your Free Consult', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'primary_button_url',
            [
                'label' => esc_html__('Primary Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'secondary_button_text',
            [
                'label' => esc_html__('Secondary Button Text', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Membership Options', 'amazing-meds-elementor'),
            ]
        );

        $this->add_control(
            'secondary_button_url',
            [
                'label' => esc_html__('Secondary Button URL', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#pricing',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <section class="am-membership-global am-section--compare" id="compare-<?php echo esc_attr($widget_id); ?>">
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
                    <?php if (!empty($settings['description'])): ?>
                        <p>
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($settings['tabs'])): ?>
                    <div class="compare-tabs" style="margin-top: var(--sub-to-content);">
                        <div class="compare-tabs-nav">
                            <?php foreach ($settings['tabs'] as $index => $tab): ?>
                                <button class="compare-tab-btn <?php echo 0 === $index ? 'active' : ''; ?>"
                                    data-tab="tab-<?php echo esc_attr($widget_id . '-' . $index); ?>">
                                    <?php echo esc_html($tab['tab_title']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <div class="compare-tabs-content">
                            <?php foreach ($settings['tabs'] as $index => $tab): ?>
                                <div class="compare-tab-panel <?php echo 0 === $index ? 'active' : ''; ?>"
                                    id="tab-<?php echo esc_attr($widget_id . '-' . $index); ?>">
                                    <div class="compare-table-wrapper">
                                        <table class="compare-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo esc_html($tab['col_head_1']); ?>
                                                    </th>
                                                    <th class="am-col">
                                                        <?php echo esc_html($tab['col_head_2']); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo esc_html($tab['col_head_3']); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo esc_html($tab['col_head_4']); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo esc_html($tab['col_head_5']); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo esc_html($tab['col_head_6']); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($tab['rows'])): ?>
                                                    <?php foreach ($tab['rows'] as $row): ?>
                                                        <tr>
                                                            <td>
                                                                <span class="system-label">
                                                                    <?php echo esc_html($row['row_label']); ?>
                                                                </span>
                                                                <span class="system-desc">
                                                                    <?php echo esc_html($row['row_desc']); ?>
                                                                </span>
                                                            </td>
                                                            <td class="am-col">
                                                                <?php $this->render_status($row['val_2']); ?>
                                                            </td>
                                                            <td>
                                                                <?php $this->render_status($row['val_3']); ?>
                                                            </td>
                                                            <td>
                                                                <?php $this->render_status($row['val_4']); ?>
                                                            </td>
                                                            <td>
                                                                <?php $this->render_status($row['val_5']); ?>
                                                            </td>
                                                            <td>
                                                                <?php $this->render_status($row['val_6']); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>
                                                        <?php echo esc_html($tab['footer_label']); ?>
                                                    </td>
                                                    <td class="am-col" style="font-size:22px;">
                                                        <?php echo esc_html($tab['footer_val_2']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo esc_html($tab['footer_val_3']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo esc_html($tab['footer_val_4']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo esc_html($tab['footer_val_5']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo esc_html($tab['footer_val_6']); ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['callouts'])): ?>
                    <div class="compare-callouts">
                        <?php foreach ($settings['callouts'] as $callout): ?>
                            <div class="compare-callout-card">
                                <div class="callout-flag">🚩 Red Flag</div>
                                <p>
                                    <?php echo esc_html($callout['text']); ?>
                                </p>
                                <div class="callout-answer">
                                    <?php echo esc_html($callout['answer']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['tagline'])): ?>
                    <p class="compare-tagline" style="margin-top: 48px;">
                        <?php echo $settings['tagline']; ?>
                    </p>
                <?php endif; ?>

                <div class="compare-buttons" style="text-align:center; margin-top: 36px;">
                    <?php if (!empty($settings['primary_button_text'])): ?>
                        <a href="<?php echo esc_url($settings['primary_button_url']['url']); ?>" class="am-btn--primary-on-dark">
                            <?php echo esc_html($settings['primary_button_text']); ?>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($settings['secondary_button_text'])): ?>
                        <span style="display:inline-block; margin: 0 12px; color: rgba(255,255,255,0.3);">or</span>
                        <a href="<?php echo esc_url($settings['secondary_button_url']['url']); ?>"
                            class="am-btn--secondary-on-dark">
                            <?php echo esc_html($settings['secondary_button_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <script>
                document.querySelectorAll('.compare-tab-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const widget = btn.closest('.am-section--compare');
                        const tabId = btn.getAttribute('data-tab');

                        widget.querySelectorAll('.compare-tab-btn').forEach(b => b.classList.remove('active'));
                        widget.querySelectorAll('.compare-tab-panel').forEach(p => p.classList.remove('active'));

                        btn.classList.add('active');
                        widget.querySelector('#' + tabId).classList.add('active');
                    });
                });
            </script>
        </section>
        <?php
    }

    private function render_status($val)
    {
        if ('check' === $val) {
            echo '<span class="ck">✓</span>';
        } elseif ('cross' === $val) {
            echo '<span class="xk">✗</span>';
        } else {
            echo '<span class="pk">Partial</span>';
        }
    }
}
