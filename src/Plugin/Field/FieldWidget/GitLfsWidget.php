<?php

namespace Drupal\git_lfs\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\git_lfs\Entity\LfsServer;

/**
 * Plugin implementation of the 'git_lfs_widget' widget.
 *
 * @FieldWidget(
 *   id = "git_lfs_widget",
 *   label = @Translation("Git LFS File Widget"),
 *   field_types = {
 *     "git_lfs_file"
 *   }
 * )
 */
class GitLfsWidget extends WidgetBase {
  use MessengerTrait;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $server_setting = $this->getFieldSetting('lfs_server');
    if (!empty($server_setting)) {
      $summary[] = t('LFS Server: @server', ['@server' => $server_setting]);
    }
    else {
      $summary[] = t('Warning : No LFS Server Selected!');
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = $element + [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#size' => $this->getFieldSetting('max_length'),
      '#placeholder' => 'sha256:d00b432eb24f033713ffc1dc6e51e675d65d35c4cce9b7151e04db07d763eb08',
      '#maxlength' => $this->getFieldSetting('max_length'),
      '#suffix' => 'Github Repo : flkadjsflkdajf<br>LFS Server: fdsfsdfsdfsf',
    ];

    return $element;
  }

}
