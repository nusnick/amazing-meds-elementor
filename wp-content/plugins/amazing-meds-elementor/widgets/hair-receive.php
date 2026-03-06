<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Amazing Meds What You Receive Widget
 */
class AM_Hair_Receive_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'am_hair_receive';
    }

    public function get_title()
    {
        return esc_html__('AM Hair What You Receive', 'amazing-meds-elementor');
    }

    public function get_icon()
    {
        return 'eicon-box';
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
            'heading',
            [
                'label' => esc_html__('Heading', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Everything you need, delivered to your door and your inbox.', 'amazing-meds-elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Card Title', 'amazing-meds-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description text...', 'amazing-meds-elementor'),
            ]
        );

        $repeater->add_control(
            'is_featured',
            [
                'label' => esc_html__('Featured (Dark)', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'amazing-meds-elementor'),
                'label_off' => esc_html__('No', 'amazing-meds-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'checklist',
            [
                'label' => esc_html__('Checklist Items', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'amazing-meds-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Checklist item', 'amazing-meds-elementor'),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Cards', 'amazing-meds-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Your Medication Ships',
                        'description' => 'Your prescription 3-in-1 capsules ship directly from our licensed pharmacy to your door. Month 1 is a 30-day supply. Every quarter after that is a 90-day supply.',
                        'is_featured' => 'no',
                    ],
                    [
                        'title' => 'Your Digital Welcome Kit',
                        'description' => 'Emailed at signup with everything to start strong:',
                        'is_featured' => 'yes',
                        'checklist' => [
                            ['text' => 'Your assigned provider\'s name and credentials'],
                            ['text' => 'The Hormonal Hair Loss Guide: causes, protocol, and what to expect'],
                            ['text' => 'Progress photo guide: lighting, angles, timing'],
                            ['text' => 'Link to submit your Day 1 photos'],
                            ['text' => 'Personal protocol timeline with key milestones'],
                        ],
                    ],
                    [
                        'title' => 'Ongoing Digital Touchpoints',
                        'description' => 'Stay supported throughout your protocol:',
                        'is_featured' => 'no',
                        'checklist' => [
                            ['text' => 'Day 27 reminder before quarterly charge'],
                            ['text' => 'Quarterly provider review summary'],
                            ['text' => 'Protocol adjustment notifications'],
                            ['text' => 'Milestone emails at Month 3, 6, and 12'],
                        ],
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="am-section am-section--white am-cap">
            <div class="am-container">
                <div class="am-heading-stack">
                    <h2>
                        <?php echo esc_html($settings['heading']); ?>
                    </h2>
                </div>

                <?php if (!empty($settings['items'])): ?>
                    <div class="am-receive-grid" style="margin-top: 48px;">
                        <?php
                        $icons = [
                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>',
                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>',
                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                        ];
                        foreach ($settings['items'] as $index => $item):
                            $is_featured = ('yes' === $item['is_featured']);
                            $card_class = $is_featured ? 'am-card--dark' : 'am-card';
                            $icon_circle_class = $is_featured ? 'am-icon-circle--gold' : 'am-icon-circle--beige';
                            ?>
                            <div class="<?php echo esc_attr($card_class); ?> am-receive-card">
                                <div class="am-icon-circle <?php echo esc_attr($icon_circle_class); ?>">
                                    <?php echo $icons[$index % 3]; ?>
                                </div>
                                <h3>
                                    <?php echo esc_html($item['title']); ?>
                                </h3>
                                <p class="card-desc">
                                    <?php echo esc_html($item['description']); ?>
                                </p>

                                <?php if (!empty($item['checklist'])): ?>
                                    <ul class="am-checklist">
                                        <?php foreach ($item['checklist'] as $check): ?>
                                            <li>
                                                <svg class="ck" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                <?php echo esc_html($check['text']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
