<?php

namespace Drupal\git_lfs\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Git LFS Server entity.
 *
 * @ConfigEntityType(
 *   id = "lfs_server",
 *   label = @Translation("Git LFS Server"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\git_lfs\LfsServerListBuilder",
 *     "form" = {
 *       "add" = "Drupal\git_lfs\Form\LfsServerForm",
 *       "edit" = "Drupal\git_lfs\Form\LfsServerForm",
 *       "delete" = "Drupal\git_lfs\Form\LfsServerDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\git_lfs\LfsServerHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "lfs_server",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/git_lfs/lfs_server/{lfs_server}",
 *     "add-form" = "/admin/config/git_lfs/lfs_server/add",
 *     "edit-form" = "/admin/config/git_lfs/lfs_server/{lfs_server}/edit",
 *     "delete-form" = "/admin/config/git_lfs/lfs_server/{lfs_server}/delete",
 *     "collection" = "/admin/config/git_lfs/lfs_server"
 *   }
 * )
 */
class LfsServer extends ConfigEntityBase implements LfsServerInterface {

  /**
   * The Git LFS Server ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Git LFS Server label.
   *
   * @var string
   */
  protected $label;

}
