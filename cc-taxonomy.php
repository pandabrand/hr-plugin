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

function hr_create_glossary_taxonomy(){
  if(!taxonomy_exists('glossary')){
      register_taxonomy('glossary',array('artist', 'city', 'location'),array(
          'show_ui' => false
      ));
  }
}
add_action('init','hr_create_glossary_taxonomy');

/* When the post is saved, saves our custom data */
function hr_save_first_letter( $post_id ) {
  // verify if this is an auto save routine.
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return $post_id;

  //check location (only run for posts)
  $limitPostTypes = array('city', 'artist', 'location');
  if (!in_array($_POST['post_type'], $limitPostTypes)) 
      return $post_id;

  // Check permissions
  if ( !current_user_can( 'edit_post', $post_id ) )
      return $post_id;

  // OK, we're authenticated: we need to find and save the data
  $taxonomy = 'glossary';

  //set term as first letter of post title, lower case
  wp_set_post_terms( $post_id, strtolower(substr($_POST['post_title'], 0, 1)), $taxonomy );

  //delete the transient that is storing the alphabet letters
  delete_transient( 'hr_archive_alphabet');
}
add_action( 'save_post', 'hr_save_first_letter' );

//create array from existing posts
function hr_run_once(){

  if ( false === get_transient( 'hr_run_once' ) ) {

      $taxonomy = 'glossary';
      $alphabet = array();

      $post_types = array('city', 'location', 'artist');
      foreach($post_types as $post_type) {

        $posts = get_posts(array(
          'numberposts' => -1,
          'post_type' => $post_type
        ) );
          
        foreach( $posts as $p ) :
          //set term as first letter of post title, lower case
          wp_set_post_terms( $p->ID, strtolower(substr($p->post_title, 0, 1)), $taxonomy );
        endforeach;
      }

      set_transient( 'hr_run_once', 'true' );

  }

}
add_action('init','hr_run_once');