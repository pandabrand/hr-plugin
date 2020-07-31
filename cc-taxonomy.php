<?php
add_action('init','cc_add_categories_to_cpt');
function cc_add_categories_to_cpt(){
  register_taxonomy_for_object_type( 'category', 'artist' );
  register_taxonomy_for_object_type( 'post_tag', 'artist' );
  register_taxonomy_for_object_type( 'category', 'vibe-manager' );
  register_taxonomy_for_object_type( 'post_tag', 'vibe-manager' );
  register_taxonomy_for_object_type( 'category', 'city' );
  register_taxonomy_for_object_type( 'post_tag', 'city' );
  register_taxonomy_for_object_type( 'category', 'location' );
  register_taxonomy_for_object_type( 'post_tag', 'location' );
}

function hrh_insert_term_if_not_exists($term, $taxonomy) {
  if (empty($term) || is_numeric($term)) {
      return $term;
  }

  if ($result = term_exists($term, $taxonomy)) {
      return $result['term_id'];
  }

  $result = wp_insert_term($term, $taxonomy);

  if (!is_wp_error($result)) {
      return $result['term_id'];
  }
}

function hrh_category_load_field( $field ) {
  $categories = array( 'Hard Rock Hotels', 'Reverb' );
  
  foreach( $categories as $category )
  {
    hrh_insert_term_if_not_exists( $category, $field['type'] );
  }

  return $field;
}

// add_filter('acf/load_field/name=hotel_category', 'hrh_category_load_field');

function hrh_register_taxonomy_hotels()
{
  $labels = [
    'name'              => _x('Hotels', 'taxonomy general name'),
    'singular_name'     => _x('Hotel', 'taxonomy singular name'),
    'search_items'      => __('Search Hotels'),
    'all_items'         => __('All Hotels'),
    'parent_item'       => __('Parent Hotel'),
    'parent_item_colon' => __('Parent Hotel:'),
    'edit_item'         => __('Edit Hotel'),
    'update_item'       => __('Update Hotel'),
    'add_new_item'      => __('Add New Hotel'),
    'new_item_name'     => __('New Hotel Name'),
    'menu_name'         => __('Hotel'),
  ];
  $args = [
    'hierarchical'      => true, // make it hierarchical (like categories)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'hotel'],
  ];
  register_taxonomy('hotel', ['city'], $args);
}

add_action('init', 'hrh_register_taxonomy_hotels');
