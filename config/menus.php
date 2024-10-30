<?php

/*
|--------------------------------------------------------------------------
| Plugin Menus routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the menu routes for a plugin.
| In this context the route are the menu link.
|
*/

return [
  'best_configuration_slug_menu' => [
    "menu_title" => "Best Configuration",
    'capability' => 'manage_options',
    'icon'       => 'dashicons-admin-generic',
    'items'      => [
      [
        "menu_title" => __('General'),
        'capability' => 'manage_options',
        'route'      => [
          'resource' => 'GeneralController',
        ],
      ],
      [
        "menu_title" => __('Dashboard'),
        'capability' => 'manage_options',
        'route'      => [
          'resource' => 'DashboardController',
        ],
      ],
      [
        "menu_title" => __('Comments'),
        'capability' => 'manage_options',
        'route'      => [
          'resource' => 'CommentsController',
        ],
      ],
      [
        "menu_title" => __('Posts'),
        'capability' => 'manage_options',
        'route'      => [
          'resource' => 'PostsController'
        ],
      ],
      [
        "menu_title" => __('Widgets'),
        'capability' => 'manage_options',
        'route'      => [
          'resource' => 'WidgetsController'
        ],
      ],
    ]
  ]
];
