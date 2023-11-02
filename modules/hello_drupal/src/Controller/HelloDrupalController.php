<?php

namespace Drupal\hello_drupal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for the Hello Drupal module.
 */
class HelloDrupalController extends ControllerBase
{

  /**
   * Display a greeting message.
   */
  public function hello()
  {
    return [
      '#title' => $this->t("I'm a Drupal Developer!"),
    ];
  }

  /**
   * Display a personalized greeting for the current user.
   */
  public function helloMe()
  {
    $current_user = \Drupal::currentUser();


    // Получаем идентификатор и имя пользователя.
    $user_id = $current_user->id();
    $user_name = $current_user->getDisplayName();

    if ($current_user->isAuthenticated() || $current_user->hasPermission('administer site configuration')) {

      return [
        '#title' => $this->t("Hello, @username (@uid)!", [
          '@username' => $user_name,
          '@uid' => $user_id,
        ]),
        '#markup' => $this->t("Current server time: @time", [
          '@time' => \Drupal::service('date.formatter')->format(\Drupal::time()->getRequestTime(), 'custom', 'Y-m-d H:i:s'),
        ]),
      ];
    } else {
      // Handle access denied.
      return $this->accessDenied();
    }
  }
  /**
   * Custom access denied page.
   */
  public function accessDenied()
  {
    return new Response($this->t('Access Denied'), 403);
  }

  public function isPalindrome($text)
  {
    // Remove spaces and convert text to lowercase for comparison.
    $text = strtolower(preg_replace('/[^a-z0-9]+/', '', $text));

    // Compare the text with its reversed version.
    if ($text === strrev($text)) {
      $result = $this->t('Yes', [], ['context' => 'English']);
    } else {
      $result = $this->t('No', [], ['context' => 'English']);
    }

    return [
      '#markup' => $this->t('Is "@text" a palindrome?<br />@result', [
        '@text' => $text,
        '@result' => $result
      ]),
      '#title' => $result,
    ];
  }
}
