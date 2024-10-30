<?php

namespace BestConfiguration\Providers;

class BestConfigurationManager extends BestConfigurationController
{
    /*
    |--------------------------------------------------------------------------
    | General options
    |--------------------------------------------------------------------------
    |
    */

    public function generalWpRestApi($option)
    {
        if (! empty($option)) {
            // Filters for WP-API version 1.x
            add_filter('json_enabled', '__return_false');
            add_filter('json_jsonp_enabled', '__return_false');

            // Filters for WP-API version 2.x
            add_filter('rest_enabled', '__return_false');
            add_filter('rest_jsonp_enabled', '__return_false');

            // Remove REST API info from head and headers
            remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
            remove_action('wp_head', 'rest_output_link_wp_head', 10);
            remove_action('template_redirect', 'rest_output_link_header', 11);

            add_filter('rest_authentication_errors', [ $this, 'rest_authentication_errors' ]);
        }
    }

    public function generalXmlRpc($option)
    {
        if (empty($option)) {
            add_filter('xmlrpc_enabled', '__return_false');
        }
    }

    public function rest_authentication_errors($access)
    {
        return new \WP_Error(
            'rest_cannot_access',
            __('Only authenticated users can access the REST API.'),
            [ 'status' => rest_authorization_required_code() ]
        );
    }

    public function generalWpVersion($option)
    {
        if (empty($option)) {
            remove_action('wp_head', 'wp_generator');
            add_filter('the_generator', function () {
                return '';
            });
        }
    }

    public function generalRemoveFooter($option)
    {
        if (! empty($option)) {
            add_filter('admin_footer_text', '__return_false');
        }
    }

    public function generalHideLoginErrors($option)
    {
        if (! empty($option)) {
            add_filter('login_errors', function () {
                return __('Something is wrong!');
            });

        }
    }

