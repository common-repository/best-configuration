<?php if (!defined('ABSPATH')) {
  exit();
}

BestConfiguration\PureCSSTabs\PureCSSTabsProvider::openTab(__('Admin', 'best-configuration'), 'admin', $selected_tab);
?>

  <form action=""
        method="post">

    <?php wp_nonce_field('best-configuration-dashboard'); ?>

    <input name="selected_tab"
           type="hidden"
           value="admin"/>

    <p>
      <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('dashboard/admin/remove_welcome_panel')
        ->checked($plugin->options->get('dashboard/admin/remove_welcome_panel'))
        ->right_label(__('Remove Welcome Panel from WordPress Dashboard.')); ?>
    </p>

    <h3><?php _e('Remove the following menus'); ?></h3>
    <?php $removedMenus = [
      'remove_dashboard_menu' => __('Dashboard'),
      'remove_posts_menu' => __('Posts'),
      'remove_pages_menu' => __('Pages'),
      'remove_media_menu' => __('Media'),
      'remove_links_menu' => __('Links'),
      'remove_appearance_menu' => __('Appearance'),
      'remove_comments_menu' => __('Comments'),
      'remove_tools_menu' => __('Tools'),
      'remove_settings_menu' => __('Settings'),
      'remove_users_menu' => __('Users'),
      'remove_plugins_menu' => __('Plugins'),
    ]; ?>

    <ul class="best-configuration-column">
      <?php foreach ($removedMenus as $key => $label): ?>
        <li>
          <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('dashboard/admin/' . $key)
            ->checked($plugin->options->get('dashboard/admin.' . $key))
            ->right_label($label); ?>
        </li>
      <?php endforeach; ?>
    </ul>

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
