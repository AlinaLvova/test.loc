<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class HelloController.
 */
class HelloController extends ControllerBase {

  /**
   * Say Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function sayHello() {
    return [
      '#markup' => $this->t('Hello, World!'),
    ];
  }

}
