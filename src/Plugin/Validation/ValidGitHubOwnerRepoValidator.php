<?php

namespace Drupal\git_lfs\Plugin\Validation;

use Drupal\Core\Form\FormStateInterface;

/**
 * Validates the ValidGitHubOwnerRepoValidator constraint.
 */
class ValidGitHubOwnerRepoValidator {

  /**
   * {@inheritdoc}
   */
  public static function validate(array &$element, FormStateInterface $formState, array &$form) {
    $value = $formState->getValue($element['#name']);
    $pattern = '/^[0-9a-zA-Z\-_]+\/[0-9a-zA-Z\-_]+$/';

    if (! (bool) preg_match($pattern, $value)) {
      $tArgs = array(
        '%name' => empty($element['#title']) ? $element['#parents'][0] : $element['#title'],
        '%value' => $value,
      );
      $formState->setError(
        $element,
        t('%value is invalid. Please use a value like "unblibraries/art-archival-masters" for the %name element.', $tArgs)
      );
    }
  }

}
