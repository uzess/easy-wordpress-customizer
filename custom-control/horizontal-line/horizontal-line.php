<?php
/**
*
* A Custom control for post dropdown
*
* @since 1.0.0
*
* @package Easy WordPress Customizer
*
* @uses  Class WP_Customize_Control
* 
*/
if ( class_exists( 'WP_Customize_Control' ) ) :

	class Easy_Customizer_Horizontal_Line extends WP_Customize_Control {

		public $type = 'horizontal-line';

		/**
		*    
		* Adds the horizontal line
		* @since  1.0.0
		* @access public
		* @return void   
		*  
		* @package Easy WordPress Customizer
		*/ 
		public function render_content() { ?>
			<style>
				hr{
					border-top: 7px solid #e6e6e6;
					border-bottom: 0;
				}
			</style>
			<div class="horizontal-line">
				<hr>
				<span class="customize-control-title"><?php echo esc_html( $this->label ) ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ) ?></span>
			</div>
		<?php }

	}

endif;

Easy_Customizer::add_custom_control( array(
    'type'     => 'horizontal-line',
    'class'    => 'Easy_Customizer_Horizontal_Line',
    'sanitize' => false,
    'register_control_type' => false
));