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
    write_log($category);
    write_log($field);
    hrh_insert_term_if_not_exists( $category, $field );
  }

  return $field;
}

add_filter('acf/load_field/name=hotel_category', 'hrh_category_load_field');
