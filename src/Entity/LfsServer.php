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
 *     "uuid" = "uuid",
 *     "status" = "status"
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
   * The ID of the server.
   *
   * @var string
   */
  protected $id = NULL;

  /**
   * The displayed name of the server.
   *
   * @var string
   */
  protected $label = NULL;

  /**
   * The displayed description of the server.
   *
   * @var string
   */
  protected $description = NULL;

  /**
   * The owner/name of the repository to target.
   *
   * @var string
   */
  protected $repository_string = NULL;

  /**
   * The owner/name of the repository to target.
   *
   * @var string
   */
  protected $repository_branch = NULL;

  /**
   * The API access token that has rights to the repository.
   *
   * @var string
   */
  protected $repository_token = NULL;

  /**
   * The protocol of the LFS content server.
   *
   * @var string
   */
  protected $lfs_protocol = NULL;

  /**
   * The hostname of the LFS content server.
   *
   * @var string
   */
  protected $lfs_host = NULL;

  /**
   * The port of the LFS content server.
   *
   * @var int
   */
  protected $lfs_port = NULL;

  /**
   * The user for the LFS content server.
   *
   * @var int
   */
  protected $lfs_auth_user = NULL;

  /**
   * The password for the LFS content server.
   *
   * @var int
   */
  protected $lfs_auth_pass = NULL;

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRepositoryString() {
    return $this->repository_string;
  }

  /**
   * {@inheritdoc}
   */
  public function setRepositoryString($repository_string) {
    $this->repository_string = $repository_string;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRepositoryName() {
    $name = NULL;
    $string_data = explode('/', $this->repository_string);
    if (count($string_data) > 1 && !empty($string_data[1])) {
      $name = $string_data[1];
    }
    return $name;
  }

  /**
   * {@inheritdoc}
   */
  public function getRepositoryOwner() {
    $owner = NULL;
    $string_data = explode('/', $this->repository_string);
    if (count($string_data) > 1 && !empty($string_data[0])) {
      $owner = $string_data[0];
    }
    return $owner;
  }

  /**
   * {@inheritdoc}
   */
  public function getRepositoryBranch() {
    return $this->repository_branch;
  }

  /**
   * {@inheritdoc}
   */
  public function setRepositoryBranch($repository_branch) {
    $this->repository_branch = $repository_branch;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRepositoryToken() {
    return $this->repository_token;
  }

  /**
   * {@inheritdoc}
   */
  public function setRepositoryToken($repository_token) {
    $this->repository_token = $repository_token;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLfsProtocol() {
    return $this->lfs_protocol;
  }

  /**
   * {@inheritdoc}
   */
  public function setLfsProtocol($protocol) {
    $this->lfs_protocol = $protocol;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLfsHost() {
    return $this->lfs_host;
  }

  /**
   * {@inheritdoc}
   */
  public function setLfsHost($hostname) {
    $this->lfs_host = $hostname;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLfsPort() {
    return $this->lfs_port;
  }

  /**
   * {@inheritdoc}
   */
  public function setLfsPort($port) {
    $this->lfs_port = $port;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLfsAuthUser() {
    return $this->lfs_auth_user;
  }

  /**
   * {@inheritdoc}
   */
  public function setLfsAuthUser($username) {
    $this->lfs_auth_user = $username;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLfsAuthPass() {
    return $this->lfs_auth_pass;
  }

  /**
   * {@inheritdoc}
   */
  public function setLfsAuthPass($password) {
    $this->lfs_auth_pass = $password;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLfsServerBaseUri() {
    return $this->getLfsProtocol() .
      '://' .
      $this->getLfsHost() .
      ':' .
      $this->getLfsPort();
  }

  /**
   * {@inheritdoc}
   */
  public function getServerStatus() {
    return [
      'available' => TRUE,
      'message' => 'The repository and LFS server are reachable and responding.',
    ];
  }

}
