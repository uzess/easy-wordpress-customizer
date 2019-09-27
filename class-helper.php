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

		/**
		 * Get uri of given file
		 *
		 * @static
		 * @access public
		 * @return string
		 * @since  1.0.0
		 *
		 * @package Gutenbiz WordPress Theme
		 */
		public static function get_theme_uri( $file ){
			return get_theme_file_uri( $file );
		}

		/**
		 * Enqueue scripts or styles
		 *
		 * @static
		 * @access public
		 * @return object
		 * @since  1.0.0
		 *
		 * @package Gutenbiz WordPress Theme
		 */
		public static function enqueue( $scripts ){ 

		    # Do not enqueue anything if no array is supplied.
		    if( ! is_array( $scripts ) ) return;

		    $scripts = apply_filters( self::with_prefix( 'block_scripts', '_') , $scripts );
		    $assets_version = self::get_assets_version();
		    foreach ( $scripts as $script ) {

		        # Do not try to enqueue anything if handler is not supplied.
		        if( ! isset( $script[ 'handler' ] ) )
		            continue;

		        $version = null;
		        if( isset( $script[ 'version' ] ) ){
		            $version = $script[ 'version' ];
		        }

		        $minified = isset( $script[ 'minified' ] ) ? $script[ 'minified' ] : true;
		        # Enqueue each vendor's style
		        if( isset( $script[ 'style' ] ) ){

		            $path = isset( $script[ 'absolute' ] ) ? $script[ 'style' ] : self::get_theme_uri( $script[ 'style' ] );

		            $dependency = array();
		            if( isset( $script[ 'dependency' ] ) ){
		                $dependency = $script[ 'dependency' ];
		            }

	            	if( 'production' == $assets_version && $minified ){
	            		$path = str_replace( '.css', '.min.css', $path );
	            	}
	           
		            wp_enqueue_style( $script[ 'handler' ], $path, $dependency, $version );
		        }

		        # Enqueue each vendor's script
		        if( isset( $script[ 'script' ] ) ){

		        	if( $script[ 'script' ] === true || $script[ 'script' ] === 1 ){
		        		wp_enqueue_script( $script[ 'handler' ] );
		        	}else{

			            $prefix = '';
			            if( isset( $script[ 'prefix' ] ) ){
			                $prefix = $script[ 'prefix' ];
			            }

			        	$path = '';
			        	if( isset( $script[ 'script' ] ) ){
			            	$path = self::get_theme_uri( $script[ 'script' ] );
			        	}

			            if( isset( $script[ 'absolute' ] ) ){
			                $path = $script[ 'script' ];
			            }

			            $dependency = array( 'jquery' );
			            if( isset( $script[ 'dependency' ] ) ){
			                $dependency = $script[ 'dependency' ];
			            }

			            $in_footer = true;

			            if( isset( $script[ 'in_footer' ] ) ){
			            	$in_footer = $script[ 'in_footer' ];
			            }

			            if( 'production' == $assets_version && $minified ){
			            	$path = str_replace( '.js', '.min.js', $path );
			            }
			            wp_enqueue_script( $prefix . $script[ 'handler' ], $path, $dependency, $version, $in_footer );

			            if( isset( $script['localize'] ) && count( $script['localize'] ) > 0 ) {
			            	wp_localize_script($prefix . $script[ 'handler' ] , $script['localize']['key'] , $script['localize']['data'] );
			            }
		        	}
		        }
		    }
		}

		/**
		* Get assets version
		*
		* @static
		* @access public
		* @return string
		* @since  1.0.0
		*
		* @package Gutenbiz WordPress Theme
		*/
		public static function get_assets_version(){
			return 'development';
		}
	}
endif;