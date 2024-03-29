<?php
/**
 * ------------------------------------------------------
 *  Require framework.php file
 * ------------------------------------------------------
 *
 * @since 1.0.0
 * @package Easy WordPress Customizer
 */

require get_theme_file_path( 'easy-wordpress-customizer/class-helper.php' );

class Easy_Customizer_Loader extends Easy_Customizer_Helper{

	public function __construct(){

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'script' ), 99	);

		$path = '/easy-wordpress-customizer/';
		require self::get_theme_path( $path . 'class-framework.php' );

		# Custom Control
		$path .= 'custom-control/';
		require self::get_theme_path( $path . 'toggle/toggle.php'						);
		require self::get_theme_path( $path . 'radio-image/radio-image.php' 			);
		require self::get_theme_path( $path . 'dimensions/dimensions.php' 				);
		require self::get_theme_path( $path . 'slider/slider.php' 						);
		require self::get_theme_path( $path . 'icon-select/icon-select.php' 			);
		require self::get_theme_path( $path . 'buttonset/buttonset.php' 				);
		require self::get_theme_path( $path . 'color-picker/color-picker.php'			);
		require self::get_theme_path( $path . 'reset/reset.php'							);
		require self::get_theme_path( $path . 'horizontal-line/horizontal-line.php'		);
		require self::get_theme_path( $path . 'range/range.php'							);
	}

	/**
	 * Enqueue the style and scripts used in customizer
	 *
	 * @static
	 * @access public
	 * @return object
	 * @since  1.0.0
	 *
	 * @package Easy WordPress Customizer
	 */
	public static function script(){

		$scripts = array(
			array(
		        'handler'    => self::with_prefix( 'customize-js' ),
		        'script'     => 'easy-wordpress-customizer/assets/customizer.js',
		        'dependency' => array( 'jquery', 'customize-base', 'jquery-ui-slider' ),
		    ),
			array(
		        'handler' => self::with_prefix( 'customize-css' ),
		        'style'   => 'easy-wordpress-customizer/assets/customizer.css',
		    ),
		);

		self::enqueue( $scripts );

		wp_localize_script( self::with_prefix( 'customize-js' ), 'easyCustomizerColorPalette',
			array( 
				'colorPalettes' => array(
					'#000000',
					'#ffffff',
					'#dd3333',
					'#dd9933',
					'#eeee22',
					'#81d742',
					'#1e73be',
					'#8224e3',
				)
		 	)
		);
	}
}

new Easy_Customizer_Loader();
