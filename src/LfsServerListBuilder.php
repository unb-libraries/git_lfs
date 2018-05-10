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
    $header['label'] = $this->t('Git LFS Server');
    $header['repository_string'] = $this->t('Repository');
    $header['repository_branch'] = $this->t('Branch');
    $header['lfs_host'] = $this->t('LFS Hostname');
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
    $row['lfs_host'] = $entity->getLfsHost();
    $row['status'] = $entity->status();
    return $row + parent::buildRow($entity);
  }

}
