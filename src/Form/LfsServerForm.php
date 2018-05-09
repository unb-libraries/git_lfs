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

    $form['info'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Server Information'),
      '#description' => $this->t('Administrative information about this Git LFS Server.'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    ];

    $form['info']['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Server name'),
      '#description' => $this->t('Enter the displayed name for the server.'),
      '#default_value' => $lfs_server->label(),
      '#required' => TRUE,
    ];

    $form['info']['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $lfs_server->isNew() ? NULL : $lfs_server->id(),
      '#maxlength' => 50,
      '#required' => TRUE,
      '#machine_name' => [
        'exists' => '\Drupal\git_lfs\Entity\LfsServer::load',
        'source' => ['info', 'label'],
      ],
      '#disabled' => !$lfs_server->isNew(),
    ];

    $form['info']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#description' => $this->t('Only enabled servers can provide content.'),
      '#default_value' => $lfs_server->status(),
    ];

    $form['info']['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#description' => $this->t('Enter a description for the server.'),
      '#default_value' => $lfs_server->getDescription(),
    ];

    $form['github'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('GitHub Repository Details'),
      '#description' => $this->t('Information about the LFS-enabled repository. Currently, only GitHub repositories are supported.'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    ];

    $form['github']['repository_string'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Repository Owner/Name'),
      '#description' => $this->t('Enter the repository Owner/Name e.g. "unblibraries/art-archival-masters".'),
      '#default_value' => $lfs_server->getRepositoryString(),
      '#required' => TRUE,
    ];

    $form['github']['repository_branch'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Repository Branch'),
      '#description' => $this->t('Enter the repository branch e.g. "master".'),
      '#default_value' => $lfs_server->getRepositoryBranch(),
      '#required' => TRUE,
    ];

    $form['github']['repository_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Repository Access Token'),
      '#description' => $this->t('Enter an access token that has premission to read and write to the repository via the GitHub API.'),
      '#default_value' => $lfs_server->getRepositoryToken(),
      '#required' => TRUE,
    ];

    $form['lfs_server'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('LFS Server Details'),
      '#description' => $this->t('Information about the LFS content server.'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    ];

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
