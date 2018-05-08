<?php

namespace Drupal\git_lfs\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LfsServerForm.
 */
class LfsServerForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $lfs_server = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $lfs_server->label(),
      '#description' => $this->t("Label for the Git LFS Server."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $lfs_server->id(),
      '#machine_name' => [
        'exists' => '\Drupal\git_lfs\Entity\LfsServer::load',
      ],
      '#disabled' => !$lfs_server->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $lfs_server = $this->entity;
    $status = $lfs_server->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Git LFS Server.', [
          '%label' => $lfs_server->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Git LFS Server.', [
          '%label' => $lfs_server->label(),
        ]));
    }
    $form_state->setRedirectUrl($lfs_server->toUrl('collection'));
  }

}
