<?php

/*
|--------------------------------------------------------------------------
| Plugin options
|--------------------------------------------------------------------------
|
| Here is where you can insert the options model of your plugin.
| These options model will store in WordPress options table
| (usually wp_options).
| You'll get these options by using `$plugin->options` property
|
*/

return [
  'version' => '0.2',

  'general' => [
    'wp_rest_api'                   => true,
    'xml_rpc'                       => true,
    'wp_version'                    => true,
    'remove_footer'                 => false,
    'hide_login_errors'             => false,
    'disable_authenticate_by_email' => false,
  ],

  'dashboard' => [
    'admin' => [
      'remove_welcome_panel'   => false,
      'remove_dashboard_menu'  => false,
      'remove_posts_menu'      => false,
      'remove_pages_menu'      => false,
      'remove_media_menu'      => false,
      'remove_links_menu'      => false,
      'remove_appearance_menu' => false,
      'remove_comments_menu'   => false,
      'remove_tools_menu'      => false,
      'remove_settings_menu'   => false,
      'remove_users_menu'      => false,
      'remove_plugins_menu'    => false,
      'remove_custom_menu'     => '', // TODO: add a input type text with comma sep
    ],
    'theme' => [
      'remove_admin_bar' => false,
    ],
  ],

  'comments' => [
    'admin' => [],
    'theme' => [
      'remove_author'      => false,
      'remove_author_link' => false,
    ],
  ],

  'posts' => [
    'admin' => [
      'revisions_to_keep' => 0,
      'drag_and_drop'     => false,
    ],
    'theme' => [
      'excerpt_length' => '0',
      'disable_feed'   => false,
    ],
  ],

  'widgets' => [
    'admin' => [],
    'theme' => [
      'enable_shortcode_text_widget' => false,
    ],
  ],


];
