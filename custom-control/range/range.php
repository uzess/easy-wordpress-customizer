<?php
/**
 * Customizer Control: range.
 *
 * @since 1.0.0
 *
 * @package Easy WordPress Customizer
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Range control
 */
class Easy_Customizer_Range_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 *
	 * @package Easy WordPress Customizer
	 */
	public $type = 'range';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @package Easy WordPress Customizer
	 */
	public function to_json() {
		parent::to_json();

		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		} else {
			$this->json['default'] = $this->setting->default;
		}
		$this->json['value']       = $this->value();
		$this->json['choices']     = $this->choices;
		$this->json['link']        = $this->get_link();
		$this->json['id']          = $this->id;

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @package Easy WordPress Customizer
	 */
	protected function content_template() {
		?>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<div class="control-wrap">
				<input type="range" {{{ data.inputAttrs }}} value="{{ data.value }}" {{{ data.link }}} data-reset_value="{{ data.default }}" />
				<input type="number" {{{ data.inputAttrs }}} class="range-input" value="{{ data.value }}" />
				<span class="reset-slider"><span class="dashicons dashicons-image-rotate"></span></span>
			</div>
		</label>
		<?php
	}
}

Easy_Customizer::add_custom_control( array(
    'type'     => 'range',
    'class'    => 'Easy_Customizer_Range_Control',
    'sanitize' =>  array( 'Easy_Customizer', 'sanitize_number' ),
    'register_control_type' => true,
));