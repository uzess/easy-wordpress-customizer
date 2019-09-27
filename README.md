# easy-wordpress-customizer
Light weight framework for creating advanced setting fields

### Installation
1. Upload the `easy-wordpress-customizer` folder to your `/wp-content/themes/themename` directory 
2. Activate it by including it in you functions.php
```php
<?php
require_once get_theme_file_path( '/easy-wordpress-customizer/class-loader.php' );
?>
```

### Backend Example
```php
<?php
function typography_options(){ 
    <?php
    /*
     * ------------------------------------------------------
     *  Call the function set
     * ------------------------------------------------------
     *
     * This will call the function in framework.php file from
     * where the pannel, setting and section are added.
     */

    Easy_Customizer::set(array(

       /**
    	* ------------------------------------------------------
    	*  Add pannel
    	* ------------------------------------------------------
    	*
    	* Pass the parameter 'panel' as array defining all the id,
    	* title and priority. 'id' is mandatory and other field are
    	* optional.
    	* @see https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
    	*
    	* If panel is already addded then you can just pass
    	* panal id without passing array.
    	* example 'panel' => 'panel-id'
    	*/
    	'panel' => array(
    	    'id' 		=> 'panel-id',
    	    'title' 	=> __( 'Panel', 'text-domain' ),
    	    'priority' 	=> 10
    	),

       /*
    	* ------------------------------------------------------
    	*  Add section ( mandatory )
    	* ------------------------------------------------------
    	*
    	* Pass the parameter 'section' as array defaning all the id,
    	* title, priority, description etc. You can see wordpress
    	* documentation for all the parameters.
    	*/
    	'section' => array(
    	    'id'       => 'section-id',
    	    'title'    => __( 'Section','text-domain' ),
    	    'priority' => 5,

    	),

       /**
    	* ------------------------------------------------------
    	*  Add field
    	* ------------------------------------------------------
    	*
    	* Pass the parameter 'field' as array defining all the id,
    	* title, priority, default, description etc. You can see wordpress
    	* documentation for all the parameters. Here muliple array
    	* are passed as user can add multiple field in a section.
    	* The possible control type can be text, textarea, color,
    	* file, image, url, email, number, checkbox, select, radio
    	* and dropdown.
    	*
    	* @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
    	* @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
    	*/
    	'fields' => array(

    	   /**
    		* ------------------------------------------------------
    		* Add Text Field
    		* ------------------------------------------------------
    		* This will add text field in customizer.
    		*/
    	    array(
    	        'id'	 => 'text-id',
    	        'label'  => __( 'Your Title', 'text-domain' ),
    	        'default'=> __( 'Business', 'text-domain' ),
    	        'type'   => 'text',
    	       /**
    	        * ------------------------------------------------------
    	        * Add selective refresh and pencil icon ( optional )
    	        * ------------------------------------------------------
    	        * This is used to do selective refresh and pencil button 
    	        * direct users to the option inside the customizer.
    	        * The parameter 'selector' is the jQuery selector to find
    	        * the container element for the partial, that is, a
    	        * partial's placement.
    	        *
    	        * @see https://developer.wordpress.org/reference/classes/wp_customize_selective_refresh/add_partial/
    	        * @param Array
    	        */
               'partial' =>	array(
               		'selector'	=>	'span#phone_number'
           		),
    	    ),

           /**
        	* ------------------------------------------------------
        	* Add Textarea
        	* ------------------------------------------------------
        	* This will add text field in customizer.
        	*/
            array(
                'id' 	  => 'textarea-id',
                'label'   => __( 'Your Textarea', 'text-domain' ),
    	        'default' => __( 'Business is located in Lalitpur Nepal.', 'text-domain'),
                'type'    => 'textarea',   
            ), 

           /**
        	* ------------------------------------------------------
        	* Add URL Field
        	* ------------------------------------------------------
        	* This will add URL field in customizer.
        	*/
            array(
                'id' 	  => 'url-id',
                'label'   => __( 'Your URL', 'text-domain' ),
    	        'default' => esc_url( 'https://usiness.com' ),
                'type'    => 'url',   
            ),

           /**
            * ------------------------------------------------------
            * Add Email Field
            * ------------------------------------------------------
            * This will add email field in customizer.
            */
            array(
                'id' 	  => 'email-id',
                'label'   => __( 'Your Email', 'text-domain' ),
                'default' => 'usiness@gmail.com',
                'type'    => 'email',   
            ),

           /**
        	* ------------------------------------------------------
        	* Add number Field
        	* ------------------------------------------------------
        	* This will add number field in customizer.
        	*/
            array(
                'id'      => 'number-id',
                'label'   => __( 'Your Number', 'text-domain' ),
                'default' => 10,
                'type'    => 'number',   
            ), 

    	   /**
    	    * ------------------------------------------------------
    	    *  Add Radio button
    	    * ------------------------------------------------------
    	    * If you are adding radio button then an extra parameter
    	    * 'choices' should be passed. The choices array can have
    	    * all the possible field needed for radio button.
    	    */
    	    array(
    	        'id' 	  => 'radio-id',
    	        'label'   =>  __( 'Your Radio Button', 'text-domain' ),
    	        'type'    => 'radio',
    	        'default' => 'a',
    	        'choices' => array(
    	            'a' => __( 'A', 'text-domain' ),
    	            'b' => __( 'B', 'text-domain' )
       			)
    	    ),

           /**
            * ------------------------------------------------------
            *  Add Drop down
            * ------------------------------------------------------
            * If you are adding Drop down then an extra parameter
            * 'choices' should be passed. The choices array can have
            * all the possible field needed for Drop down.
            */
            array(
                'id' 	  => 'select-id',
                'label'   =>  __( 'Your Dropdown Title', 'text-domain' ),
                'default' => 'a',
                'type'    => 'select',
                'choices' => array(
    	            'a' => __( 'A', 'text-domain' ),
    	            'b' => __( 'B', 'text-domain' )
       			 )
            ),

           /**
            * ------------------------------------------------------
            *  Add Checkbox
            * ------------------------------------------------------
            * This adds the checkbox on customizer.
            */
            array(
                'id' 	  => 'checkbox-id',
                'label'   =>  __( 'Your Checkbox Title', 'text-domain' ),
                'default' => true,
                'type'    => 'checkbox',
            ),

           /**
            * ------------------------------------------------------
            *  Add Color picker
            * ------------------------------------------------------
            * This adds the Color picker on customizer.
            */
    /*        array(
                'id' 	  => 'color-id',
                'label'   =>  __( 'Your Color Picker Title', 'text-domain' ),
                'default' => '#3f116b',
                'type'    => 'color',
            ),	*/

           /**
            * ------------------------------------------------------
            *  Add dropdown page
            * ------------------------------------------------------
            * This create the dropdown of all available pages.
            */
            array(
                'id' 	  => 'dropdown-id',
                'label'   =>  __( 'Your Dropdown Page Title', 'text-domain' ),
                'default' => 2,
                'type'    => 'dropdown-pages',
            ),	

            /**
            * ------------------------------------------------------
            *  Add dropdown post
            * ------------------------------------------------------
            * This create the dropdown of posts.
            * This is custom control type.
            */
            array(
                'id'      => 'dropdown-posts-id',
                'label'   =>  __( 'Your Dropdown Posts', 'text-domain' ),
                'default' => 1,
                'type'    => 'dropdown-posts'
            ),

            /**
            * ------------------------------------------------------
            *  Add Togggle button
            * ------------------------------------------------------
            * This create the toggle button.
            * This is custom control type.
            */
            array(
                'id'      => 'toggle-id',
                'label'   =>  __( 'Toggle', 'text-domain' ),
                'type'    => 'toggle',
            ),

            /**
            * ------------------------------------------------------
            *  Add Radio Image
            * ------------------------------------------------------
            * This create radio button of multiple images.
            * This is custom control type. 
            */
            array(
                'id'      => 'radio-image-id',
                'label'   => esc_html__( 'Layout', 'customizer' ),
                'type'    => 'radio-image',
                'choices' => array(
                    'content-sidebar' => array(
                        'label' => esc_html__( 'Content / Sidebar', 'customizer' ),
                        'url'   =>  get_template_directory_uri() . '/customizer/custom-control/radio-image/assets/images/1.png'
                    ),
                    'sidebar-content' => array(
                        'label' => esc_html__( 'Sidebar / Content', 'customizer' ),
                        'url'   => get_template_directory_uri() . '/customizer/custom-control/radio-image/assets/images/2.png'
                    ),
                    'content' => array(
                        'label' => esc_html__( 'Content - One Column', 'customizer' ),
                        'url'   => get_template_directory_uri() . '/customizer/custom-control/radio-image/assets/images/3.png'
                    )
                )
            ),

            array(
                'id'      => 'dimension',
                'label'   => esc_html__( 'Padding (px)', 'customizer' ),
                'type'    => 'dimensions',
                'default' => array(
                    'desktop' => array(
                        'top'    => 5,
                        'right'  => 5,
                        'bottom' => 5,
                        'left'   => 5,
                    ),
                    'tablet' => array(
                        'top'    => 10,
                        'right'  => 10,
                        'bottom' => 10,
                        'left'   => 10,
                    ),
                    'mobile' => array(
                        'top'    => 15,
                        'right'  => 15,
                        'bottom' => 15,
                        'left'   => 15,
                    )
                ),
                'dimension' => array(
                    'top',
                    'right',
                    'bottom',
                    'left'
                ),
            ),

            array(
                'id'      => 'dime',
                'label'   => esc_html__( 'Section Padding (px)', 'customizer' ),
                'type'    => 'dimensions',
                'dimension' => array(
                    'top',
                    'bottom',
                ),
                'default' => array(
                    'desktop' => array(
                        'top'    => 5,                    
                        'bottom' => 5,
                    ),
                    'tablet' => array(
                        'top'    => 10,
                        'bottom' => 10,                    
                    ),
                    'mobile' => array(
                        'top'    => 15,
                        'bottom' => 15,                
                    )
                ),
            ),
            array(
                'id'      => 'slider-id',
                'label'   =>  __( 'Slider (px)', 'text-domain' ),
                'type'    => 'slider',
                'default' => array(
                    'desktop' => 30,
                    'tablet'  => 40,
                    'mobile'  => 50,
                )
            ),
            array(
                'id'      => 'custom-text-id',
                'label'   =>  __( 'Text', 'text-domain' ),
                'type'    => 'text',
                'default' => array(
                    'desktop' => 'Desktop',
                    'tablet'  => 'Tablet',
                    'mobile'  => 'Mobile',
                )
            ),
            array(
                'id'    =>  'multicheck',
                'label' =>  'multicheck',
                'type'  =>  'multi-check',
                'default' => 'a',
                'choices' => array(
                    'a' => __( 'A', 'text-domain' ),
                    'b' => __( 'B', 'text-domain' ),
                    'c' => __( 'C', 'text-domain' ),
                 )
            ),
            array(
                'id'      =>  'iconselect',
                'label'   =>  'icon selector',
                'type'    =>  'icon',
                'default' => 'fas fa-dragon',
                'choices' => array(
                    'fa fa-bluetooth' => __( 'Bluetooth', 'text-domain' ),
                    'fa fa-car'       => __( 'Car', 'text-domain'       ),
                    'fa fa-heart'     => __( 'Heart', 'text-domain'     ),
                    'fa fa-android'   => __( 'Android', 'text-domain'   ),
                    'fa fa-apple'     => __( 'Apple', 'text-domain'     ),
                 )
            ),
            array(
                'id'      =>  'multi-select',
                'label'   =>  'Multi-select',
                'type'    =>  'select',
                'default' => 'a',
                'choices' => array(
                    'a' => __( 'Apple', 'text-domain'  ),
                    'b' => __( 'Banana', 'text-domain' ),
                    'c' => __( 'Orange', 'text-domain' ),
                    'd' => __( 'Papaya', 'text-domain' ),
                 )
            ),
            array(
                'id'      =>  'sortable',
                'label'   =>  'sortable',
                'type'    =>  'sortable',
                'default' => 'a',
                'choices' => array(
                    'a' => __( 'Apple', 'text-domain'  ),
                    'b' => __( 'Banana', 'text-domain' ),
                    'c' => __( 'Orange', 'text-domain' ),
                    'd' => __( 'Papaya', 'text-domain' ),
                 )
            ),
            array(
                'id'      =>  'buttonset',
                'label'   =>  'Buttonset',
                'type'    =>  'buttonset',
                'default' => 'a',
                'choices' => array(
                    'a' => __( 'Apple', 'text-domain'  ),
                    'b' => __( 'Banana', 'text-domain' ),
                    'c' => __( 'Orange', 'text-domain' ),
                 )
            ),
            array(
                'id'      =>  'range',
                'label'   =>  'Range',
                'type'    =>  'range',
                'default' => 40,
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 100
                )
            ),
            array(
                'id'      => 'custom-color-id',
                'label'   =>  __( 'Your Color Picker Title', 'text-domain' ),
                'default' => '#3f116b',
                'type'    => 'color',
            ),  
    	),
    ));
}
add_action( 'init', 'typography_options' );
?>
```

### Frontend Example
```php
<?php
# Use 'text-id' && 'textarea-id' 
# options as a title and tagline
add_filter( 'document_title_parts', 'my_title' );
function my_title( $title_parts ){

    $title = Easy_Customizer::get( 'text-id' );

    if( empty( $title ) )
    	$title = Easy_Customizer::get_default( 'text-id' );

    $description = Easy_Customizer::get( 'textarea-id' );
    
    return array(
        'title'   => $title,
        'tagline' => $description,
    );
}
```