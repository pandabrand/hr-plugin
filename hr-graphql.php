<?php
add_action( 'init', function() {
    register_post_type( 'city', [
      'show_ui' => true,
      'labels'  => [
        'menu_name' => __( 'Cities', 'your-textdomain' ),//@see https://developer.wordpress.org/themes/functionality/internationalization/
      ],
      'show_in_graphql' => true,
      'hierarchical' => true,
      'graphql_single_name' => 'city',
      'graphql_plural_name' => 'cities',
    ] );
  
    register_post_type( 'location', [
      'show_ui' => true,
      'labels'  => [
        'menu_name' => __( 'Locations', 'your-textdomain' ),//@see https://developer.wordpress.org/themes/functionality/internationalization/
      ],
      'show_in_graphql' => true,
      'hierarchical' => true,
      'graphql_single_name' => 'location',
      'graphql_plural_name' => 'locations',
    ] );

    register_post_type( 'artist', [
      'show_ui' => true,
      'labels'  => [
        'menu_name' => __( 'Artists', 'your-textdomain' ),//@see https://developer.wordpress.org/themes/functionality/internationalization/
      ],
      'show_in_graphql' => true,
      'hierarchical' => true,
      'graphql_single_name' => 'artist',
      'graphql_plural_name' => 'artists',
    ] );

    register_post_type( 'vibe-manager', [
      'show_ui' => true,
      'labels'  => [
        'menu_name' => __( 'Vibe Managers', 'your-textdomain' ),//@see https://developer.wordpress.org/themes/functionality/internationalization/
      ],
      'show_in_graphql' => true,
      'hierarchical' => true,
      'graphql_single_name' => 'vibe-manager',
      'graphql_plural_name' => 'vibe-managers',
    ] );
  } 
);