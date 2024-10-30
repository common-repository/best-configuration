<?php BestConfiguration\PureCSSTabs\PureCSSTabsProvider::openTab(
  __('Theme', 'best-configuration'),
  'theme',
  $selected_tab
); ?>

<form action=""
      method="post">

  <?php wp_nonce_field('best-configuration-widgets'); ?>

  <input name="selected_tab"
         type="hidden"
         value="theme"/>

  <p>
    <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name(
      'widgets/theme/enable_shortcode_text_widget'
    )
      ->checked($plugin->options->get('widgets/theme/enable_shortcode_text_widget'))
      ->right_label(__('Enable Shortcodes for the Text Widget')); ?>
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
