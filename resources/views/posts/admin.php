<?php if (!defined('ABSPATH')) {
  exit();
}

BestConfiguration\PureCSSTabs\PureCSSTabsProvider::openTab(__('Admin', 'best-configuration'), 'admin', $selected_tab);
?>
  <form action=""
        method="post">

    <?php wp_nonce_field('best-configuration-posts'); ?>

    <input name="selected_tab"
           type="hidden"
           value="admin"/>

    <p>
      <label for="posts/admin/revisions_to_keep">
        <?php _e('Set the number of revisions to keep for all post types (set to zero for default)'); ?>:
        <input type="number"
               id="posts/admin/revisions_to_keep"
               min="0"
               value="<?php echo $plugin->options->get('posts/admin/revisions_to_keep'); ?>"
               name="posts/admin/revisions_to_keep"/>
      </label>
    </p>

    <p>
      <?php _e('Set the number of revisions for the following post types (set to zero for default)'); ?>
    </p>

    <ul class="best-configuration-column">
      <?php foreach (get_post_types() as $key): ?>
        <?php $post_type = get_post_type_object($key); ?>
        <?php $label = $post_type->labels->singular_name; ?>
        <li>
          <label for="posts/admin/revisions_to_keep_<?php echo $key; ?>">
            <?php echo $label; ?>:
            <input type="number"
                   id="posts/admin/revisions_to_keep_<?php echo $key; ?>"
                   min="0"
                   value="<?php echo $plugin->options->get('posts/admin/revisions_to_keep_' . $key); ?>"
                   name="posts/admin/revisions_to_keep_<?php echo $key; ?>"/>
          </label>
        </li>
      <?php endforeach; ?>
    </ul>

    <hr/>

    <p>

      <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('posts/admin/drag_and_drop')
        ->checked($plugin->options->get('posts/admin/drag_and_drop'))
        ->right_label(__('Enbale Drag & Drop in Pages')); ?>
    </p>

    <hr/>

    <p class="clerfix">
      <button name="reset-to-default"
              data-confirm="<?php _e('Warning! Are you sure to reset the values to default?', 'best-configuration'); ?>"
              class="button button-secondary alignleft">
        <?php _e('Reset to default', 'best-configuration'); ?>
      </button>

      <button type="submit"
              name="apply"
              class="button button-primary alignright">
        <?php _e('Apply', 'best-configuration'); ?>
      </button>
    </p>

  </form>
<?php BestConfiguration\PureCSSTabs\PureCSSTabsProvider::closeTab();
