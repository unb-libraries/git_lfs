<?php

namespace Drupal\git_lfs;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Git LFS Server entities.
 */
class LfsServerListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Name');
    $header['repository_string'] = $this->t('GitHub Repository');
    $header['repository_branch'] = $this->t('Branch');
    $header['lfs_host'] = $this->t('LFS Server');
    $header['status'] = $this->t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['repository_string'] = $entity->getRepositoryString();
    $row['repository_branch'] = $entity->getRepositoryBranch();
    $row['lfs_host'] = $entity->getLfsServerBaseUri();

    $status = $entity->status();
    $status_label = $status ? $this->t('Enabled') : $this->t('Disabled');
    $row['status'] = [
      'data' => [
        '#theme' => 'image',
        '#uri' => $status ? 'core/misc/icons/73b355/check.svg' : 'core/misc/icons/e32700/error.svg',
        '#width' => 18,
        '#height' => 18,
        '#alt' => $status_label,
        '#title' => $status_label,
      ],
      'class' => ['checkbox'],
    ];

    return $row + parent::buildRow($entity);
  }

}
