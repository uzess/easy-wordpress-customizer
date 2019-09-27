<?php
/**
 * A helper class for theme
 *
 * @since 1.0.0
 *
 * @package Easy WordPress Customizer
 */
if( !class_exists( 'Easy_Customizer_Helper' ) ):
	class Easy_Customizer_Helper{

		/**
		 * Prefix for theme
		 *
		 * @return string
		 * @since 1.0.0
		 *
		 * @package Easy WordPress Customizer
		 */
		
		public static function get_prefix(){
			return 'easycustomizer';
		}		

		/**
		 * get string with a prefix
		 *
		 * @since 1.0.0
		 * @return string
		 *
		 * @package Easy WordPress Customizer
		 */
		public static function with_prefix( $content, $append = '-', $prepend = '', $imploder = ' ' ){
			if( is_array( $content ) ){

				$prefix_cls = array();
				foreach( $content as $c ){
					$prefix_cls[] = $prepend . self::get_prefix() . $append . trim( $c );
				}
				return implode( $imploder, $prefix_cls );
			}else{
				return $prepend . self::get_prefix() . $append . trim( $content );
			}
		}

		public static function with_prefix_selector( $content ){
			return str_replace( '%s', '.' . self::get_prefix(), $content );
		}

		/**
		 * Get path of given file
		 *
		 * @static
		 * @access public
		 * @return string
		 * @since  1.0.0
		 *
		 * @package Easy WordPress Customizer
		 */
		public static function get_theme_path( $file ){
			return get_theme_file_path( $file );
		}
	}
endif;