    public function generalDisableAuthenticateByEmail($option)
    {
        if (! empty($option)) {
            remove_filter('authenticate', 'wp_authenticate_email_password', 20);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard options
    |--------------------------------------------------------------------------
    |
    */

    public function dashboardAdminRemoveWelcomePanel($option)
    {
        if (! empty($option)) {
            remove_action('welcome_panel', 'wp_welcome_panel');
        }
    }

    public function dashboardAdminRemoveDashboardMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Dashboard'));
            });
        }
    }

    public function dashboardAdminRemovePostsMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Posts'));
            });
        }
    }

    public function dashboardAdminRemovePagesMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Pages'));
            });
        }
    }

    public function dashboardAdminRemoveMediaMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Media'));
            });
        }
    }

    public function dashboardAdminRemoveLinksMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Links'));
            });
        }
    }

    public function dashboardAdminRemoveAppearanceMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Appearance'));
            });
        }
    }

    public function dashboardAdminRemoveCommentsMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Comments'));
            });
        }
    }

    public function dashboardAdminRemoveToolsMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Tools'));
            });
        }
    }

    public function dashboardAdminRemoveSettingsMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Settings'));
            });
        }
    }

    public function dashboardAdminRemoveUsersMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Users'));
            });
        }
    }

    public function dashboardAdminRemovePluginsMenu($option)
    {
        if (! empty($option)) {
            add_action('admin_menu', function () {
                $this->removeMenu(__('Plugins'));
            });
        }
    }

    protected function removeMenu($label)
    {
        global $menu;
        end($menu);
        while(prev($menu)) {
            $value = explode(' ', $menu[ key($menu) ][ 0 ]);
            if ($value[ 0 ] != null && $value[ 0 ] == $label) {
                unset($menu[ key($menu) ]);
            }
        }
    }

    public function dashboardThemeRemoveAdminBar($option)
    {
        if (! empty($option)) {
            add_filter('show_admin_bar', '__return_false');
            wp_deregister_script('admin-bar');
            wp_deregister_style('admin-bar');
            remove_action('wp_footer', 'wp_admin_bar_render', 1000);
            show_admin_bar(false);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Comments options
    |--------------------------------------------------------------------------
    |
    */

    public function commentsThemeRemoveAuthor($option)
    {
        if (! empty($option)) {
            add_filter('get_comment_author_link', '__return_false');
        }
    }

    public function commentsThemeRemoveAuthorLink($option)
    {
        if (! empty($option)) {
            remove_filter('get_comment_author_link', '__return_false');
            add_filter(
                'get_comment_author_link',
                function ($return, $author) {
                    $return = $author;

                    return $return;

                },
                10,
                2
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Posts options
    |--------------------------------------------------------------------------
    |
    */

    public function postsAdminRevisionToKeep($option)
    {
        if ($option > 0) {
            add_filter(
                'wp_revisions_to_keep',
                function ($num, $post) use ($option) {
                    return $option;

                },
                10,
                2
            );
        }

        $options = BestConfiguration()->options->get('posts.admin');

        // revisions to keep for post types
        foreach (get_post_types() as $key) {
            $optionKey = "revisions_to_keep_{$key}";

            if (isset($optionKey) && $options[ $optionKey ] > 0) {

                add_filter(
                    'wp_revisions_to_keep',
                    function ($num, $post) use ($key) {

                        $options = BestConfiguration()->options->get('posts.admin');

                        if ($key == $post->post_type) {
                            return $options[ "revisions_to_keep_{$key}" ];
                        }

                        return $num;

                    },
                    10,
                    2
                );
            }
        }

    }

    public function postsAdminDragAndDrop($option)
    {
        if (! empty($option)) {
            // add input type hidden and query
            // Fires before the Filter button on the Posts and Pages list tables.
            add_action('restrict_manage_posts', function () {
                global $typenow, $per_page;

                // Get the post type
                $cpt = get_post_type_object($typenow);

                // Enabled drag & drop menu order only for post type page
                if (! empty($cpt) && is_object($cpt) && post_type_supports($typenow, 'page-attributes')) {
                    // Build info on pagination. Useful for sorter
                    $paged = isset($_REQUEST[ 'paged' ]) ? $_REQUEST[ 'paged' ] : '1';
                    ?>
          <input rel="<?php echo $typenow ?>"
                 type="hidden"
                 name="best-configuration-per-page"
                 id="best-configuration-per-page"
                 value="<?php echo $per_page ?>"/>
          <input type="hidden"
                 name="best-configuration-paged"
                 id="best-configuration-paged"
                 value="<?php echo $paged ?>"/>
          <?php
                }
            });

            // add styles
            add_action('admin_print_styles-edit.php', function () {
                wp_enqueue_style(
                    'best-configuration-drag-and-drop',
                    BestConfiguration()->css . '/best-configuration-drag-and-drop.min.css',
                    [],
                    BestConfiguration()->Version
                );
            });

            // add javascript for drag & drop
            add_action(
                'admin_print_footer_scripts-edit.php',
                function () {
                    wp_enqueue_script(
                        'best-configuration-drag-and-drop',
                        BestConfiguration()->js . '/best-configuration-drag-and-drop.min.js',
                        [
                                         'jquery-ui-core',
                                         'jquery-ui-sortable',
                                         'jquery-ui-draggable',
                                       ],
                        BestConfiguration()->Version,
                        true
                    );
                }
            );

            // add column
            add_filter(
                'manage_pages_columns',
                function ($columns) {
                    global $typenow;

                    if (is_null($typenow)) {
                        return $columns;
                    }

                    if (post_type_supports($typenow, 'page-attributes')) {
                        $columns = array_merge([ 'menu_order' => '<i class="dashicons dashicons-editor-ol"></i>' ], $columns);
                    }

                    return $columns;
                }
            );

            // add column content
            add_action(
                'manage_pages_custom_column',
                function ($column_name, $post_id) {

                    global $post;

                    if ($column_name == 'menu_order') {
                        printf('<i data-order="%s" class="dashicons dashicons-move"></i>', $post->menu_order);
                    }

                },
                10,
                2
            );
        }
    }

    public function postsThemeExcerptLength($option)
    {
        if (! empty($option)) {
            add_filter(
                'excerpt_length',
                function ($words) use ($option) {
                    return $option;
                },
                99
            );
        }
    }

    public function postsThemeDisableFeed($option)
    {
        if (! empty($option)) {
            add_action('do_feed', [ $this, 'postsThemeDisableFeedHook' ], 1);
            add_action('do_feed_rdf', [ $this, 'postsThemeDisableFeedHook' ], 1);
            add_action('do_feed_rss', [ $this, 'postsThemeDisableFeedHook' ], 1);
            add_action('do_feed_rss2', [ $this, 'postsThemeDisableFeedHook' ], 1);
            add_action('do_feed_atom', [ $this, 'postsThemeDisableFeedHook' ], 1);

        }
    }

    public function postsThemeDisableFeedHook()
    {
        wp_die(__('<h1>Feed not available, please visit our <a href="' . get_bloginfo('url') . '">Home Page</a>!</h1>'));
    }

    /*
    |--------------------------------------------------------------------------
    | Widgets options
    |--------------------------------------------------------------------------
    |
    */

    public function widgetsThemeEnableShortcodeTextWidget($option)
    {
        if (! empty($option)) {
            add_filter('widget_text', 'do_shortcode');
        }
    }
}
