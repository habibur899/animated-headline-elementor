<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Animated Widget.
 *
 * Elementor widget that inserts an animated headline content into the page, from any given text.
 *
 * @since 1.0.0
 */
class Animated_Headline_Elementor_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Animated headline widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'animated-headline-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Animated headline widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Animated Headline', 'animated-headline-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Animated headline widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-animated-headline';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @return string Widget help URL.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Animated headline widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Animated headline widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return [ 'animated', 'headline', 'clip', 'slide', 'zoom', 'push' ];
	}

	/**
	 * Register Animated headline widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'animated-headline-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'animated_headline_before_title',
			[
				'label'       => esc_html__( 'Before Title', 'animated-headline-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Before Title', 'animated-headline-elementor' ),
				'placeholder' => esc_html__( 'Before Title', 'animated-headline-elementor' ),
			]
		);

		$this->add_control(
			'animated_headline_after_title',
			[
				'label'       => esc_html__( 'After Title', 'animated-headline-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'After Title', 'animated-headline-elementor' ),
				'placeholder' => esc_html__( 'After Title', 'animated-headline-elementor' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'animated_headline_title',
			[
				'label'   => esc_html__( 'Title', 'animated-headline-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Designer', 'animated-headline-elementor' ),
			]
		);


		$this->add_control(
			'animated_headline_list',
			[
				'label'  => esc_html__( 'Clip List', 'animated-headline-elementor' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'default'     => [

					[
						'title' => esc_html__( 'Designer', 'animated-headline-elementor' ),
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Animated headline widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings     = $this->get_settings_for_display();
		$before_title = $settings['animated_headline_before_title'];
		$after_title  = $settings['animated_headline_after_title'];
		?>
        <section class="cd-intro">
        <h1 class="cd-headline clip is-full-width">
            <span><?php echo esc_attr( $before_title ); ?></span>
            <span class="cd-words-wrapper">
                <?php
                $i = "";
                foreach ( $settings['animated_headline_list'] as $animated_headline_list ):
	                $class = $i == 1 ? 'visible' : 'hidden';
	                $i ++;
	                $clip_title = $animated_headline_list['animated_headline_title'];
	                ?>
                    <b class="is-<?php echo esc_attr( $class ); ?>"><?php echo esc_attr( $clip_title ); ?></b>
                <?php endforeach; ?>
			</span>
            <span><?php echo esc_attr( $after_title ); ?></span>
        </h1>
        </section><?php

	}

}