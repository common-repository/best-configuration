<?php if (!defined('ABSPATH')) {
  exit();
}

BestConfiguration\PureCSSTabs\PureCSSTabsProvider::openTab(__('Theme', 'best-configuration'), 'theme', $selected_tab);
?>

  <form action=""
        method="post">

    <?php wp_nonce_field('best-configuration-posts'); ?>

    <input name="selected_tab"
           type="hidden"
           value="theme"/>

    <p>

      <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('posts/theme/disable_feed')
        ->checked($plugin->options->get('posts/theme/disable_feed'))
        ->right_label(__('Disable feed RSS')); ?>
    </p>

    <p>
      <label for="posts/theme/excerpt_length">
        <?php _e('Set the excerpt length (set to zero for default)'); ?>:
        <input type="number"
               id="posts/theme/excerpt_length"
               min="0"
               value="<?php echo $plugin->options->get('posts/theme/excerpt_length'); ?>"
               name="posts/theme/excerpt_length"/>
      </label>
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
