<?php
add_action( 'save_post', 'should_trigger_reverb_build', 10,3 );
function should_trigger_reverb_build( $post_id, $post, $update ) {
  $city_id = null;

  if( $post->post_type ==='city' ) {
    $city_id = $post_id;
  }

  if ( $post->post_type === 'artist' ) {
    $artist_city_array = get_field('artist_city', $post->ID);
    $artist_city = array_pop( $artist_city_array );
    $city_id = $artist_city->ID;
  }

  if ( $post->post_type === 'location' ) {
    $location_city_array = get_field('location_city', $post->ID);
    $location_city = array_pop( $location_city_array );
    $city_id = $location_city;
  }

  if( in_array( $city_id, reverb_cities() ) ) {
    trigger_reverb_build( $city_id );
  } elseif ( 'attachment' === $post->post_type ) {
    // Again, less clunky way to do this but we're rolling with it for now
    trigger_reverb_build( 49384 );
    trigger_reverb_build( 48142 );
  }
}

function trigger_reverb_build( $city_id = null ) {
  // There is a less clunky way to do this but we're rolling with it for now
  $build_hooks = array(
    49384 => 'https://api.netlify.com/build_hooks/6650ada4620e7f1ca34d939e',
    48142 => 'https://api.netlify.com/build_hooks/5f564f85e319ee44895d8125'
  );
  $data_string = json_encode(array());
  $build_url = $build_hooks[$city_id];
	$ch = curl_init($build_url);                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	    'Content-Type: application/json',                                                                                
	    'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
	                                                                                                                     
  $result = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	return $httpCode == 200;
}

function reverb_cities() {
  $args = array(
      'post_type' => 'city',
      'tax_query' => array(
          array(
              'taxonomy' => 'hotel',
              'field' => 'slug',
              'terms' => 'reverb',
              'operator' => 'IN'
          ),
      )
  );

  $posts = get_posts( $args );
  $city_ids = wp_list_pluck( $posts, 'ID' );
  return $city_ids;
}
