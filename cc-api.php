<?php
/**
  * @api {get} /location-types/ Request List of current used location types
  * @apiVersion 1.0.0
  * @apiName GetLocationTypes
  * @apiGroup Categories
  *
  *
  * @apiSuccess {String[]} An Array of location types
*/
function get_location_location_types() {
  $args = array(
    'taxonomy' => 'location_types',
    'hide_empty' => true
  );

  $categories_terms = get_terms( $args );

  if ( empty( $categories_terms ) ) {
    return null;
  }

  $categories = wp_list_pluck( $categories_terms, 'name' );

  return $categories;
}

/**
  * @api {get} /hotels/ Request List of current cities with a HR Hotel ID
  * @apiVersion 1.0.0
  * @apiName GetHRHCities
  * @apiGroup Hotels
  *
  *
  * @apiSuccess {Object[]}  city An Array of City objects
  * @apiSuccess {Number}    city._id City id
  * @apiSuccess {String}    city.displayName Display Name of City
  * @apiSuccess {String}    city.hardrockId Hard Rock Hotel ID
*/
function get_hrh_cities() {
  $args = array(
    'post_type' => ['city'],
    'meta_query' => array(
         array(
             'key' => 'hard_rock_id',
             'value' => '',
             'compare' => '!='
         )
     )
  );

  $cities = get_posts( $args );

  if( empty( $cities ) ) {
    return null;
  }

  $hotel_cities = array();

  foreach($cities as $city) {
    $hardrock_id = get_field('hard_rock_id', $city->ID);

    $hotel_cities[] = array(
      '_id' => $city->ID,
      'displayName' => $city->post_title,
      'name' => $city->post_name,
      'hardRockId' => $hardrock_id
    );
  }

  return $hotel_cities;
}

/**
  * @api {get} /locations/:hotel_id Request List of locations associated from the city with this HR Hotel ID
  * @apiVersion 1.0.0
  * @apiName GetLocationsByHRHId
  * @apiGroup Locations
  *
  * @apiParam {String} hotel_id city Hotel unique ID
  * @apiParam {Number} [limit] Optional Number of locations to return defaults to 10, set to '-1' for all
  * @apiParam {Number} [offset] Optional Number to offset the return, default is 0
  * @apiParam {String} [location_types] Optional comma delimited list of location-types to filter by
  *
  * @apiSuccess {Object[]}  location An Array of Location objects
  * @apiSuccess {String}    location._id Location id
  * @apiSuccess {String}    location.name Name of Location
  * @apiSuccess {String}    location.description Description of Location
  * @apiSuccess {URL}       location.photo Url of the main photo
  * @apiSuccess {URL[]}     location.available_sizes Array of main photo in other sizes
  * @apiSuccess {String[]}  location.location_types Array of all Location Types tagged to this location
  * @apiSuccess {URL}       location.website Website of location
  * @apiSuccess {Object}    location.geo_location Object containing address and Lat/Lng info
  * @apiSuccess {String}    location.geo_location.address Address of location
  * @apiSuccess {String}    location.geo_location.lat Latitude of location
  * @apiSuccess {String}    location.geo_location.lng longitude of location
*/
function get_locations_by_hotel_id($data) {
  //&offset=:offset&location_types=:location_types
  //find hotel id, if none return null
  $hotel_id = $data['hotelId'];

  //get params if params not set use default for variable
  $limit = isset( $data['limit'] ) ? $data['limit'] : 10;
  $offset = isset( $data['offset'] ) ? $data['offset'] : 0;
  $location_types = isset( $data['location_types'] ) ? explode( ",", $data['location_types'] ) : array();

  if( empty( $hotel_id ) ) {
    return null;
  }

  //find city by hotel ID
  $cities = get_posts( array(
    'post_type' => ['city'],
    'meta_query' => array(
       array(
           'key' => 'hard_rock_id',
           'value' => $hotel_id,
           'compare' => '='
       )
     )
  ) );

  //assuming first city is the city we need because there should not be multiple cities with the same hotel id
  $city = $cities[0];

  if( empty( $city ) ) {
    return null;
  }

  $locations_args = array(
    'posts_per_page' => $limit,
    'offset' => $offset,
    'post_type' => ['location'],
    'meta_query' => array(
       array(
           'key' => 'location_city',
           'value' => '"' . $city->ID . '"',
           'compare' => 'LIKE'
       )
     )
  );

  if( !empty( $location_types ) ) {
    $locations_args['tax_query'] = array(
      array (
        'taxonomy' => 'location_types',
        'field' => 'slug',
        'terms' => $location_types
      )
    );
  }


  $locations = get_posts( $locations_args );

  $hrh_locations = array();
  $image_sizes = get_intermediate_image_sizes();

  foreach( $locations as $location ) {
    $photo = get_the_post_thumbnail_url( $location->ID, 'full' );
    $available_sizes = wp_get_attachment_image_src( get_post_thumbnail_id( $location->ID ), $image_sizes );
    $location_terms = get_the_terms( $location->ID, 'location_types' );
    $location_tags = wp_list_pluck( $location_terms, 'name' );
    $website = get_field('website', $location->ID);
    $address = get_field('address', $location->ID);

    $hrh_locations[] = array(
      '_id'             => $location->ID,
      'name'            => $location->post_title,
      'description'     => $location->post_content,
      'photo'           => $photo,
      'available_sizes' => $available_sizes,
      'location_types'  => $location_tags,
      'website'         => $website,
      'geo_location'    => $address
    );
  }

  return $hrh_locations;
}

function deactivated($data) {
  return ["message" => "no longer active"];
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'cc-api/v1', '/location-types/', array(
    'methods' => 'GET',
    'callback' => 'get_location_location_types',
  ) );

  register_rest_route( 'cc-api/v1', '/hotels/', array(
    'methods' => 'GET',
    'callback' => 'get_hrh_cities',
  ) );

  register_rest_route( 'cc-api/v1', '/locations/(?P<hotelId>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_locations_by_hotel_id',
  ) );

} );
