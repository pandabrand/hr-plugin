<?php
/*
Plugin Name: Hardrock Hotel Travel Custom Post Types
Description: Custom Post Types for Hardrock Hotel Travel website.
Author: Frederick Wells
Author URI: http://www.pandabrand.net
Version: 1.0.6
*/


add_action( 'init', 'culture_collide_cpt' );

function culture_collide_cpt() {
  //City post type
  register_post_type( 'city', array(
    'labels' => array(
      'name' => 'Cities',
      'singular_name' => 'City',
      'menu_name' => 'City',
      'name_admin_bar' => 'City',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New City',
      'edit_item' => 'Edit City',
      'new_item' => 'New City',
      'view_item' => 'View City',
      'search_items' => 'Search Cities',
      'not_found' => 'No Cities found',
      'not_found_in_trash' => 'No Cities in the trash.',
      'all_items' => 'Cities',
     ),
    'description' => 'Cities are post types that will be used in the Travel section of the Culture Collide website. They will be responsible for linking Artists to their home city and the Locations.',
    'public' => true,
    'menu_position' => 2,
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_nav_menus' => true,
    'has_archive' => true,
    'show_in_rest'       => true
  ));

  //Artist post type
  register_post_type( 'artist', array(
    'labels' => array(
      'name' => 'Artists',
      'singular_name' => 'Artist',
      'menu_name' => 'Artist',
      'name_admin_bar' => 'Artist',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Artist',
      'edit_item' => 'Edit Artist',
      'new_item' => 'New Artist',
      'view_item' => 'View Artist',
      'search_items' => 'Search Artists',
      'not_found' => 'No Artists found',
      'not_found_in_trash' => 'No Artists in the trash.',
      'all_items' => 'Artists',
     ),
    'description' => 'Artists are post types that will be used in the Travel section of the Culture Collide website. Artists will have a City post type and will have multiple Locations.',
    'public' => true,
    'menu_position' => 2,
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_nav_menus' => true,
    'has_archive' => true,
    'show_in_rest'       => true
  ));

  //Vibe Manager post type
  register_post_type( 'vibe-manager', array(
    'labels' => array(
      'name' => 'Vibe Managers',
      'singular_name' => 'Vibe Manager',
      'menu_name' => 'Vibe Manager',
      'name_admin_bar' => 'Vibe Manager',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Vibe Manager',
      'edit_item' => 'Edit Vibe Manager',
      'new_item' => 'New Vibe Manager',
      'view_item' => 'View Vibe Manager',
      'search_items' => 'Search Vibe Managers',
      'not_found' => 'No Vibe Managers found',
      'not_found_in_trash' => 'No Vibe Managers in the trash.',
      'all_items' => 'Vibe Managers',
     ),
    'description' => 'Vibe Managers are post types that will be used in the Travel section of the Culture Collide website. Vibe Managers will have a City post type and will have multiple Locations.',
    'public' => true,
    'menu_position' => 2,
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_nav_menus' => true,
    'has_archive' => true,
    'show_in_rest'       => true
  ));

  //Location post type
  register_post_type( 'location', array(
    'labels' => array(
      'name' => 'Locations',
      'singular_name' => 'Location',
      'menu_name' => 'Location',
      'name_admin_bar' => 'Location',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Location',
      'edit_item' => 'Edit Location',
      'new_item' => 'New Location',
      'view_item' => 'View Location',
      'search_items' => 'Search Locations',
      'not_found' => 'No Locations found',
      'not_found_in_trash' => 'No Locations in the trash.',
      'all_items' => 'Locations',
     ),
    'description' => 'Locations are post types that will be used in the Travel section of the Culture Collide website. Locations will belong to a City post type and can be associated to multiple Artists.',
    'public' => true,
    'menu_position' => 2,
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_nav_menus' => true,
    'has_archive' => true,
    'show_in_rest'       => true
  ));
}

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_59678d15071c3',
  'title' => 'Artist Field Group',
  'fields' => array (
    array (
      'key' => 'field_59678d21bb4dc',
      'label' => 'Excerpt Title',
      'name' => 'excerpt_title',
      'type' => 'text',
      'instructions' => 'Short title',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_59678d40bb4dd',
      'label' => 'Artist City',
      'name' => 'artist_city',
      'type' => 'relationship',
      'instructions' => '',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => array (
        0 => 'city',
      ),
      'taxonomy' => array (
      ),
      'filters' => array (
        0 => 'search',
      ),
      'elements' => '',
      'min' => 1,
      'max' => 1,
      'return_format' => 'object',
    ),
    array (
      'key' => 'field_59678d95bb4de',
      'label' => 'Artists Locations',
      'name' => 'artists_locations',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'row',
      'button_label' => 'Add Location',
      'sub_fields' => array (
        array (
          'key' => 'field_59678dd0bb4df',
          'label' => 'Location',
          'name' => 'location',
          'type' => 'relationship',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array (
            0 => 'location',
          ),
          'taxonomy' => array (
          ),
          'filters' => array (
            0 => 'search',
            1 => 'post_type',
          ),
          'elements' => '',
          'min' => '',
          'max' => '',
          'return_format' => 'object',
        ),
        array (
          'key' => 'field_59678e0ebb4e0',
          'label' => 'Location Comments',
          'name' => 'location_comments',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'maxlength' => '',
          'rows' => 4,
          'new_lines' => 'wpautop',
        ),
      ),
    ),
    array (
      'key' => 'field_59678e51bb4e1',
      'label' => 'Featured',
      'name' => 'featured',
      'type' => 'true_false',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
      'ui' => 1,
      'ui_on_text' => '',
      'ui_off_text' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'artist',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'vibe-manager',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

endif;

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_5967863fda8ec',
  'title' => 'City Field Group',
  'fields' => array (
    array (
      'key' => 'field_596786508782a',
      'label' => 'City Location',
      'name' => 'city_location',
      'type' => 'google_map',
      'instructions' => '',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'center_lat' => '',
      'center_lng' => '',
      'zoom' => '',
      'height' => 200,
    ),
    array (
      'key' => 'field_5967869a8782b',
      'label' => 'Photo Credit',
      'name' => 'photo_credit',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => 'Add photographer\'s name',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_596786c28782c',
      'label' => 'Featured',
      'name' => 'featured',
      'type' => 'true_false',
      'instructions' => 'Turn on for push to front page or menu features',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
      'ui' => 1,
      'ui_on_text' => '',
      'ui_off_text' => '',
    ),
    array (
      'key' => 'field_596787798782e',
      'label' => 'Hard Rock ID',
      'name' => 'hard_rock_id',
      'type' => 'text',
      'instructions' => 'Hard Rock Location ID for Hard Rock Hotels API',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_596837767f979',
      'label' => 'Locations',
      'name' => 'locations',
      'type' => 'relationship',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => array (
        0 => 'location',
      ),
      'taxonomy' => array (
      ),
      'filters' => array (
        0 => 'search',
      ),
      'elements' => '',
      'min' => '',
      'max' => '',
      'return_format' => 'id',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'city',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

endif;

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_59678f2509069',
	'title' => 'Location Field Group',
	'fields' => array (
		array (
			'key' => 'field_59678f327c532',
			'label' => 'Address',
			'name' => 'address',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => 200,
		),
		array (
			'key' => 'field_59678f517c533',
			'label' => 'Website',
			'name' => 'website',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_59685c31a8fd6',
			'label' => 'Photo Credit',
			'name' => 'photo_credit',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_5968371eb1dd1',
			'label' => 'Location City',
			'name' => 'location_city',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array (
				0 => 'city',
			),
			'taxonomy' => array (
			),
			'filters' => array (
				0 => 'search',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'id',
    ),
		array (
			'key' => 'hrh_field_290320201231',
			'label' => 'Instagram',
			'name' => 'instagram_url',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'hrh_field_290320201232',
			'label' => 'Instagram Image',
			'name' => 'instagram_image',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
  ),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'location',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

//Custom Categories for Locations
//hook into the init action and call create_locations_hierarchical_taxonomy when it fires
add_action( 'init', 'create_locations_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Location Type for your Locations

function create_locations_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Location Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Location Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Location Types' ),
    'all_items' => __( 'All Location Types' ),
    'parent_item' => __( 'Parent Location Type' ),
    'parent_item_colon' => __( 'Parent Location Type:' ),
    'edit_item' => __( 'Edit Location Type' ),
    'update_item' => __( 'Update Location Type' ),
    'add_new_item' => __( 'Add New Location Type' ),
    'new_item_name' => __( 'New Location Type' ),
    'menu_name' => __( 'Location Types' ),
  );

// Now register the taxonomy

  register_taxonomy('location_types',array('location'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'show_in_rest' => true,
    'rest_base' => 'location-types',
    'rewrite' => array( 'slug' => 'location-type' ),
  ));

}

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}


include_once( plugin_dir_path( __FILE__ ).'post_fields.php' );
include_once( plugin_dir_path( __FILE__ ).'cc-taxonomy.php' );
include_once( plugin_dir_path( __FILE__ ).'cc-api.php' );
include_once( plugin_dir_path( __FILE__ ).'migrate-fields.php' );
include_once( plugin_dir_path( __FILE__ ).'hr-graphql.php' );
