<?php
add_action('init','cc_add_categories_to_cpt');
function cc_add_categories_to_cpt(){
  register_taxonomy_for_object_type( 'category', 'artist' );
  register_taxonomy_for_object_type( 'post_tag', 'artist' );
  register_taxonomy_for_object_type( 'category', 'city' );
  register_taxonomy_for_object_type( 'post_tag', 'city' );
  register_taxonomy_for_object_type( 'category', 'location' );
  register_taxonomy_for_object_type( 'post_tag', 'location' );
}
