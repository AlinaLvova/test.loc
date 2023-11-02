<?php

namespace Drupal\hello_drupal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Controller for the Hello Drupal module.
 */
class HelloDrupalController extends ControllerBase {

  /**
   * Display a greeting message.
   */
  public function hello() {
    return [
      '#title' => $this->t("I'm a Drupal Developer!"),
    ];
  }

  /**
   * Display a personalized greeting for the current user.
   */
  public function helloMe() {
    $current_user = \Drupal::currentUser();

    return [
      '#title' => $this->t("Hello, @username (@uid)!", [
        '@username' => $current_user->getDisplayName(),
        '@uid' => $current_user->id(),
      ]),
      '#markup' => $this->t("Current server time: @time", [
        '@time' => \Drupal::service('date.formatter')->format(\Drupal::time()->getRequestTime(), 'custom', 'Y-m-d H:i:s'),
      ]),
    ];
  }
}
