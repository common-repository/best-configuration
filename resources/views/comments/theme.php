<?php if (!defined('ABSPATH')) {
  exit();
}

BestConfiguration\PureCSSTabs\PureCSSTabsProvider::openTab(__('Theme', 'best-configuration'), 'theme', $selected_tab);
?>

  <form action=""
        method="post">

    <?php wp_nonce_field('best-configuration-comments'); ?>

    <input name="selected_tab"
           type="hidden"
           value="theme"/>

    <p>
      <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('comments/theme/remove_author_link')
        ->checked($plugin->options->get('comments/theme/remove_author_link'))
        ->right_label(__('Remove only the author link from comments list')); ?>
    </p>

    <p>
      <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('comments/theme/remove_author')
        ->checked($plugin->options->get('comments/theme/remove_author'))
        ->right_label(__('Remove the author from comments list')); ?>
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
