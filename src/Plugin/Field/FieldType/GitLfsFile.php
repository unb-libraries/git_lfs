<?php

namespace Drupal\git_lfs\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\git_lfs\Entity\LfsServer;

/**
 * Plugin implementation of the 'git_lfs_file' field type.
 *
 * @FieldType(
 *   id = "git_lfs_file",
 *   label = @Translation("Git LFS File"),
 *   description = @Translation("A git LFS file"),
 *   default_widget = "git_lfs_widget",
 *   default_formatter = "git_lfs_formatter"
 * )
 */
class GitLfsFile extends FieldItemBase {
  use MessengerTrait;

  // https://github.com/git-lfs/git-lfs/blob/master/docs/spec.md
  const HASH_METHOD = 'sha256';
  const HASH_SEPARATOR = ':';

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
        'lfs_server' => ''
      ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text value'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'value' => [
          'type' => 'varchar_ascii',
          'length' => 64 + strlen(self::HASH_SEPARATOR) + strlen(self::HASH_METHOD),
          'binary' => TRUE,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();
    $hash_length = 64 + strlen(self::HASH_SEPARATOR) + strlen(self::HASH_METHOD);

    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints[] = $constraint_manager->create('ComplexData', [
      'value' => [
        'Length' => [
          'max' => $hash_length,
          'min' => $hash_length,
          'exactMessage' => t('%name: must be exactly @exact characters.', [
            '%name' => $this->getFieldDefinition()->getLabel(),
            '@exact' => $hash_length
          ]),
        ],
      ],
    ]);


    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['value'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['lfs_server'] = [
      '#type' => 'select',
      '#title' => t('LFS Server'),
      '#required' => TRUE,
      '#options' => LfsServer::getEnabledServerOptions(),
      '#empty_option' => $this->t('None'),
    ];

    if (!empty($this->getSetting('lfs_server'))) {
      $elements['lfs_server']['#default_value'] = $this->getSetting('lfs_server');
    } else {
      $link = \Drupal\Core\Url::fromRoute('entity.lfs_server.collection')->toString();
      $message = $this->t('No LFS servers have been set. You must first set an LFS server before configuring the Form options. Please go to the <a href="@link">Add Server</a> screen and add one.', array('@link' => $link));
      $this->messenger()->addWarning($message);
    }

    return $elements;
  }


  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}
