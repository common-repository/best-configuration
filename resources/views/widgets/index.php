<?php if (! defined('ABSPATH')) {
    exit;
} ?>
<div class="best-configuration wrap">

  <h2><?php _e('Widgets') ?></h2>

  <?php if (isset($feedback)) : ?>
    <div id="message"
         class="updated notice is-dismissible">
      <p>
        <?php echo $feedback ?>
      </p>
    </div>
  <?php endif; ?>

  <div class="wpbones-tabs">

    <?php echo BestConfiguration()->view('widgets.admin')->with('selected_tab', $selected_tab) ?>

    <?php echo BestConfiguration()->view('widgets.theme')->with('selected_tab', $selected_tab) ?>

  </div>

</div>