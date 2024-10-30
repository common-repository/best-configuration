<?php if (!defined('ABSPATH')) {
  exit();
} ?>

<div class="best-configuration wrap">
  <h2><?php _e('General'); ?></h2>

  <?php if (isset($feedback)): ?>
    <div id="message"
         class="updated notice is-dismissible">
      <p>
        <?php echo $feedback; ?>
      </p>
    </div>
  <?php endif; ?>

  <div class="wpbones-tabs">

  <?php BestConfiguration\PureCSSTabs\PureCSSTabsProvider::openTab(
    __('Admin', 'best-configuration'),
    'admin',
    $selected_tab
  ); ?>

    <form action=""
          method="post">

      <?php wp_nonce_field('best-configuration-general'); ?>

      <input name="selected_tab"
             type="hidden"
             value="admin"/>

      <p>
        <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('general/wp_rest_api')
          ->checked($plugin->options->get('general/wp_rest_api'))
          ->right_label(__('Enable WP REST API')); ?>
      </p>

      <p>
        <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('general/xml_rpc')
          ->checked($plugin->options->get('general/xml_rpc'))
          ->right_label(__('Enable XML-RPC')); ?>
      </p>

      <p>
        <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('general/wp_version')
          ->checked($plugin->options->get('general/wp_version'))
          ->right_label(__('Display WordPress Version')); ?>
      </p>

      <p>
        <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('general/remove_footer')
          ->checked($plugin->options->get('general/remove_footer'))
          ->right_label(__('Remove footer')); ?>
      </p>

      <p>
        <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name('general/hide_login_errors')
          ->checked($plugin->options->get('general/hide_login_errors'))
          ->right_label(__('Hide login Errors')); ?>
      </p>

      <p>
        <?php echo BestConfiguration\PureCSSSwitch\Html\HtmlTagSwitchButton::name(
          'general/disable_authenticate_by_email'
        )
          ->checked($plugin->options->get('general/disable_authenticate_by_email'))
          ->right_label(__('Disable Authentication by Email')); ?>
      </p>

      <hr/>

      <p class="clerfix">
        <button name="reset-to-default"
                data-confirm="<?php _e(
                  'Warning! Are you sure to reset the values to default?',
                  'best-configuration'
                ); ?>"
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

  <?php BestConfiguration\PureCSSTabs\PureCSSTabsProvider::closeTab(); ?>

  </div>

</div>