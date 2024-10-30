<?php

namespace BestConfiguration\Http\Controllers;

use BestConfiguration\WPBones\Routing\Controller as BaseController;
use BestConfiguration\PureCSSTabs\PureCSSTabsProvider;
use BestConfiguration\PureCSSSwitch\PureCSSSwitchProvider;

abstract class Controller extends BaseController
{
  protected $key = '';
  protected $hasTabs = true;
  protected $selectedTab = 'admin';

  protected function session_flash_get($key, $default = null)
  {
    if (isset($_SESSION[$key])) {
      $value = $_SESSION[$key];
      unset($_SESSION[$key]);

      return $value;
    }

    return $default;
  }

  protected function session_flash_put($key, $value = null)
  {
    if (is_null($value)) {
      unset($_SESSION[$key]);
    } else {
      $_SESSION[$key] = $value;
    }
  }

  public function load()
  {
    session_start();

    if ($this->request->isVerb('post')) {
      if ($this->request->verifyNonce("best-configuration-{$this->key}")) {
        $resetTodefault = $this->request->get('reset-to-default', null);
        $this->session_flash_put('selected_tab', $this->request->get('selected_tab', $this->selectedTab));

        if (!is_null($resetTodefault)) {
          BestConfiguration()->options->reset();
          $this->session_flash_put('feedback', __('Settings Reset to default successfully!', 'best-configuration'));
        } else {
          BestConfiguration()->options->update($this->request->getAsOptions());
          $this->session_flash_put('feedback', __('Configuration applied!', 'best-configuration'));
        }

        //do_action( 'best_configuration_options_updated' );

        if ($this->request->get('_wp_http_referer')) {
          // the wp_redirect() will be done
          $this->redirect($this->request->get('_wp_http_referer'));
        }
      }
    }
  }

  public function index()
  {
    if ($this->hasTabs) {
      PureCSSTabsProvider::enqueueStyles();
    }

    PureCSSSwitchProvider::enqueueStyles();

    $feedback = $this->session_flash_get('feedback');

    return BestConfiguration()
      ->view("{$this->key}.index")
      ->withAdminStyles('best-configuration-dashboard')
      ->withAdminScripts('best-configuration-main')
      ->with('feedback', $feedback)
      ->with('selected_tab', $this->session_flash_get('selected_tab', $this->selectedTab));
  }
}
