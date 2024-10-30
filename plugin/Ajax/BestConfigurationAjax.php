<?php

namespace BestConfiguration\Ajax;

use BestConfiguration\WPBones\Foundation\WordPressAjaxServiceProvider as ServiceProvider;

class BestConfigurationAjax extends ServiceProvider
{
    /**
     * List of the ajax actions executed by both logged and not logged users.
     * Here you will used a methods list.
     *
     * @var array
     */
    protected $trusted = [];

    /**
     * List of the ajax actions executed only by logged in users.
     * Here you will used a methods list.
     *
     * @var array
     */
    protected $logged = [
      'best_configuration_drag_and_drop_action'
    ];

    /**
     * List of the ajax actions executed only by not logged in user, usually from frontend.
     * Here you will used a methods list.
     *
     * @var array
     */
    protected $notLogged = [];

    public function best_configuration_drag_and_drop_action()
    {
        /**
         * @var wpdb $wpdb
         */
        global $wpdb;

        $sorted   = wp_parse_args($_POST[ 'sorted' ]);
        $paged    = absint(esc_attr($_POST[ 'paged' ]));
        $per_page = absint(esc_attr($_POST[ 'per_page' ]));

        if (is_array($sorted[ 'post' ])) {
            $offset = ($paged - 1) * $per_page;
            foreach ($sorted[ 'post' ] as $key => $value) {
                $menu_order = $key + $offset;
                $sql        = sprintf('UPDATE %s SET menu_order = %s WHERE ID = %s', $wpdb->posts, $menu_order, absint($value));
                $wpdb->query($sql);
            }
        }

        wp_send_json_success();
    }


}
