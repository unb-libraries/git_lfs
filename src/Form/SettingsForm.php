<?php

namespace Drupal\git_lfs\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'git_lfs.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('git_lfs.settings');
    $form['git_lfs_server'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Git LFS Server'),
      '#description' => $this->t('The LFS server'),
      '#maxlength' => 128,
      '#size' => 64,
      '#default_value' => $config->get('git_lfs_server'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('git_lfs.settings')
      ->set('git_lfs_server', $form_state->getValue('git_lfs_server'))
      ->save();
  }

}
