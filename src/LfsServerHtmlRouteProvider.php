<?php

namespace Drupal\git_lfs;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\AdminHtmlRouteProvider;

/**
 * Provides routes for Git LFS Server entities.
 *
 * @see Drupal\Core\Entity\Routing\AdminHtmlRouteProvider
 * @see Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider
 */
class LfsServerHtmlRouteProvider extends AdminHtmlRouteProvider {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $collection = parent::getRoutes($entity_type);
    return $collection;
  }

}
