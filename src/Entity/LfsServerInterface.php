<?php

namespace Drupal\git_lfs\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Git LFS Server entities.
 */
interface LfsServerInterface extends ConfigEntityInterface {

  /**
   * Retrieves the server's description.
   *
   * @return string
   *   The description of the server.
   */
  public function getDescription();

  /**
   * Sets the server's description.
   *
   * @param string $description
   *   The new description of the server.
   *
   * @return $this
   */
  public function setDescription($description);

  /**
   * Retrieves the server's repository string.
   *
   * @return string
   *   The repository string of the server.
   */
  public function getRepositoryString();

  /**
   * Sets the server's repository string.
   *
   * @param string $repository_string
   *   The new repository string of the server.
   *
   * @return $this
   */
  public function setRepositoryString($repository_string);

  /**
   * Retrieves the server's repository name.
   *
   * @return string
   *   The repository name of the server.
   */
  public function getRepositoryName();

  /**
   * Retrieves the server's repository owner.
   *
   * @return string
   *   The repository owner of the server.
   */
  public function getRepositoryOwner();

  /**
   * Retrieves the server's repository branch.
   *
   * @return string
   *   The repository branch of the server.
   */
  public function getRepositoryBranch();

  /**
   * Sets the server's repository branch.
   *
   * @param string $repository_branch
   *   The new repository branch of the server.
   *
   * @return $this
   */
  public function setRepositoryBranch($repository_branch);

  /**
   * Retrieves the server's GitHub repository access token.
   *
   * @return string
   *   The GitHub repository access token of the server.
   */
  public function getRepositoryToken();

  /**
   * Sets the server's GitHub repository access token.
   *
   * @param string $repository_token
   *   The new GitHub repository access token of the server.
   *
   * @return $this
   */
  public function setRepositoryToken($repository_token);

}
